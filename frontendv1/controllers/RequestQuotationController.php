<?php

namespace frontend\controllers;

use frontend\models\Model;
use frontend\models\Product;
use frontend\models\ReceivedProduct;
use frontend\models\RequestQuotationItem;
use frontend\models\User;
use Yii;
use frontend\models\RequestQuotation;
use frontend\models\RequestQuotationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * RequestQuotationController implements the CRUD actions for RequestQuotation model.
 */
class RequestQuotationController extends Controller
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
     * Lists all RequestQuotation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequestQuotationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionRequests()
    {
        $searchModel = new RequestQuotationSearch();
        $dataProvider = $searchModel->searchRequests(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionOrders()
    {
        $searchModel = new RequestQuotationSearch();
        $dataProvider = $searchModel->searchPurchaseOrders(Yii::$app->request->queryParams);

        return $this->render('orders', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RequestQuotation model.
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
     * Creates a new RequestQuotation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RequestQuotation();
        $items = [new RequestQuotationItem()];
        $model->reference_number = RequestQuotation::getLastReference();
        $model->status = RequestQuotation::Draft;
        $model->maker = User::getUsername();
        $model->maker_time = User::getUserTime();


        if ($model->load(Yii::$app->request->post())) {
            $items = Model::createMultiple(RequestQuotationItem::classname());
            Model::loadMultiple($items, Yii::$app->request->post());
            //print_r($_POST['RequestQuotation']['total_amount']);
           // die();
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if ($flag = $model->save(false)) {
                    foreach ($items as $item) {
                        $item->request_quotation_id = $model->id;
                        $item->description = Product::getNameById($item->product_id);
                        if($item->tax != null || $item->tax != 0) {
                            $item->tax = $item->sub_total * $item->tax / 100;

                        }else{
                            $item->tax = 0.00;
                        }
                        $item->maker = $model->maker;
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
                'message' => 'You have successfully created a quotation draft',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,'items' => (empty($items)) ? [new RequestQuotationItem()] : $items
        ]);
    }

    /**
     * Updates an existing RequestQuotation model.
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
     * Deletes an existing RequestQuotation model.
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
     * Confirms an existing RequestQuotation model.
     * If confirmation is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionConfirm($id)
    {
        RequestQuotation::updateAll(['status' => RequestQuotation::Purchase_Order],['id' => $id]);
        $items = RequestQuotationItem::findAll(['request_quotation_id' => $id]);

        //saves awaiting product to receive

        foreach ($items as $item) {

            $awaitingProducts = new ReceivedProduct();
            $awaitingProducts->purchase_order_id = $item->request_quotation_id;
            $awaitingProducts->received_date = date('Y-m-d');
            $awaitingProducts->quantity = $item->quantity;
            $awaitingProducts->quantity = $item->quantity;
            $awaitingProducts->product_id = $item->product_id;
            $awaitingProducts->status = 0;
            $awaitingProducts->save(false);

            }


        Yii::$app->session->setFlash('', [
            'type' => 'success',
            'duration' => 3000,
            'icon' => 'fas fa-warning',
            'message' => 'You have successfully confirmed a purchasing order',
            'positonY' => 'bottom',
            'positonX' => 'right'
        ]);
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Finds the RequestQuotation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RequestQuotation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RequestQuotation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
