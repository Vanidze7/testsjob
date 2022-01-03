<?php

?>
<div class="row">
    <?php foreach ($events as $event) : ?>
        <div class="col-md-3 event-point">
            <h4><a href="<?= \yii\helpers\Url::to(['testproject/view-event', 'id' => $event->id]) ?>"><?= $event->title ?></a></h4>
            <p><?= $event->description ?></p>
        </div>
    <?php endforeach; ?>
</div>