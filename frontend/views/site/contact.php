<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div>
        <div class="ticket">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="frontend/web/logo/img.png" width="200px" height="200px">
                </div>
            </div>
            <div class="row">
                <div class = "col-md-12 col-sm-12 col-xs-12 text-center"><b><br/>Start of Legal Receipt</b></div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <address style="alignment: center">
                         <br/>'.$name.'<br/>
                           ZNO:'.$evfdid.'<br/>
                        </address>
                    </div>
                </div>
            <div class="row">
                <div class = "col-md-12 col-sm-12 col-xs-12 text-center"><b>'.$address.'</b></div>
            </div>
            <div class="row">
                <div class = "col-md-6 col-sm-12 col-xs-12 text-right"><b>Trader: '.$traderno.'</b></div>
                <div class = "col-md-6 col-sm-12 col-xs-12 "><b>Phone: '.$phone.'</b></div>
            </div>
            <hr/>
            <div class="row">
                <div class = "col-md-6 col-sm-12 col-xs-12 text-right"><b>Receipt No: '.$receiptno.'</b></div>
                <div class = "col-md-6 col-sm-12 col-xs-12 "><b>Fiscal Day No: '.$fiscalDayNo.'</b></div>
            </div>
            <div class="row">
                <div class = "col-md-6 col-sm-12 col-xs-12 text-right"><b>VFD No: '.$vfdNo.'</b></div>
                <div class = "col-md-6 col-sm-12 col-xs-12 "><b>VFD ID: '.$eVFDID.'</b></div>
            </div>
            <hr/>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 text-right">
                        PUMP #: '.$sales->pump_no.'
                      NOZZEL #: '.$sales->nozzel_no.'

                    </div>
                    <hr/>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        DATE|TIME '.$sales->trn_dt.'
                        <hr/>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6 col-sm-12 col-xs-12 text-right">
                        UNLEADED: '. $sales->volume. ' x '.$sales->price.'
                     ' .Yii::$app->formatter->asDecimal($sales->total,2). '
                    </div>
                    <hr/>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 text-right">
                        SUB TOTAL:
                       '.Yii::$app->formatter->asDecimal($sales->sub_total,2).'

                    </div>
                    <hr/>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 text-right">
                        TAX :
                      '.Yii::$app->formatter->asDecimal($sales->tax,2).'

                    </div>
                    <hr/>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 text-right">
                        TOTAL:

                        '.Yii::$app->formatter->asDecimal($sales->total,2).'

                    </div>
                    <hr/>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    RECEIPT VERIFICATION CODE
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                        <img src="' . $qrCode->writeDataUri() . '">
                    </div>
                </div>
            <div class="row">
                <div class = "col-md-12 col-sm-12 col-xs-12 text-center"><b><br/>End of Legal Receipt</b></div>
            </div>
            </div>
</div>
