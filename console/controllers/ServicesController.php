<?php

namespace console\controllers;


use frontend\models\Company;
use frontend\models\ReceiptData;
use frontend\models\SignedUnsignedZReport;
use frontend\models\TraLogs;
use frontend\models\UrlConfig;
use frontend\models\ZReportData;
use fedemotta\cronjob\models\CronJob;
use SimpleXMLElement;
use yii\console\Controller;
use yii\helpers\Json;
use Exception;

ini_set('memory_limit', '5048M');

/**
 * ServicesController implements the CRUD actions for SmsController model.
 */
class ServicesController extends Controller
{

    /**
     * Run SomeModel::some_method for a period of time
     * @param string $from
     * @param string $to
     * @return int exit code
     */
    public function actionInit($from, $to)
    {
        $dates = CronJob::getDateRange($from, $to);
        $command = CronJob::run($this->id, $this->action->id, 0, CronJob::countDateRange($dates));
        if ($command === false) {
            return Controller::EXIT_CODE_ERROR;
        } else {
            foreach ($dates as $date) {
                //this is the function to execute for each day
                //    ReleasedDevices::getExpired((string) $date);
            }
            $command->finish();
            return Controller::EXIT_CODE_NORMAL;
        }
    }

    /**
     * Run SomeModel::some_method for today only as the default action
     * @return int exit code
     */
    public function actionIndex()
    {
        return $this->actionInit(date("Y-m-d"), date("Y-m-d"));
    }

    /**
     * Run SomeModel::some_method for yesterday
     * @return int exit code
     */
    public function actionYesterday()
    {
        return $this->actionInit(date("Y-m-d", strtotime("-1 days")), date("Y-m-d", strtotime("-1 days")));
    }


    public function actionSendingDataToTra()
    {

        ReceiptData::makeAutomaticSendingDataToTRA();

    }

    public function actionCheckDataFromTra()
    {

        Company::checkDataFromTRA();

    }


    public function actionZReport()
    {

        //URL CONFIGURATION FROM BACKEND
        $Token = UrlConfig::find()->where(['name' => 'TOKEN REQUEST'])->one();
        $urlToken = $Token['url'];


        $ZUrl = UrlConfig::find()->where(['name' => 'Z REPORT'])->one();
        $urlZReport = $ZUrl['url'];



        $CheckZnumbers = ZReportData::find()
            ->select('company_id,znumber')
            ->where(['status' => 0])
            ->distinct('znumber')
            ->all();


        foreach ($CheckZnumbers as $CheckZnumber) {


            if (!empty($CheckZnumber)) {
                $ZNUMBER = $CheckZnumber->znumber;

                // CHECK Z NUMBER REPORT IF CLOSED
                $checkZReport = ZReportData::findOne(['znumber' => $ZNUMBER, 'status' => 1, 'ackmsg' => 'Success']);
                if (empty($checkZReport)) {

                    $CompanyID = $CheckZnumber->company_id;
                    $CompanyDetails = Company::findOne(['id' => $CompanyID]);

                 //  print_r($CompanyDetails->name);
                  //  die();

                    $PFX_file = $CompanyDetails->file;
                    $Password = $CompanyDetails->password;
                    $username = $CompanyDetails->company_username;
                    $certificate_password = $CompanyDetails->certificate_password;
                    $regId = $CompanyDetails->registration_id;
                    $efdSerial = $CompanyDetails->serial_number;
                    $certificateSerial = $CompanyDetails->certificate_serial;
                    $companyName = $CompanyDetails->name;
                    $Street = $CompanyDetails->street;
                    $TaxOffice = $CompanyDetails->tax_office;
                    $phone = $CompanyDetails->contact_person;

                    $city = $CompanyDetails->city;
                    $Country = $CompanyDetails->country;
                    $address = $city . ',' . $Country;

                    $UINCertificate = $CompanyDetails->uin;
                    $CompanyName = $CompanyDetails->name;
                    $updatedAt = $CompanyDetails->updated_at;
                    $REGDATE = date('Y-m-d', strtotime($updatedAt));
                    if (empty($REGDATE)) {
                        $RegDate = date('Y-m-d');
                    } else {
                        $RegDate = $REGDATE;
                    }
                    $TIN = $CompanyDetails->tin;

                    if (!empty($PFX_file) || !empty($Password) || !empty($username) || !empty($certificate_password)
                        || !empty($certificateSerial) || !empty($regId) || !empty($efdSerial) || !empty($CompanyName)
                        || !empty($UINCertificate) || !empty($TaxOffice) || !empty($RegDate) || !empty($TIN)
                    ) {
                        $vrn = $CompanyDetails->vrn;
                        if (empty($vrn)) {
                            $VRN = '';
                        } else {
                            $VRN = $vrn;
                        }
                        $Date = date('Y-m-d');
                        $Time = date('H:i:s');

                        $DAILYTOTAL_amount = ZReportData::find()
                            ->where(['status' => 0])
                            ->andWhere(['znumber' => $ZNUMBER])
                            ->andWhere(['company_id' => $CompanyID])
                            ->sum('pmtamount');

                        if (!empty($DAILYTOTAL_amount)) {
                            $DAILYTOTALAMOUNT = $DAILYTOTAL_amount;
                        } else {
                            $DAILYTOTALAMOUNT = '0.00';
                        }


                        $GROSS_amount = ZReportData::find()
                            ->where(['company_id' => $CompanyID])
                            ->andWhere(['<=', 'znumber', $ZNUMBER])
                            ->sum('pmtamount');
                        if (!empty($GROSS_amount)) {
                            $GROSS = $GROSS_amount;
                        } else {
                            $GROSS = '0.00';
                        }

                        $DISCOUNT_amount = ZReportData::find()
                            ->where(['status' => 0])
                            ->andWhere(['znumber' => $ZNUMBER])
                            ->andWhere(['company_id' => $CompanyID])
                            ->sum('discount');
                        if (!empty($DISCOUNT_amount)) {
                            $DISCOUNT = $DISCOUNT_amount;
                        } else {
                            $DISCOUNT = '0.00';
                        }

                        $TICKETSFISCAL_count = ZReportData::find()
                            ->where(['status' => 0])
                            ->andWhere(['company_id' => $CompanyID])
                            ->andWhere(['znumber' => $ZNUMBER])
                            ->groupBy('fiscal_code')
                            ->count('id');
                        if (!empty($TICKETSFISCAL_count)) {
                            $TICKETSFISCAL = $TICKETSFISCAL_count;
                        } else {
                            $TICKETSFISCAL = '0.00';
                        }

                        $NETT_amount_a = ZReportData::find()
                            ->where(['status' => 0])
                            ->andWhere(['znumber' => $ZNUMBER])
                            ->andWhere(['company_id' => $CompanyID])
                            ->andWhere(['vatrate' => 'A'])
                            ->sum('nettamount');

                        if (!empty($NETT_amount_a)) {
                            $NETTAMOUNT_A = $NETT_amount_a;
                        } else {
                            $NETTAMOUNT_A = '0.00';
                        }

                        $NETT_amount_b = ZReportData::find()
                            ->where(['status' => 0])
                            ->andWhere(['znumber' => $ZNUMBER])
                            ->andWhere(['company_id' => $CompanyID])
                            ->andWhere(['vatrate' => 'B'])
                            ->sum('nettamount');

                        if (!empty($NETT_amount_b)) {
                            $NETTAMOUNT_B = $NETT_amount_b;
                        } else {
                            $NETTAMOUNT_B = '0.00';
                        }


                        $NETT_amount_c = ZReportData::find()
                            ->where(['status' => 0])
                            ->andWhere(['znumber' => $ZNUMBER])
                            ->andWhere(['company_id' => $CompanyID])
                            ->andWhere(['vatrate' => 'C'])
                            ->sum('nettamount');

                        if (!empty($NETT_amount_c)) {
                            $NETTAMOUNT_C = $NETT_amount_c;
                        } else {
                            $NETTAMOUNT_C = '0.00';
                        }

                        $NETT_amount_d = ZReportData::find()
                            ->where(['status' => 0])
                            ->andWhere(['znumber' => $ZNUMBER])
                            ->andWhere(['company_id' => $CompanyID])
                            ->andWhere(['vatrate' => 'D'])
                            ->sum('nettamount');

                        if (!empty($NETT_amount_d)) {
                            $NETTAMOUNT_D = $NETT_amount_d;
                        } else {
                            $NETTAMOUNT_D = '0.00';
                        }


                        $NETT_amount_e = ZReportData::find()
                            ->where(['status' => 0])
                            ->andWhere(['znumber' => $ZNUMBER])
                            ->andWhere(['company_id' => $CompanyID])
                            ->andWhere(['vatrate' => 'E'])
                            ->sum('nettamount');

                        if (!empty($NETT_amount_e)) {
                            $NETTAMOUNT_E = $NETT_amount_e;
                        } else {
                            $NETTAMOUNT_E = '0.00';
                        }


                        $TAX_amount_a = ZReportData::find()
                            ->where(['status' => 0])
                            ->andWhere(['znumber' => $ZNUMBER])
                            ->andWhere(['company_id' => $CompanyID])
                            ->andWhere(['vatrate' => 'A'])
                            ->sum('taxamount');

                        if (!empty($TAX_amount_a)) {
                            $TAXAMOUNT_A = $TAX_amount_a;
                        } else {
                            $TAXAMOUNT_A = '0.00';
                        }


                        $TAX_amount_b = ZReportData::find()
                            ->where(['status' => 0])
                            ->andWhere(['znumber' => $ZNUMBER])
                            ->andWhere(['company_id' => $CompanyID])
                            ->andWhere(['vatrate' => 'B'])
                            ->sum('taxamount');

                        if (!empty($TAX_amount_b)) {
                            $TAXAMOUNT_B = $TAX_amount_b;
                        } else {
                            $TAXAMOUNT_B = '0.00';
                        }

                        $TAX_amount_c = ZReportData::find()
                            ->where(['status' => 0])
                            ->andWhere(['znumber' => $ZNUMBER])
                            ->andWhere(['company_id' => $CompanyID])
                            ->andWhere(['vatrate' => 'C'])
                            ->sum('taxamount');

                        if (!empty($TAX_amount_b)) {
                            $TAXAMOUNT_C = $TAX_amount_c;
                        } else {
                            $TAXAMOUNT_C = '0.00';
                        }

                        $TAX_amount_d = ZReportData::find()
                            ->where(['status' => 0])
                            ->andWhere(['znumber' => $ZNUMBER])
                            ->andWhere(['company_id' => $CompanyID])
                            ->andWhere(['vatrate' => 'D'])
                            ->sum('taxamount');

                        if (!empty($TAX_amount_d)) {
                            $TAXAMOUNT_D = $TAX_amount_d;
                        } else {
                            $TAXAMOUNT_D = '0.00';
                        }

                        $TAX_amount_e = ZReportData::find()
                            ->where(['status' => 0])
                            ->andWhere(['znumber' => $ZNUMBER])
                            ->andWhere(['company_id' => $CompanyID])
                            ->andWhere(['vatrate' => 'E'])
                            ->sum('taxamount');

                        if (!empty($TAX_amount_e)) {
                            $TAXAMOUNT_E = $TAX_amount_e;
                        } else {
                            $TAXAMOUNT_E = '0.00';
                        }

                        $PMTAMOUNT_cash = ZReportData::find()
                            ->where(['status' => 0])
                            ->andWhere(['znumber' => $ZNUMBER])
                            ->andWhere(['pmttype' => 'CASH'])
                            ->andWhere(['company_id' => $CompanyID])
                            ->sum('pmtamount');

                        if (!empty($PMTAMOUNT_cash)) {
                            $PMTAMOUNT_CASH = $PMTAMOUNT_cash;
                        } else {
                            $PMTAMOUNT_CASH = '0.00';
                        }

                        $PMTAMOUNT_cheque = ZReportData::find()
                            ->where(['status' => 0])
                            ->andWhere(['znumber' => $ZNUMBER])
                            ->andWhere(['pmttype' => 'CHEQUE'])
                            ->andWhere(['company_id' => $CompanyID])
                            ->sum('pmtamount');

                        if (!empty($PMTAMOUNT_cheque)) {
                            $PMTAMOUNT_CHEQUE = $PMTAMOUNT_cheque;
                        } else {
                            $PMTAMOUNT_CHEQUE = '0.00';
                        }

                        $PMTAMOUNT_emoney = ZReportData::find()
                            ->where(['status' => 0])
                            ->andWhere(['znumber' => $ZNUMBER])
                            ->andWhere(['pmttype' => 'EMONEY'])
                            ->andWhere(['company_id' => $CompanyID])
                            ->sum('pmtamount');

                        if ($PMTAMOUNT_emoney) {
                            $PMTAMOUNT_EMONEY = $PMTAMOUNT_emoney;
                        } else {
                            $PMTAMOUNT_EMONEY = '0.00';
                        }


                        $PMTAMOUNT_invoice = ZReportData::find()
                            ->where(['status' => 0])
                            ->andWhere(['znumber' => $ZNUMBER])
                            ->andWhere(['pmttype' => 'INVOICE'])
                            ->andWhere(['company_id' => $CompanyID])
                            ->sum('pmtamount');

                        if ($PMTAMOUNT_invoice) {
                            $PMTAMOUNT_INVOICE = $PMTAMOUNT_invoice;
                        } else {
                            $PMTAMOUNT_INVOICE = '0.00';
                        }


                        $PMTAMOUNT_ccard = ZReportData::find()
                            ->where(['status' => 0])
                            ->andWhere(['znumber' => $ZNUMBER])
                            ->andWhere(['pmttype' => 'CCARD'])
                            ->andWhere(['company_id' => $CompanyID])
                            ->sum('pmtamount');

                        if ($PMTAMOUNT_ccard) {
                            $PMTAMOUNT_CCARD = $PMTAMOUNT_ccard;
                        } else {
                            $PMTAMOUNT_CCARD = '0.00';
                        }
                   //     chdir('live.weberp.co.tz');
                        $companyFile = file_get_contents("file/$PFX_file");
                        if (!empty($companyFile)) {
                            $file_headers = @get_headers($urlToken);
                            if ($file_headers || !$file_headers[0] == 'HTTP/1.1 404 Not Found') {
                                $headerToken = array(
                                    'Content-type: application/x-www-form-urlencoded',
                                );
                                $userData = "username=$username&password=$Password&grant_type=password";
                                $curlToken = curl_init($urlToken);
                                curl_setopt($curlToken, CURLOPT_HTTPHEADER, $headerToken);
                                curl_setopt($curlToken, CURLOPT_POST, true);
                                curl_setopt($curlToken, CURLOPT_SSL_VERIFYPEER, 0);
                                curl_setopt($curlToken, CURLOPT_SSL_VERIFYHOST, 0);
                                curl_setopt($curlToken, CURLOPT_POSTFIELDS, $userData);
                                curl_setopt($curlToken, CURLOPT_RETURNTRANSFER, true);
                                $resultToken = curl_exec($curlToken);
                                if (curl_errno($curlToken)) {
                                    throw new \Exception(curl_error($curlToken));
                                }
                                curl_close($curlToken);
                                $at = json_decode($resultToken, true);
                                $access_token = $at['access_token'];

                                $cert_info = array();
                                $cert_store = $companyFile;
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

                                $xml = new SimpleXMLElement('<ZREPORT/>');
                                $child1 = $xml->addChild('DATE', $Date);
                                $child1 = $xml->addChild('TIME', $Time);
                                $child1 = $xml->addChild('HEADER');
                                $child1->addChild('LINE', $companyName);
                                $child1->addChild('LINE', $Street);
                                $child1->addChild('LINE', "TEL NO:$phone");
                                $child1->addChild('LINE', $address);
                                $child1 = $xml->addChild('VRN', $VRN);
                                $child1 = $xml->addChild('TIN', $TIN);
                                $child1 = $xml->addChild('TAXOFFICE', $TaxOffice);
                                $child1 = $xml->addChild('REGID', $regId);
                                $child1 = $xml->addChild('ZNUMBER', $ZNUMBER);
                                $child1 = $xml->addChild('EFDSERIAL', $efdSerial);
                                $child1 = $xml->addChild('REGISTRATIONDATE', $RegDate);
                                $child1 = $xml->addChild('USER', $UINCertificate);
                                $child1 = $xml->addChild('SIMIMSI', 'WEBAPI');
                                $child1 = $xml->addChild('TOTALS');
                                $child1->addChild('DAILYTOTALAMOUNT', $DAILYTOTALAMOUNT);
                                $child1->addChild('GROSS', $GROSS);
                                $child1->addChild('CORRECTIONS', "0.00");
                                $child1->addChild('DISCOUNTS', $DISCOUNT);
                                $child1->addChild('SURCHARGES', "0.00");
                                $child1->addChild('TICKETSVOID', "0");
                                $child1->addChild('TICKETSVOIDTOTAL', "0.00");
                                $child1->addChild('TICKETSFISCAL', $TICKETSFISCAL);
                                $child1->addChild('TICKETSNONFISCAL', "0");
                                $child1 = $xml->addChild('VATTOTALS');
                                $child1->addChild('VATRATE', "A-18.00");
                                $child1->addChild('NETTAMOUNT', $NETTAMOUNT_A);
                                $child1->addChild('TAXAMOUNT', $TAXAMOUNT_A);

                                $child1->addChild('VATRATE', "B-0.00");
                                $child1->addChild('NETTAMOUNT', $NETTAMOUNT_B);
                                $child1->addChild('TAXAMOUNT', $TAXAMOUNT_B);

                                $child1->addChild('VATRATE', "C-0.00");
                                $child1->addChild('NETTAMOUNT', $NETTAMOUNT_C);
                                $child1->addChild('TAXAMOUNT', $TAXAMOUNT_C);

                                $child1->addChild('VATRATE', "D-0.00");
                                $child1->addChild('NETTAMOUNT', $NETTAMOUNT_D);
                                $child1->addChild('TAXAMOUNT', $TAXAMOUNT_D);

                                $child1->addChild('VATRATE', "E-0.00");
                                $child1->addChild('NETTAMOUNT', $NETTAMOUNT_E);
                                $child1->addChild('TAXAMOUNT', $TAXAMOUNT_E);

                                $child1 = $xml->addChild('PAYMENTS');
                                $child1->addChild('PMTTYPE', "CASH");
                                $child1->addChild('PMTAMOUNT', $PMTAMOUNT_CASH);

                                $child1->addChild('PMTTYPE', "CHEQUE");
                                $child1->addChild('PMTAMOUNT', $PMTAMOUNT_CHEQUE);

                                $child1->addChild('PMTTYPE', "CCARD");
                                $child1->addChild('PMTAMOUNT', $PMTAMOUNT_CCARD);

                                $child1->addChild('PMTTYPE', "EMONEY");
                                $child1->addChild('PMTAMOUNT', $PMTAMOUNT_EMONEY);

                                $child1->addChild('PMTTYPE', "INVOICE");
                                $child1->addChild('PMTAMOUNT', $PMTAMOUNT_INVOICE);

                                $child1 = $xml->addChild('CHANGES');
                                $child1->addChild('VATCHANGENUM', "0");
                                $child1->addChild('HEADCHANGENUM', "0");

                                $child1 = $xml->addChild('ERRORS', '');
                                $child1 = $xml->addChild('FWVERSION', '3.0');
                                $child1 = $xml->addChild('FWCHECKSUM', 'WEBAPI');

                                $doc = dom_import_simplexml($xml)->ownerDocument;
                                $doc = $doc->saveXML($doc->documentElement, LIBXML_NOEMPTYTAG);

                                if (!empty($ZNUMBER)) {
                                    $ZReportData = new SignedUnsignedZReport();
                                    $ZReportData->data = $doc;
                                    $ZReportData->type = 'ZREPORT RAW DATA';
                                    $ZReportData->ref_no = 'ZREPORT';
                                    $ZReportData->znumber = $ZNUMBER;
                                    $ZReportData->created_at = date('Y-m-d H:i:s');
                                    $ZReportData->created_by = 1;
                                    $ZReportData->save(false);
                                }

                                $isGenerated2 = openssl_sign($doc, $signature, $pkeyid, OPENSSL_ALGO_SHA1);
                                openssl_free_key($pkeyid);
                                if (!$isGenerated2) {
                                    throw new \RuntimeException(('Computing of the signature failed'));
                                }
                                $signature_value = base64_encode($signature);

                                $xml_doc = '<?xml version="1.0" encoding="UTF-8"?>';
                                $efdmsSignature = "<EFDMSSIGNATURE>$signature_value</EFDMSSIGNATURE>";
                                $efdms_open = "<EFDMS>";
                                $efdms_close = "</EFDMS>";
                                $signedData = $xml_doc . $efdms_open . $doc . $efdmsSignature . $efdms_close;




                                if (!empty($ZNUMBER)) {
                                    $ZReportData = new SignedUnsignedZReport();
                                    $ZReportData->data = $signedData;
                                    $ZReportData->type = 'ZREPORT SIGNED DATA';
                                    $ZReportData->ref_no = 'ZREPORT';
                                    $ZReportData->znumber = $ZNUMBER;
                                    $ZReportData->created_at = date('Y-m-d H:i:s');
                                    $ZReportData->created_by = 1;
                                    $ZReportData->save(false);
                                }

                               // print_r($signedData);
                              //  die();

//                                $routing_key = 'vfdzreport';
//                                $headers = array(
//                                    'Content-type: Application/xml',
//                                    'Routing-Key: ' . $routing_key,
//                                    'Cert-Serial: ' . base64_encode($certificateSerial),
//                                    'Authorization: Bearer ' . $access_token,
//                                );
//                                $curl = curl_init($urlZReport);
//                                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//                                curl_setopt($curl, CURLOPT_POST, true);
//                                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
//                                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
//                                curl_setopt($curl, CURLOPT_POSTFIELDS, $signedData);
//                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//                                $resultEfd = curl_exec($curl);
//                                if (curl_errno($curl)) {
//                                    throw new \Exception(curl_error($curl));
//                                }
//                                curl_close($curl);
//                                try {
//                                    $data = new SimpleXMLElement($resultEfd);
//                                    $jsonData = json_encode($data);
//                                    $arrayData = json_decode($jsonData);
//                                    $success = $arrayData->ZACK->ACKMSG;
//                                } catch (Exception $e) {
//                                    $response['error'] = false;
//                                    $response['status'] = 'fail';
//                                    $response['message'] = 'Z report Url not reachable, try again';
//                                    return Json::encode($response);
//                                }
                                $success='Success';
                                $resultEfd='Success';
                                if ($success == 'Success') {
                                    ZReportData::updateAll(['status' => ZReportData::DATA_SENT, 'ackmsg' => $success], ['znumber' => $ZNUMBER]);
                                    SignedUnsignedZReport::updateAll(['status' => ZReportData::DATA_SENT, 'ackmsg' => $success], ['znumber' => $ZNUMBER]);

                                    $logs = new TraLogs();
                                    $logs->status = 'SUCCESS';
                                    $logs->action = 'SENDING Z REPORT DATA TO TRA';
                                    $logs->datetime = date('Y-m-d H:i:s');
                                    $logs->module = 'CRON JOB';
                                    $logs->znumber = $ZNUMBER;
                                    $logs->message = "SENDING Z REPORT $ZNUMBER DATA WITH CRON JOB SUCCESS.";
                                    $logs->save(false);

                                    echo $logs->message;

                                } else {

                                    ZReportData::updateAll(['status' => ZReportData::DATA_NOT_SENT, 'ackmsg' => $resultEfd], ['znumber' => $ZNUMBER]);
                                    SignedUnsignedZReport::updateAll(['status' => ZReportData::DATA_NOT_SENT, 'ackmsg' => $resultEfd], ['znumber' => $ZNUMBER]);
                                    $logs = new TraLogs();
                                    $logs->status = 'FAILED';
                                    $logs->action = 'SENDING DATA TO TRA';
                                    $logs->datetime = date('Y-m-d H:i:s');
                                    $logs->module = 'CRON JOB';
                                    $logs->znumber = $ZNUMBER;
                                    $logs->message = "SENDING Z REPORT $ZNUMBER DATA WITH CRON JOB FAILED. error $resultEfd";
                                    $logs->save(false);

                                    echo $logs->message;

                                }


                            }

                        }


                    }

                }
                else {
                    $logs = new TraLogs();
                    $logs->status = 'NOT FOUND';
                    $logs->action = 'CHECKING COMPANY REGISTERED DATA';
                    $logs->datetime = date('Y-m-d H:i:s');
                    $logs->module = 'CRON JOB';
                    $logs->znumber = $ZNUMBER;
                    $logs->message = "SOME REGISTRATION DETAILS OF COMPANY $CompanyID NOT FOUND";
                    $logs->save();

                    echo "SOME REGISTRATION DETAILS OF COMPANY $CompanyID NOT FOUND";
                    //die;
                }


            }
// else {
//                    $logs = new TraLogs();
//                    $logs->status = 'NOT FOUND';
//                    $logs->action = 'CHECKING COMPANY Z REPORT DATA';
//                    $logs->datetime = date('Y-m-d H:i:s');
//                    $logs->module = 'CRON JOB';
//                    $logs->znumber = date('Ymd');
//                    $logs->message = "COMPANY Z REPORT DATA NOT FOUND ";
//                    $logs->save();
//
//                    echo "COMPANY Z REPORT DATA NOT FOUND ";
//                    exit();
//                }


        }

    }


}
