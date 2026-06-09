<?php
use yii\helpers\Html;
$this->title = 'Events';
?>
<div class="member-events">
    <h2>📅 Church Events</h2>
    <hr>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Event</th>
                <th>Date</th>
                <th>Location</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $i => $event): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= Html::encode($event->title) ?></td>
                <td><?= Html::encode($event->event_date) ?></td>
                <td><?= Html::encode($event->location) ?></td>
                <td><?= Html::encode($event->description) ?></td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($events)): ?>
            <tr>
                <td colspan="5" class="text-center">No events found</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <p><?= Html::a('← Back to Dashboard', ['/member/dashboard'], ['class' => 'btn btn-default']) ?></p>
</div>