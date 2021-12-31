<?php

use common\models\Event;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = 'События';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Добавить событие', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'title',
                'value' => function($dataProviderArray){
                    return '<a href="' . Url::to(['event/view', 'id' => $dataProviderArray->id]) .'">' . $dataProviderArray->title . '</a>';
                },
                'format' => 'raw'
            ],
            'description',
            [
                'attribute' => 'status',
                'value' => function(Event $dataProviderArray){
                    return Event::$statusLabels[$dataProviderArray->status];
                },
            ],
            'count',
            //'ticket_buy',
            ['class' => 'yii\grid\ActionColumn']
        ],
    ]); ?>
</div>
