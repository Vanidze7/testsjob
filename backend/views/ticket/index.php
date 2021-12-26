<?php

use common\models\Ticket;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Билеты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Добавить билеты', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title',
            [
                'attribute' => 'adult',
                'value' => function(Ticket $dataProviderArray){//одна запись из массива $dataProvider
                    return Ticket::$adultLabels[$dataProviderArray->adult];
                },
            ],
            [
                'attribute' => 'type',
                'value' => function(Ticket $dataProviderArray){//одна запись из массива $dataProvider
                    return Ticket::$typeLabels[$dataProviderArray->type];
                },
            ],
            'price',
            ['class' => 'yii\grid\ActionColumn']
        ],
    ]); ?>
</div>
