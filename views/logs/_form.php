<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Logs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="logs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'event_id')->textInput() ?>

    <?= $form->field($model, 'client_id')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'logtime')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'remoteIp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'romoteAddr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remoteHost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remotePort')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'httpAgent')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
