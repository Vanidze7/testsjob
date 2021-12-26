<?php

use yii\helpers\Html;

$this->title = 'Добавление билетов';
$this->params['breadcrumbs'][] = ['label' => 'Билеты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ticket-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
