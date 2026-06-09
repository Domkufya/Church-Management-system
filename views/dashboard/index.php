<?php
/** @var yii\web\View $this */
/** @var array $stats */
/** @var array $recent_events */
/** @var array $recent_members */
?>
<div class="dashboard-index" style="padding-top: 60px;">
 


    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2><i class="glyphicon glyphicon-home"></i> Church Management Dashboard</h2>
            <p class="text-muted">Welcome, <?= Yii::$app->user->identity->username ?>!</p>
            <hr>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row">

        <div class="col-md-3 col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">👥 Members</h3>
                </div>
                <div class="panel-body text-center">
                    <h1><?= $stats['members'] ?></h1>
                </div>
                <div class="panel-footer">
                    <?= \yii\helpers\Html::a('View All', ['/members/index']) ?>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">💰 Total Offerings</h3>
                </div>
                <div class="panel-body text-center">
                    <h1>TZS <?= number_format($stats['offerings'], 2) ?></h1>
                </div>
                <div class="panel-footer">
                    <?= \yii\helpers\Html::a('View All', ['/offerings/index']) ?>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">💸 Total Expenses</h3>
                </div>
                <div class="panel-body text-center">
                    <h1>TZS <?= number_format($stats['expenses'], 2) ?></h1>
                </div>
                <div class="panel-footer">
                    <?= \yii\helpers\Html::a('View All', ['/expenses/index']) ?>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">📅 Events</h3>
                </div>
                <div class="panel-body text-center">
                    <h1><?= $stats['events'] ?></h1>
                </div>
                <div class="panel-footer">
                    <?= \yii\helpers\Html::a('View All', ['/events/index']) ?>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">🏛️ Departments</h3>
                </div>
                <div class="panel-body text-center">
                    <h1><?= $stats['departments'] ?></h1>
                </div>
                <div class="panel-footer">
                    <?= \yii\helpers\Html::a('View All', ['/departments/index']) ?>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">🙏 Prayer Requests</h3>
                </div>
                <div class="panel-body text-center">
                    <h1><?= $stats['prayer_requests'] ?></h1>
                </div>
                <div class="panel-footer">
                    <?= \yii\helpers\Html::a('View All', ['/prayer-requests/index']) ?>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">👶 Children</h3>
                </div>
                <div class="panel-body text-center">
                    <h1><?= $stats['children'] ?></h1>
                </div>
                <div class="panel-footer">
                    <?= \yii\helpers\Html::a('View All', ['/children/index']) ?>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">📊 Attendance</h3>
                </div>
                <div class="panel-body text-center">
                    <h1><?= $stats['attendance'] ?></h1>
                </div>
                <div class="panel-footer">
                    <?= \yii\helpers\Html::a('View All', ['/attendance/index']) ?>
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Members & Events -->
    <div class="row mt-4">

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">👥 Recent Members</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_members as $i => $member): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= \yii\helpers\Html::encode($member->first_name .' ' . $member->last_name) ?></td>
                                <td><?= \yii\helpers\Html::encode($member->phone) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">📅 Recent Events</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Event</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_events as $i => $event): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= \yii\helpers\Html::encode($event->title) ?></td>
                                <td><?= \yii\helpers\Html::encode($event->event_date) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>