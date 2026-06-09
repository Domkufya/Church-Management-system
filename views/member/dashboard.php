<?php
use yii\helpers\Html;
$this->title = 'Member Dashboard';
?>
<div class="member-dashboard" style="padding-top: 70px;">

    <div class="row">
        <div class="col-12">
            <h2>⛪ Church Management System</h2>
            <p class="text-muted">Welcome, <?= Html::encode($user->username) ?>!</p>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6" style="margin-bottom: 20px;">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">📢 Announcements</h3>
                </div>
                <div class="panel-body text-center">
                    <p>View church announcements</p>
                    <?= Html::a('View', ['/events/index'], ['class' => 'btn btn-primary btn-sm']) ?>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6" style="margin-bottom: 20px;">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">🙏 Prayer Requests</h3>
                </div>
                <div class="panel-body text-center">
                    <p>Submit or view prayers</p>
                    <?= Html::a('View', ['/prayer-requests/index'], ['class' => 'btn btn-success btn-sm']) ?>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6" style="margin-bottom: 20px;">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">💰 Offerings</h3>
                </div>
                <div class="panel-body text-center">
                    <p>Ways to give offerings</p>
                    <?= Html::a('View', ['/site/offerings'], ['class' => 'btn btn-warning btn-sm']) ?>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6" style="margin-bottom: 20px;">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">👤 Profile</h3>
                </div>
                <div class="panel-body text-center">
                    <p>View your profile</p>
                    <?= Html::a('View', ['/users/view', 'id' => Yii::$app->user->id], ['class' => 'btn btn-info btn-sm']) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6" style="margin-bottom: 20px;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">📅 Recent Events</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr><th>#</th><th>Event</th><th>Date</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($events as $i => $event): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= Html::encode($event->title) ?></td>
                                <td><?= Html::encode($event->event_date) ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (empty($events)): ?>
                            <tr><td colspan="3" class="text-center">No events found</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6" style="margin-bottom: 20px;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">🙏 Recent Prayer Requests</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr><th>#</th><th>Request</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($prayers as $i => $prayer): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= Html::encode($prayer->request) ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (empty($prayers)): ?>
                            <tr><td colspan="2" class="text-center">No prayer requests found</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>