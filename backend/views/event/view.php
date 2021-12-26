<?php

use common\models\Event;
use common\models\Order;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'События', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="event-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Отредактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
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
            'title',
            'description',
            [
                'attribute' => 'status',
                'value' => Event::$statusLabels[$model->status],
                'format' => 'raw'
            ],
            'count',
            'ticket_buy',
        ],
    ]) ?>
</div>
<div class="order-view">
    <h1>Заказы события</h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'value' => function(Order $dataProviderArray) {
                    return '<a href="' . \yii\helpers\Url::to(['order/view', 'id' => $dataProviderArray->id]) . '">' . $dataProviderArray->id . '</a>';
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'user_id',
                'value' => function(Order $dataProviderArray){
                    return $dataProviderArray->user->username;
                },
            ],
            'order_date',
            [
                'attribute' => 'status',
                'value' => function(Order $dataProviderArray){
                    return Order::$statusLabels[$dataProviderArray->status];
                },
            ],
        ],
    ]); ?>
</div>
