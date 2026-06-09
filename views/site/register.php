<?php
/** @var yii\web\View $this */
/** @var app\models\User $model */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Register';
?>

<div class="site-register">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">⛪ Church CMS — Register</h3>
                </div>
                <div class="panel-body">

                    <?php if (Yii::$app->session->hasFlash('success')): ?>
                        <div class="alert alert-success">
                            <?= Yii::$app->session->getFlash('success') ?>
                        </div>
                    <?php endif; ?>

                    <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($model, 'username')->textInput([
                            'placeholder' => 'Chagua username',
                            'autofocus' => true
                        ]) ?>

                        <?= $form->field($model, 'email')->input('email', [
                            'placeholder' => 'Email yako'
                        ]) ?>

                        <?= $form->field($model, 'password_hash')->passwordInput([
                            'placeholder' => 'Chagua password'
                        ])->label('Password') ?>

                        <div class="form-group">
                            <?= Html::submitButton('Register', [
                                'class' => 'btn btn-primary btn-block'
                            ]) ?>
                        </div>

                    <?php ActiveForm::end(); ?>

                    <div class="text-center">
                        <p>Una account tayari? <?= Html::a('Login hapa', ['site/login']) ?></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>