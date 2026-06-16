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
                    <p><strong>USSD Code:</strong> <span class="label label-success">*150*00#</span></p>
                    <p><strong>Steps:</strong></p>
                    <ol>
                        <li>Dial *150*00# on your phone to open the Vodacom M-Pesa menu</li>
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
                    <p><strong>USSD Code:</strong> <span class="label label-danger">*150*60#</span></p>
                    <p><strong>Steps:</strong></p>
                    <ol>
                        <li>Dial *150*60# on your phone to open the Airtel Money menu</li>
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
                    <h3 class="panel-title">📱 Mixx by Yas</h3>
                </div>
                <div class="panel-body">
                    <p><strong>Number:</strong> 0678552251</p>
                    <p><strong>Name:</strong> Faith Christian Church</p>
                    <p><strong>USSD Code:</strong> <span class="label label-warning">*150*01#</span></p>
                    <p><strong>Steps:</strong></p>
                    <ol>
                        <li>Dial *150*01# on your phone to open the Mixx by Yas menu</li>
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
                    <p><strong>USSD Code:</strong> <span class="label label-info">*150*88#</span></p>
                    <p><strong>Steps:</strong></p>
                    <ol>
                        <li>Dial *150*88# on your phone to open the HaloPesa menu</li>
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
                <strong>📌 Note:</strong> After giving your offering, please contact the church secretary to confirm your payment and the type of offering you made.<br><br>
                <strong>🙏 God bless you for your generosity!</strong>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">📋 Types of Offerings</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>1</td><td><strong>Tithe</strong></td><td>10% of your income given to God</td></tr>
                            <tr><td>2</td><td><strong>Thanksgiving Offering</strong></td><td>Given in gratitude for God's blessings</td></tr>
                            <tr><td>3</td><td><strong>Building Fund</strong></td><td>For construction and maintenance of church facilities</td></tr>
                            <tr><td>4</td><td><strong>Mission Fund</strong></td><td>Support for evangelism and missionary work</td></tr>
                            <tr><td>5</td><td><strong>Special Offering</strong></td><td>For special church events and needs</td></tr>
                            <tr><td>6</td><td><strong>Transportation Offering</strong></td><td>Support for church transportation needs</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <p><?= Html::a('← Back to Dashboard', ['/member/dashboard'], ['class' => 'btn btn-default']) ?></p>
</div>