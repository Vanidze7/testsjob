<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="ticket-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'adult')->dropDownList(\common\models\Ticket::$adultLabels) ?>
    <?= $form->field($model, 'type')->dropDownList(\common\models\Ticket::$typeLabels) ?>
    <?= $form->field($model, 'price')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
