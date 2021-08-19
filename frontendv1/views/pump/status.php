<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use richardfan\widget\JSRegister;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PumpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pumps Status');
$this->params['breadcrumbs'][] = $this->title;
$count = 0;
?>
<div class="pump-index">
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>Pump</th>
            <th>Status</th>
            <th>Nozzle</th>
        </tr>
        </thead>
        <tbody id="resultData">
        <?php foreach ($model as $md){
            echo '<tr><td id="pump_'.$md->pump_number.'">'.$md->pump_number.'</td>';
            echo '<td id="status_'.$md->pump_number.'"></td>';
            echo '<td id="nozzle_'.$md->pump_number.'"></td></tr>';

  ?>
<?php ob_start(); ?>

    <script>
        $("document").ready(function() {
            setInterval(function() {
                let idx = '';
                let json = '';
                let nozzel = '';


                idx = <?php echo $md->pump_number;?>

                // Form request
                var request = new Object();
                request.Protocol = "jsonPTS";
                request.Packets = new Array();

                var data = new Object();
                data.Pump = idx;

                var packet = new Object();
                packet.Id = 1;
                packet.Type = "PumpGetStatus";
                packet.Data = data;
                request.Packets.push(packet);


                    $.ajax({
                        type: "POST",
                        url: "<?php echo Yii::$app->urlManager->createUrl(['psms/command']);?>",
                        data: {data: request},

                        success: function (responseData) {
                            json = $.parseJSON(responseData);

                            nozzel = json['Packets'][0]['Type'];
                            if (nozzel === 'PumpIdleStatus') {
                               // alert(json['Packets'][0]['Data']['NozzleUp']);
                                if (json['Packets'][0]['Data']['NozzleUp'] === 0) {
                                    $("#status_" + idx).html('<span style="background: #1b6d85; padding: 10px" class="text text-white">IDLE</span>');
                                    $("#nozzle_" + idx).html(json['Packets'][0]['Data']['NozzleUp']).val();
                                } else {
                                    $("#status_" + idx).html('<span style="background: #0e5b44; padding: 10px" class="text text-white">NOZZLE</span>').val();
                                    $("#nozzle_" + idx).html(json['Packets'][0]['Data']['NozzleUp']).val();
                                }
                            } else if (nozzel === 'PumpFillingStatus') {
                                $("#status_" + idx).html('<span style="background: #0d3349; padding: 10px" class="text text-white">FILLING</span>');
                                $("#nozzle_" + idx).html(json['Packets'][0]['Data']['Nozzle']).val();
                            }


                        },

                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log(ajaxOptions);
                          //  alert(ajaxOptions);
                        }


                    });

                    }, 2000);


        });




    </script>

<?php $this->registerJs(preg_replace('~^\s*<script.*>|</script>\s*$~ U', '', ob_get_clean())) ?>

        <?php }?>
        </tbody>
    </table>
</div>


