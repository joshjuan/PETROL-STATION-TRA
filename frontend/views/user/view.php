<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-group">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6 pull-left">
            <?= Html::a(Yii::t('app', 'Edit'), ['update', 'id' => $model->id], ['class'=>yii::$app->user->can('createUser') || yii::$app->User->can('admin') ? 'btn btn-primary enabled':'btn btn-primary disabled']) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), ['index'],  ['class'=>'btn btn-default']) ?>


        </div>
        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
            <div class="btn-group">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    Actions <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">

                    <?php

                    if($model->status== User::STATUS_ACTIVE) {
                        echo '<li>';
                        echo Html::a(Yii::t('app', ' Disable'), ['delete', 'id' => $model->id], [
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to disable this user account?'),
                                'method' => 'post',
                            ],
                        ]);
                        echo '</li>';
                    }elseif($model->status== User::STATUS_INACTIVE || $model->status== User::STATUS_DELETED ) {
                        echo '<li>';
                        echo Html::a(Yii::t('app', ' Enable'), ['enable', 'id' => $model->id], [
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to enable this user account?'),
                                'method' => 'post',
                            ],
                        ]);
                        echo '</li>';
                    }

                    ?>
                </ul>

            </div>
        </div>
    </div>
</div>
<hr/>
<div class="user-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            [
                'attribute' => 'status',
                'value' => $model->statusLabel,
            ],
            'role',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
