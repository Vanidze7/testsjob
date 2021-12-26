<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="order-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'user_id')->dropDownList(\common\models\User::getUserList()) ?>
    <?= $form->field($model, 'event_id')->dropDownList(\common\models\Event::getEventList()) ?>
    <?= $form->field($model, 'status')->dropDownList(\common\models\Order::$statusLabels) ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
