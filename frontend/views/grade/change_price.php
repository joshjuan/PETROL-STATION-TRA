<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use richardfan\widget\JSRegister;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PumpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pumps Prices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pump-index">
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>Pump</th>
            <th>Nozzle</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody id="resultData">
        <?php foreach ($model as $md){
            echo '<tr><td id="pump_'.$md->pump_id.'">'.$md->pump_id.'</td>';
            echo '<td id="status_'.$md->pump_id.'"></td>';
            echo '<td id="nozzle_'.$md->pump_id.'"></td></tr>';

  ?>
<?php ob_start(); ?>

    <script>
        $("document").ready(function() {

              //  alert('yes');
                let idx = '';
                let json = '';
                let nozzel = '';


                idx = <?php echo $md->pump_id;?>

                // Form request
                var request = new Object();
                request.Protocol = "jsonPTS";
                request.Packets = new Array();

                var data = new Object();
                data.Pump = idx;

                var packet = new Object();
                packet.Id = 1;
                packet.Type = "PumpGetPrices";
                packet.Data = data;
                request.Packets.push(packet);


                $.ajax({
                    type: "POST",
                    url: "<?php echo Yii::$app->urlManager->createUrl(['psms/command']);?>",
                    data: {data: request},

                    success: function (responseData) {
                        json = $.parseJSON(responseData);
                        alert(json['Packets'][0]['Message']);
                    },

                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(ajaxOptions);
                        alert(ajaxOptions);
                    }


                });
        });




    </script>

<?php $this->registerJs(preg_replace('~^\s*<script.*>|</script>\s*$~ U', '', ob_get_clean())) ?>

        <?php }?>
        </tbody>
    </table>
</div>


