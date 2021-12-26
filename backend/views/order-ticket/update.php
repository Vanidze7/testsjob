<?php

use yii\helpers\Html;

$this->title = 'Редактирование билетов заказа: ' . $model->order->id;
$this->params['breadcrumbs'][] = ['label' => 'Билеты заказов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="order-ticket-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
