<?php

use common\models\Order;
use common\models\OrderTicket;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = "Заказ № {$model->id}";
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Редактировать заказ', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить заказ', ['delete', 'id' => $model->id], [
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
            'user_id',
            [
                'attribute' => 'event_id',
                'value' => '<a href="'. Url::to(['event/view', 'id' => $model->event->id]).'">' . $model->event->title . '</a>',
                'format' => 'raw'
            ],
            'order_date',
            [
                'attribute' => 'status',
                'value' => Order::$statusLabels[$model->status],
            ],
        ],
    ])?>
</div>
<div class="order-ticket-view">
    <h1>Билеты заказа</h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'value' => function(OrderTicket $dataProviderArray) {
                    return '<a href="' . \yii\helpers\Url::to(['order-ticket/view', 'id' => $dataProviderArray->id]) . '">' . $dataProviderArray->id . '</a>';
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'ticket_id',
                'value' => function(OrderTicket $dataProviderArray){
                    return '<a href="' . \yii\helpers\Url::to(['ticket/view', 'id' => $dataProviderArray->ticket->id]) . '">' . $dataProviderArray->ticket->title . '</a>';
                },
                'format' => 'raw',
            ],
            'bar_code',
            'cost',
        ],
    ]); ?>
</div>