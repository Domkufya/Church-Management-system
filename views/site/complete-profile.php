<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Complete Your Profile';
?>

<div style="min-height:100vh; background:linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); padding-top:80px; padding-bottom:40px;">

    <div style="max-width:600px; margin:0 auto; padding:0 20px;">

        <!-- Header -->
        <div style="text-align:center; margin-bottom:30px; color:white;">
            <div style="font-size:55px;">⛪</div>
            <h2 style="font-weight:800; margin:10px 0 5px 0;">Complete Your Profile</h2>
            <p style="opacity:0.7; font-size:14px;">Please fill in your details to continue</p>
        </div>

        <!-- Form -->
        <div style="background:white; border-radius:20px; padding:35px 30px; box-shadow:0 25px 60px rgba(0,0,0,0.3);">

            <?php $form = ActiveForm::begin(['options' => ['style' => 'margin:0;']]); ?>

            <div class="row">
                <div class="col-md-6" style="margin-bottom:15px;">
                    <label style="font-size:13px; font-weight:600; color:#444;">👤 First Name</label>
                    <?= $form->field($model, 'first_name', ['template' => '{input}{error}'])->textInput([
                        'placeholder' => 'First name',
                        'style' => 'width:100%; padding:10px 15px; border:2px solid #e0e0e0; border-radius:8px; font-size:14px; box-sizing:border-box;'
                    ]) ?>
                </div>
                <div class="col-md-6" style="margin-bottom:15px;">
                    <label style="font-size:13px; font-weight:600; color:#444;">👤 Last Name</label>
                    <?= $form->field($model, 'last_name', ['template' => '{input}{error}'])->textInput([
                        'placeholder' => 'Last name',
                        'style' => 'width:100%; padding:10px 15px; border:2px solid #e0e0e0; border-radius:8px; font-size:14px; box-sizing:border-box;'
                    ]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6" style="margin-bottom:15px;">
                    <label style="font-size:13px; font-weight:600; color:#444;">⚧ Gender</label>
                    <?= $form->field($model, 'gender', ['template' => '{input}{error}'])->dropDownList(
                        ['Male' => 'Male', 'Female' => 'Female'],
                        ['prompt' => 'Select gender', 'style' => 'width:100%; padding:10px 15px; border:2px solid #e0e0e0; border-radius:8px; font-size:14px;']
                    ) ?>
                </div>
                <div class="col-md-6" style="margin-bottom:15px;">
                    <label style="font-size:13px; font-weight:600; color:#444;">🎂 Date of Birth</label>
                    <?= $form->field($model, 'dob', ['template' => '{input}{error}'])->input('date', [
                        'style' => 'width:100%; padding:10px 15px; border:2px solid #e0e0e0; border-radius:8px; font-size:14px; box-sizing:border-box;'
                    ]) ?>
                </div>
            </div>

            <div style="margin-bottom:15px;">
                <label style="font-size:13px; font-weight:600; color:#444;">📱 Phone Number</label>
                <?= $form->field($model, 'phone', ['template' => '{input}{error}'])->textInput([
                    'placeholder' => '07XX XXX XXX',
                    'style' => 'width:100%; padding:10px 15px; border:2px solid #e0e0e0; border-radius:8px; font-size:14px; box-sizing:border-box;'
                ]) ?>
            </div>

            <div style="margin-bottom:15px;">
                <label style="font-size:13px; font-weight:600; color:#444;">📧 Email</label>
                <?= $form->field($model, 'email', ['template' => '{input}{error}'])->input('email', [
                    'placeholder' => 'Your email address',
                    'style' => 'width:100%; padding:10px 15px; border:2px solid #e0e0e0; border-radius:8px; font-size:14px; box-sizing:border-box;'
                ]) ?>
            </div>

            <div style="margin-bottom:15px;">
                <label style="font-size:13px; font-weight:600; color:#444;">🏠 Address</label>
                <?= $form->field($model, 'address', ['template' => '{input}{error}'])->textarea([
                    'placeholder' => 'Your home address',
                    'rows' => 2,
                    'style' => 'width:100%; padding:10px 15px; border:2px solid #e0e0e0; border-radius:8px; font-size:14px; box-sizing:border-box;'
                ]) ?>
            </div>

            <div style="margin-bottom:25px;">
                <label style="font-size:13px; font-weight:600; color:#444;">💍 Marital Status</label>
                <?= $form->field($model, 'marital_status', ['template' => '{input}{error}'])->dropDownList(
                    ['Single' => 'Single', 'Married' => 'Married', 'Widowed' => 'Widowed', 'Divorced' => 'Divorced'],
                    ['prompt' => 'Select status', 'style' => 'width:100%; padding:10px 15px; border:2px solid #e0e0e0; border-radius:8px; font-size:14px;']
                ) ?>
            </div>

            <?= Html::submitButton('Save Profile →', [
                'style' => 'width:100%; background:linear-gradient(135deg, #1cc88a 0%, #17a673 100%); color:white; padding:14px; border:none; border-radius:10px; font-size:16px; font-weight:700; cursor:pointer;'
            ]) ?>

            <?php ActiveForm::end(); ?>

        </div>

        <p style="text-align:center; color:rgba(255,255,255,0.5); font-size:12px; margin-top:20px;">
            🙏 God bless you as you join our community
        </p>
    </div>
</div>