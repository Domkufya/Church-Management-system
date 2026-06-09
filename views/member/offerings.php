<?php
use yii\helpers\Html;
$this->title = 'Offerings';
?>
<div class="member-offerings">
    <h2>💰 Ways to Give Offerings</h2>
    <p class="text-muted">Faith Christian Church — Give cheerfully!</p>
    <hr>

    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">📱 M-Pesa</h3>
                </div>
                <div class="panel-body">
                    <p><strong>Number:</strong> 0792342251</p>
                    <p><strong>Name:</strong> Faith Christian Church</p>
                    <p><strong>Steps:</strong></p>
                    <ol>
                        <li>Go to M-Pesa menu</li>
                        <li>Select "Lipa"</li>
                        <li>Enter number above</li>
                        <li>Enter amount</li>
                        <li>Confirm</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">📱 Airtel Money</h3>
                </div>
                <div class="panel-body">
                    <p><strong>Number:</strong> 0787573712</p>
                    <p><strong>Name:</strong> Faith Christian Church</p>
                    <p><strong>Steps:</strong></p>
                    <ol>
                        <li>Go to Airtel Money menu</li>
                        <li>Select "Send Money"</li>
                        <li>Enter number above</li>
                        <li>Enter amount</li>
                        <li>Confirm</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">📱 Mix by Yas</h3>
                </div>
                <div class="panel-body">
                    <p><strong>Number:</strong> 0678552251</p>
                    <p><strong>Name:</strong> Faith Christian Church</p>
                    <p><strong>Steps:</strong></p>
                    <ol>
                        <li>Go to Mix by Yas menu</li>
                        <li>Select "Send Money"</li>
                        <li>Enter number above</li>
                        <li>Enter amount</li>
                        <li>Confirm</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">📱 HaloPesa</h3>
                </div>
                <div class="panel-body">
                    <p><strong>Number:</strong> 0613332251</p>
                    <p><strong>Name:</strong> Faith Christian Church</p>
                    <p><strong>Steps:</strong></p>
                    <ol>
                        <li>Go to HaloPesa menu</li>
                        <li>Select "Send Money"</li>
                        <li>Enter number above</li>
                        <li>Enter amount</li>
                        <li>Confirm</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">🏦 Bank Transfer — CRDB Bank</h3>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>Account Name</th>
                            <td>Faith Christian Church</td>
                        </tr>
                        <tr>
                            <th>Account Number</th>
                            <td>0152948347900</td>
                        </tr>
                        <tr>
                            <th>Bank</th>
                            <td>CRDB Bank</td>
                        </tr>
                        <tr>
                            <th>Branch</th>
                            <td>Dar es Salaam</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="alert alert-info mt-3">
                <strong>📌 Note:</strong> After giving your offering, please contact the church secretary to confirm your payment.<br><br>
                <strong>🙏 God bless you for your generosity!</strong>
            </div>
        </div>
    </div>

    <p><?= Html::a('← Back to Dashboard', ['/member/dashboard'], ['class' => 'btn btn-default']) ?></p>
</div>