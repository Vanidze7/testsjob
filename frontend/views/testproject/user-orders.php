<?php

use common\models\Order;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = "Заказы {$user->username}";
$this->params['breadcrumbs'][] = ['label' => 'Проект событий и заказов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <!--<p>
        <? /*= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) */ ?>
    </p>-->
    <?= GridView::widget([
        'dataProvider' => $orders,
        'columns' => [
            [
                'attribute' => 'event_id',
                'value' => function (Order $ordersArray) {
                    return '<a href="' . \yii\helpers\Url::to(['testproject/view-event', 'id' => $ordersArray->event->id]) . '">' . $ordersArray->event->title . '</a>';
                },
                'format' => 'raw',
            ],
            'order_date',
            [
                'attribute' => 'status',
                'value' => function (Order $ordersArray) {
                    return Order::$statusLabels[$ordersArray->status];
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{view-order} {update-order} {delete-order}',
                'buttons' => [
                    'view-order' => function ($url, $model, $key) {
                        return Html::a('Подробнее', $url);
                    },
                    'update-order' =>function ($url, $model, $key) {
                        return Html::a('Редактировать', $url);
                    },
                    'delete-order' =>function ($url, $model, $key) {
                        return Html::a('Удалить заказ', $url);
                    },

                ]
            ]//кнопки ведут не туда
        ],
    ]); ?>
</div>