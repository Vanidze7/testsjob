<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $event->title;
$this->params['breadcrumbs'][] = ['label' => 'События', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="event-view">
    <div class="text-center">
        <h1><?= $event->title ?></h1>
        <img src="/">
    </div>
    <p><?= $event->description ?></p>
</div>
<div class="tickets-create-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList(\common\models\Ticket::$typeLabels) ?>
    <?= $form->field($model, 'adult')->dropDownList(\common\models\Ticket::$adultLabels) ?>

    <div class="form-group">
        <?= Html::submitButton('Заказать билет', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
