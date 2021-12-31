<?php

use yii\grid\GridView;

?>
<div>
    <?= GridView::widget([
        'dataProvider' => $events,
        'columns' => [
            'id',
            'title',
            'description',
        ],
    ]) ?>
</div>


