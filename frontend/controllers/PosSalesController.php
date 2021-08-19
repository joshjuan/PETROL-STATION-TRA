<?php

namespace frontend\controllers;

use frontend\models\Company;
use frontend\models\DailyCounter;
use frontend\models\GlobalCounter;
use frontend\models\Model;
use frontend\models\PosTaxconfig;
use frontend\models\Product;
use frontend\models\SalesItem;
use frontend\models\Taxconfig;
use frontend\models\UrlConfig;
use frontend\models\User;
use SimpleXMLElement;
use Yii;
use frontend\models\PosSales;
use frontend\models\PosSalesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PosSalesController implements the CRUD actions for PosSales model.
 */
class PosSalesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PosSales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PosSalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PosSales model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PosSales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PosSales();
        $items = [new SalesItem()];
        $model->reference_number = PosSales::getLastReference();
        $model->status = PosSales::Draft;
        $model->maker_id = User::getUsername();
        $model->maker_time = User::getUserTime();

        if ($model->load(Yii::$app->request->post())) {
            $items = Model::createMultiple(SalesItem::classname());
            Model::loadMultiple($items, Yii::$app->request->post());
            //print_r($_POST['RequestQuotation']['total_amount']);
            // die();
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if ($flag = $model->save(false)) {
                    foreach ($items as $item) {
                        $item->sales_id = $model->id;
                        $item->tax_id = PosTaxconfig::getIdByTaxValue($item->tax);
                        if ($item->tax != null || $item->tax != 0) {
                            $item->tax = $item->total * $item->tax / 100;

                        } else {
                            $item->tax = 0.00;
                        }

                        $item->trn_dt = $model->trn_dt;
                        $item->maker_id = $model->maker_id;
                        $item->maker_time = $model->maker_time;
                        if (!($flag = $item->save(false))) {

                            $transaction->rollBack();
                            // break;
                        } else {
                            //saved
                            //TodayEntry::saveEntry('FNY', $model->reference, $model->trn_dt, $model->payment_account, $model->branch_id, $model->amount_paid, 'D', ExpenditureType::getModuleIDByPath(Yii::$app->controller->id));
                        }

                    }

                }

                if ($flag) {
                    $transaction->commit();

                    return $this->redirect(['view', 'id' => $model->id]);
                }

            } catch (Exception $e) {
                $transaction->rollBack();
            }
            Yii::$app->session->setFlash('', [
                'type' => 'success',
                'duration' => 3000,
                'icon' => 'fa fa-success',
                'message' => 'You have successfully created a sales draft',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model, 'items' => (empty($items)) ? [new SalesItem()] : $items
        ]);
    }

    /**
     * Confirms an existing RequestQuotation model.
     * If confirmation is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionConfirm($id)
    {
        $model = $this->findModel($id);
        PosSales::updateAll(['status' => PosSales::Sales_Order], ['id' => $id]);

        $trn_dt = $model->maker_time;
        $pmtAmount = $model->total_amount;
        $totalTaxIncl = $model->total_amount;


        ########SEND TRA##########


        //URL CONFIGURATION FROM BACKEND
        $url = UrlConfig::find()->where(['name' => 'INVOICE/RECEIPT'])->one();
        $domainName = $url['domain_name'];
        $hostURL = $url['url'];

        //for TOKEN REQUEST
        $tokenRequestURL = UrlConfig::find()->where(['name' => 'TOKEN REQUEST'])->one();

        //FOR VERIFY RECEIPT
        $verifyReceiptURL = UrlConfig::find()->where(['name' => 'VERIFY RECEIPT'])->one();
        $company = Company::find()->where(['id' => 1])->one();

        $company_id = $company->id;
        $username = $company->company_username;
        $password = $company->password;
        $certificate_password = $company->certificate_password;
        $cs = $company->certificate_serial;
        $current_time = date('H:i:s', strtotime($trn_dt));
        $verification_time = date('His', strtotime($trn_dt));
        $current_date = date('Y-m-d', strtotime($trn_dt));
        $znum = date('Ymd', strtotime($trn_dt));
        $tin = $company->tin;
        $regId = $company->registration_id;
        $efdSerial = $company->serial_number;
        $RCTVNUM = $company->receipt_number;

        $custType = 6;
        $custId = null;
        $custName = null;
        $mobile = null;


        $Items = SalesItem::find()
            ->where(['sales_id' => $model->id])
            ->all();

        foreach ($Items as $key => $Item) {

            $product = Product::findOne(['id' => $Item->product_id]);
            $taxPercent = PosTaxconfig::find()->where(['company_id' => 1])->one();
            $vatRate = $taxPercent['taxCode'];
            $taxCode = $taxPercent['taxId'];

            $sold_items_data[] =
                [
                    'ITEM' => [
                        'ID' => $product->id,
                        'DESC' => $product->product_name,
                        'QTY' => $Item->qty,
                        'TAXCODE' => $taxCode,
                        'AMT' => $Item->selling_price,
                    ]
                ];


            $totalTaxExcl[] = $Item->total;
            $taxAmount[] = $Item->tax;
            $netAmount[] = $totalTaxExcl;

        }

        $DCounter = DailyCounter::find()
            ->where(['company_id' => $company_id])
            ->max('reference_no');

        $check_last = DailyCounter::find()
            ->where(['company_id' => $company_id])
            ->orderBy(['id' => SORT_DESC])
            ->one();

        if ($DCounter != '') {

            if ($current_date == $check_last->created_at) {

                $daily_counter = $check_last['reference_no'] + 1;


            } elseif ($current_date > $check_last->created_at) {

                $daily_counter = '1';
            }

        } else {

            $daily_counter = 1;
        }

        $model_global = GlobalCounter::find()
            ->where(['company_id' => $company_id])
            ->max('reference_no');

        $check_last_number = GlobalCounter::find()
            ->where(['company_id' => $company_id])
            ->orderBy(['id' => SORT_DESC])
            ->one();

        if ($model_global != null) {

            $global_counter = $check_last_number['reference_no'] + 1;

        } else {

            $global_counter = 1;

        }

        function arrayToXml($array, $rootElement = null, $xml = null)
        {
            $_xml = $xml;
            // If there is no Root Element then insert root
            if ($_xml === null) {
                $_xml = new SimpleXMLElement($rootElement !== null ? $rootElement : '<RCT/>');
            }

            // Visit all key value pair
            foreach ($array as $k => $v) {

                // If there is nested array then
                if (is_array($v)) {

                    // Call function for nested array
                    arrayToXml($v, $k, $_xml->addChild($k));
                } else {

                    // Simply add child element.
                    $_xml->addChild($k, $v);
                }
            }

            return $_xml->asXML();
        }

        $discount = 0.00;
        $pmtType = 'CASH';
        $array_item_data = $sold_items_data;
        $vatTotal = array('VATRATE' => $vatRate,
            'NETTAMOUNT' => $netAmount,
            'TAXAMOUNT' => $taxAmount
        );
        $total = array(//'TOTALTAXEXCL' => $totalTaxExcl,
            'TOTALTAXEXCL' => $totalTaxExcl,
            'TOTALTAXINCL' => $totalTaxIncl,
            'DISCOUNT' => $discount
        );
        $payment = array('PMTTYPE' => $pmtType,
            'PMTAMOUNT' => $pmtAmount
        );

        $fiscal_code = $RCTVNUM . $global_counter;
        $RCTNUM = $global_counter;

        $arrayReceipt = array('DATE' => $current_date,
            'TIME' => $current_time,
            'TIN' => $tin,
            'REGID' => $regId,
            'EFDSERIAL' => $efdSerial,
            'CUSTIDTYPE' => $custType,
            'CUSTID' => $custId,
            'CUSTNAME' => $custName,
            'MOBILENUM' => $mobile,
            'RCTNUM' => $RCTNUM,
            'DC' => $daily_counter,
            'GC' => $global_counter,
            'ZNUM' => $znum,
            'RCTVNUM' => $fiscal_code,
            'ITEMS' => $array_item_data,
            'TOTALS' => $total,
            'PAYMENTS' => $payment,
            'VATTOTALS' => $vatTotal
        );

        $xml = arrayToXml($arrayReceipt);
        $xml_converted = trim(str_replace('<?xml version="1.0"?>', '', $xml));
        $item_key_data = array_keys($array_item_data);
        $itemsArraySize = count($array_item_data);

        for ($i = 0; $i < $itemsArraySize; $i++) {
            $string = $item_key_data[$i] . ',';
            $string_serialize = rtrim($string, ", ");
            $xml_converted = trim(str_replace("<$string_serialize>", '', $xml_converted));
            $xml_converted = trim(str_replace("</$string_serialize>", '', $xml_converted));
        }

        $xml_converted = str_replace("\r\n", "", $xml_converted);
        $xml_converted = simplexml_load_string($xml_converted);
        $xml_converted = dom_import_simplexml($xml_converted)->ownerDocument;
        $xml_converted = $xml_converted->saveXML($xml_converted->documentElement, LIBXML_NOEMPTYTAG);



        ####################################CHECK SERVER AVAILABILITY ####################

        $urlReceipt = $hostURL;
        $file_headers = @get_headers($urlReceipt);
        if (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {

            ####################################OFFLINE BLOCK ####################

            print_r('hello');
            die;


        }
        else{


            ####################################ONLINE BLOCK####################

            $urlToken = $tokenRequestURL['url'];

            $xml_doc = "<?xml version='1.0' encoding='UTF-8'?>";
            $efdms_open = "<EFDMS>";
            $efdms_close = "</EFDMS>";

            $headerToken = array(
                'Content-type: application/x-www-form-urlencoded',
            );
            // $userData = "username=babaadjc8490hedy&password=TdfL6o$3pzndV9v[&grant_type=password";
            $userData = "username=$username&password=$password&grant_type=password";
            $curlToken = curl_init($urlToken);
            curl_setopt($curlToken, CURLOPT_HTTPHEADER, $headerToken);
            curl_setopt($curlToken, CURLOPT_POST, true);
            curl_setopt($curlToken, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curlToken, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curlToken, CURLOPT_POSTFIELDS, $userData);
            curl_setopt($curlToken, CURLOPT_RETURNTRANSFER, true);
            try {
                $resultToken = curl_exec($curlToken);
                if (curl_errno($curlToken)) {
                    throw new \Exception(curl_error($curlToken));
                }
                curl_close($curlToken);
                $at = json_decode($resultToken, true);
                $access_token = $at['access_token'];

                $cert_info = array();
                $cert_store = file_get_contents("file/$company->file");
                $isGenerated = openssl_pkcs12_read($cert_store, $cert_info, $certificate_password);
                if (!$isGenerated) {
                    throw new \RuntimeException(('Invalid Password'));
                }
                $public_key = $cert_info['cert'];
                $private_key = $cert_info['pkey'];
                $pkeyid = openssl_get_privatekey($private_key);
                if (!$pkeyid) {
                    throw new \RuntimeException(('Invalid private key'));
                }


                Yii::$app->session->setFlash('', [
                    'type' => 'success',
                    'duration' => 3000,
                    'icon' => 'fas fa-warning',
                    'message' => 'You have successfully confirmed a sales order',
                    'positonY' => 'bottom',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['view', 'id' => $id]);

            } catch (\Exception $e) {

                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 3000,
                    'icon' => 'fas fa-warning',
                    'message' => 'Request Failed',
                    'positonY' => 'bottom',
                    'positonX' => 'right'
                ]);

                return $this->redirect(['view', 'id' => $id]);
            }

        }



    }


    /**
     * Updates an existing PosSales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PosSales model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PosSales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PosSales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PosSales::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


}
