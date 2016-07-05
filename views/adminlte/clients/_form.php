<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Statuses;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\Models\Clients */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clients-form">


    <?php $form = ActiveForm::begin(); ?>

    <?php /* $form->field($model, 'id')->textInput() */ ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fname')->textarea(['rows' => 6]) ?>

    <?php //  $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
    <?php
     $items = ArrayHelper::map(Statuses::find()->all(), "id", "name");
    ?>
    <?= $form->field($model, 'status_id')->dropDownList($items, ['prompt'=>'Укажите статус']); ?>
    
    <?= $form->field($model, 'genAuthKey')->checkbox([0 => "Не активен", 1 => "Активен"]); ?>
    
  
    <?php $form->field($model, 'created')->textInput() ?>

    <?php  $form->field($model, 'updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
