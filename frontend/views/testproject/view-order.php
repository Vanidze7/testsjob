<?php

/** @var $order Order */
/** @var $this \yii\web\View */


use common\models\Order;
use common\models\OrderTicket;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = "Заказ {$order->id}";
$this->params['breadcrumbs'][] = ['label' => 'Проект событий и заказов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Заказы {$user->username}", 'url' => ['user-orders']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="view-order">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Редактировать заказ', ['update', 'id' => $order->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить заказ', ['delete', 'id' => $order->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $order,
        'attributes' => [
            [
                'attribute' => 'event_id',
                'value' => '<a href="'. Url::to(['testproject/view-event', 'id' => $order->event->id]).'">' . $order->event->title . '</a>',
                'format' => 'raw'
            ],
            'order_date',
            [
                'attribute' => 'status',
                'value' => Order::$statusLabels[$order->status],
            ],
        ],
    ])?>
</div>
<div class="order-ticket-view">
    <h1>Билеты заказа</h1>
    <?= GridView::widget([
        'dataProvider' => $tickets,
        'columns' => [
            [
                'attribute' => 'ticket_id',
                'value' => function(OrderTicket $ticketsArray){
                    return '<p>' . $ticketsArray->ticket->title . '</p>';
                },
                'format' => 'raw',
            ],
            'bar_code',
            'cost',
        ],
    ]); ?>
</div>
