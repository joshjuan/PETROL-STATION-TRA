<?php

namespace frontend\controllers;

use backend\models\Company;
use common\models\User;
use frontend\models\Grade;
use frontend\models\Nozzel;
use frontend\models\OperationRequest;
use backend\models\PumpData;
use backend\models\Sales;
use Da\QrCode\QrCode;
use DateTime;
use frontend\models\CustomerCertificate;
use frontend\models\CustomerConfig;
use frontend\models\DailyCounter;
use frontend\models\Fiscalcountertype;
use frontend\models\Fiscaldaycounters;
use frontend\models\Fiscaldaynumber;
use frontend\models\GlobalCounter;
use frontend\models\Pump;
use frontend\models\ReceiptData;
use frontend\models\SignupForm;
use frontend\models\Taxconfig;
use frontend\modules\gateway\models\CompanyInvoice;
use frontend\modules\gateway\models\CompanyInvoiceItem;
use kartik\mpdf\Pdf;
use Psr\Log\NullLogger;
use SimpleXMLElement;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\ContentNegotiator;
use yii\helpers\Json;
use const http\Client\Curl\Versions\CURL;


class PsmsTraController extends \yii\rest\ActiveController
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }






    protected function verbs()
    {
        return [
            'login' => ['POST'],
            'pts' => ['POST'],
            'change-price' => ['POST'],

        ];
    }

}



