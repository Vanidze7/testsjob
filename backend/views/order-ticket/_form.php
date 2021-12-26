<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="order-ticket-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'order_id')->dropDownList(\common\models\Order::getOrderList()) ?>
    <?= $form->field($model, 'ticket_id')->dropDownList(\common\models\Ticket::getTicketList()) ?>
    <?= $form->field($model, 'cost')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
