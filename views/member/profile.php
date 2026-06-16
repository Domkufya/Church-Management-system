<?php
use yii\helpers\Html;
$this->title = 'My Profile';
?>
<div class="member-profile">
    <h2>👤 My Profile</h2>
    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Account Information</h3>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>Username</th>
                            <td><?= Html::encode($user->username) ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= Html::encode($user->email) ?></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td><?= Html::encode($user->role) ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><?= $user->status == 1 ? 'Active' : 'Inactive' ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <p><?= Html::a('← Back to Dashboard', ['/member/profile'], ['class' => 'btn btn-default']) ?></p>
</div>
