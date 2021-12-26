<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="event-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->dropDownList(\common\models\Event::$statusLabels) ?>
    <?= $form->field($model, 'count')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
