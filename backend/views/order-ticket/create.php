<?php

use yii\helpers\Html;

$this->title = 'Добавить билеты заказа';
$this->params['breadcrumbs'][] = ['label' => 'Билеты заказов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-ticket-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
