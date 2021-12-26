<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Билеты заказов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-ticket-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Редактирование билетов заказа', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить билеты заказа', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'order_id',
                'value' => '<a href="' . \yii\helpers\Url::to(['order/view', 'id' => $model->order->id]) . '">' . $model->order->id . '</a>',
                'format' => 'raw',
            ],
            [
                'attribute' => 'ticket_id',
                'value' => '<a href="' . \yii\helpers\Url::to(['ticket/view', 'id' => $model->ticket->id]) . '">' . $model->ticket->title . '</a>',
                'format' => 'raw',
            ],
            'bar_code',
            'cost',
        ],
    ]) ?>

</div>
