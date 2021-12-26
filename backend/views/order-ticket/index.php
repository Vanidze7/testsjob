<?php

use common\models\OrderTicket;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Билеты заказов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-ticket-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Добавить билеты заказа', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'order_id',
                'value' => function(OrderTicket $dataProviderArray){
                    return '<a href="' . \yii\helpers\Url::to(['order/view', 'id' => $dataProviderArray->order->id]) . '">' . $dataProviderArray->order->id . '</a>';
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
            ['class' => 'yii\grid\ActionColumn', 'header' => 'Действия']
        ],
    ]); ?>
</div>
