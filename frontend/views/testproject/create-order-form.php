<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CreateOrderForm */
/* @var $form ActiveForm */
?>
<div class="tickets-create-order-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'event_id')->dropDownList(\common\models\Event::getEventList()) ?>
        <?= $form->field($model, 'type')->dropDownList(\common\models\Ticket::$typeLabels) ?>
        <?= $form->field($model, 'adult')->dropDownList(\common\models\Ticket::$adultLabels) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- tickets-create-order-form -->
