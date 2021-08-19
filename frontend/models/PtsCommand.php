<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pts_command".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $command_json_format
 */
class PtsCommand extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pts_command';
    }

    public static function GetFuelGradesConfiguration()
    {
        $data = [
            'Protocol' => 'jsonPTS',
            'Packets' => array([
                "Id" => 1,
                "Type" => "GetFuelGradesConfiguration",
            ])
        ];
        $result = PtsCommand::Command($data);
        $Json = json_decode($result, true);

        $grades = $Json['Packets'][0]['Data']['FuelGrades'];


        return $grades;


    }

    public static function GetPumps($gradeid)
    {

        $data = [
            'Protocol' => 'jsonPTS',
            'Packets' => array([
                "Id" => 1,
                "Type" => "GetPumpNozzlesConfiguration",
            ])
        ];
        $result = PtsCommand::Command($data);
        $Json = json_decode($result, true);

        $packets = $Json['Packets'][0];
        $grades = $packets['Data']['PumpNozzles'];

        foreach ($grades as $key => $items) {

            $ids = $items['FuelGradeIds'];

            $nKey = array_keys($ids, $gradeid);
            $pump = $items['PumpId'];
            $PumpData['PumpAndNozzels'][] =
                [
                    'Pump' => $pump,
                    'Nozzles' => $nKey
                ];

        }

        return $PumpData;


    }

    public static function GetPtsPumps()
    {
        $data = [
            'Protocol' => 'jsonPTS',
            'Packets' => array([
                "Id" => 1,
                "Type" => "GetPumpNozzlesConfiguration",
            ])
        ];
        $result = PtsCommand::Command($data);
        $Json = json_decode($result, true);


        $grades = $Json['Packets'][0]['Data']['PumpNozzles'];
//        print_r($grades);
//            die();
        $n = 0;

        foreach ($grades as $key => $items) {

            $id = (int)$items['PumpId'];
//            print_r($id);
//            die();


            $PumpsArray[] = $id;
        }


        return $PumpsArray;


    }

    public static function GetPtsNozzles()
    {
        $pump_id = 1;
        $data = [
            'Protocol' => 'jsonPTS',
            'Packets' => array([
                "Id" => 1,
                "Type" => "GetPumpNozzlesConfiguration",
            ])
        ];
        $result = PtsCommand::Command($data);
        $Json = json_decode($result, true);


        $grades = $Json['Packets'][0]['Data']['PumpNozzles'];


        foreach ($grades as $key => $items) {

            $id = (int)$items['PumpId'];
            if ($id == $pump_id) {

                $id = $items['FuelGradeIds'];


                $NozzleArray[] = $id;
            }
        }


        foreach ($NozzleArray[0] as $key => $items) {

            if ($items != 0) {

                $NozzleArray1[] = $items;
            }

        }


        return $NozzleArray1;


    }

    public static function Command($data)
    {

        try {

            // return Json
            $username = 'admin';
            $password = 'admin';
            $url = UrlConfig::getPtsUlr();
            $headers = array(
                "Content-Type: application/json; charset=utf-8",
                "Accept: application/json",
                "Authorization: Basic " . base64_encode($username . ":" . $password),
            );
            $datastring = json_encode($data);

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $datastring);
            $result = curl_exec($curl);
            curl_close($curl);

            //  $response= json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
            $response = json_decode($result, true);


            return json_encode($response);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public static function RemoteCommand($data, $url)
    {

        try {

            // return Json
            $username = 'admin';
            $password = 'xyz123456';
            $url = UrlConfig::GetRemoteUrl() . $url;

            $headers = array(
                "Content-Type: application/json; charset=utf-8",
                "Accept: application/json",
                "Authorization: Basic " . base64_encode($username . ":" . $password),
            );

            $datastring = json_encode($data);

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $datastring);
            $result = curl_exec($curl);
            curl_close($curl);

            $response = json_decode($result, true);


            return $response;
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public static function sendToTra($customer, $datetime, $sold_items_data, $totalTaxExcl, $taxAmount, $netAmount)
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        $company_code = Company::CODE;
        $data = [
            'PROTOCOL' => 'WEBVFD',
            'CODE' => $company_code,
            'CUSTOMER' => $customer,
            'DATETIME' => $datetime,
            'ITEMS' => $sold_items_data,
            'UNTAXEDTOTAL' => $totalTaxExcl,
            'TOTALTAX' => $taxAmount,
            'TAXEDTOTAL' => $netAmount,
        ];


        try {

            // return Json
            $username = 'admin';
            $password = 'xyz123456';
//            $access_token = '313jFMbaD-mzBj-pWBgHQdcCdGHmJQe2';
            $url = "http://localhost/web-gateway/index.php?r=webvfd/api/receive";

            $headers = array(
                "Content-Type: application/json; charset=utf-8",
                "Accept: application/json",
                "Authorization: Basic " . base64_encode($username . ":" . $password),
            );
            $datastring = json_encode($data);

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $datastring);
            $result = curl_exec($curl);
            curl_close($curl);

            // $response = json_decode($result, true);

//            print_r($result);
//            die();


            return $result;
        } catch (\Exception $exception) {
            return $exception;
        }


    }

    public static function remoteChangePrice()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        $ptsCode = '003B003E3438510935383138';
        $data = [
            'PROTOCOL' => 'WEBPSMS',
            'CODE' => $ptsCode,
        ];
        try {

            $response = PtsCommand::RemoteCommand($data, 'change-price');

            if ($response = PtsCommand::Command($response)) {
                $data = json_decode($response, true);
                if ($data['Packets'][0]['Message'] == 'OK') {
                    $responseData = [
                        'PROTOCOL' => 'WEBPSMS',
                        'CODE' => $ptsCode,
                        'MESSAGE' => 'OK',
                    ];
                    PtsCommand::RemoteCommand($responseData, 'update-price');
                }

                exit;
            }
        } catch (\Exception $exception) {
            return $exception;
        }


    }

    public static function getProducts()
    {
        return PtsCommand::GetFuelGradesConfiguration();

    }

    public static function GetPumpsByGradeId($id)
    {
        return PtsCommand::GetPumps($id);
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'command_json_format'], 'string', 'max' => 200],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'command_json_format' => Yii::t('app', 'Command Json Format'),
        ];
    }
}
