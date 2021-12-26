<?php

use common\models\Order;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'user_id',
                'value' => function(Order $dataProviderArray){
                    return $dataProviderArray->user->username;
                },
            ],
            [
                'attribute' => 'event_id',
                'value' => function(Order $dataProviderArray){
                    return '<a href="' . \yii\helpers\Url::to(['event/view', 'id' => $dataProviderArray->event->id]) . '">' . $dataProviderArray->event->title . '</a>';
                },
                'format' => 'raw',
            ],
            'order_date',
            [
                'attribute' => 'status',
                'value' => function(Order $dataProviderArray){
                    return Order::$statusLabels[$dataProviderArray->status];
                },
            ],
            ['class' => 'yii\grid\ActionColumn', 'header' => 'Действия']
        ],
    ]); ?>
</div>
