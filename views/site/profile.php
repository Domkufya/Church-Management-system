<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Professional User Profile';
?>

<div style="min-height: 100vh; background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); margin-top: -20px; padding: 40px 20px; color: #fff; font-family: 'Inter', sans-serif;">

    <div style="max-width: 1100px; margin: 0 auto;">
        
        <!-- Header Info -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px; background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); padding: 20px 30px; border-radius: 15px; border: 1px solid rgba(255, 255, 255, 0.1);">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="font-size: 45px;">👤</div>
                <div>
                    <h2 style="margin: 0; font-weight: 800; font-size: 24px; color: #fff;"><?= Html::encode($user->username) ?></h2>
                    <p style="margin: 5px 0 0 0; opacity: 0.7; font-size: 14px;">
                        Role: <span style="background: rgba(28,200,138,0.2); color: #1cc88a; padding: 3px 8px; border-radius: 10px; font-weight: 700; font-size: 12px; text-transform: uppercase;"><?= Html::encode($user->role) ?></span>
                        <?php if (!empty($member->church_position)): ?>
                            &bull; Position: <span style="color: #4e73df; font-weight: 600;"><?= Html::encode($member->church_position) ?></span>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <div>
                <a href="<?= yii\helpers\Url::to(['/site/index']) ?>" style="color: rgba(255,255,255,0.7); text-decoration: none; font-size: 14px; font-weight: 600; transition: color 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">&larr; Back to Dashboard</a>
            </div>
        </div>

        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div style="background: rgba(28,200,138,0.2); border-left: 5px solid #1cc88a; color: #fff; padding: 15px 20px; border-radius: 8px; margin-bottom: 25px; font-size: 15px;">
                ✅ <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <?php endif; ?>

        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data', 'id' => 'profile-form']
        ]); ?>

        <div style="display: grid; grid-template-columns: 320px 1fr; gap: 30px;">

            <!-- Left Column: Photo & Quick Info -->
            <div style="background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1); padding: 30px; text-align: center; height: fit-content; display: flex; flex-direction: column; align-items: center; gap: 20px;">
                
                <h4 style="margin: 0 0 10px 0; font-size: 18px; font-weight: 700; color: #1cc88a; text-align: left; width: 100%; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 10px;">📸 Profile Picture</h4>
                
                <!-- Avatar Preview -->
                <div style="position: relative; width: 180px; height: 180px; border-radius: 50%; overflow: hidden; border: 4px solid rgba(255, 255, 255, 0.1); background: #111; box-shadow: 0 10px 25px rgba(0,0,0,0.4);">
                    <img id="avatar-preview" src="<?= $member->photo ? Yii::getAlias('@web') . '/uploads/' . $member->photo : Yii::getAlias('@web') . '/images/default-avatar.png' ?>" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1511367461989-f85a21fda167?w=300&h=300&fit=crop&q=80'" />
                </div>

                <div style="width: 100%;">
                    <!-- File Upload Option -->
                    <label for="device-file-input" style="display: block; background: rgba(255,255,255,0.1); color: #fff; padding: 10px 15px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; border: 1px dashed rgba(255,255,255,0.3); transition: background 0.2s; margin-bottom: 10px;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                        📁 Choose File from Device
                    </label>
                    <input type="file" id="device-file-input" name="Members[photo]" style="display: none;" accept="image/*" onchange="previewFile(this)" />
                    
                    <!-- Camera Capture Option -->
                    <button type="button" id="camera-open-btn" style="width: 100%; background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); color: white; border: none; padding: 10px 15px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; box-shadow: 0 4px 15px rgba(78,115,223,0.3); display: flex; align-items: center; justify-content: center; gap: 8px;" onclick="openCamera()">
                        📷 Capture photo at instance
                    </button>
                    
                    <!-- Hidden field to hold base64 image data from camera -->
                    <input type="hidden" name="captured_photo" id="captured-photo-input" />
                </div>

                <!-- Instant Camera Widget Overlay -->
                <div id="camera-widget" style="display: none; background: rgba(0, 0, 0, 0.9); border-radius: 12px; padding: 15px; width: 100%; box-sizing: border-box; border: 1px solid rgba(255,255,255,0.2); animation: fadeIn 0.3s ease-in-out;">
                    <video id="webcam" autoplay playsinline style="width: 100%; border-radius: 8px; background: #000; margin-bottom: 10px;"></video>
                    <canvas id="canvas" style="display: none;"></canvas>
                    <div style="display: flex; gap: 10px; justify-content: center;">
                        <button type="button" class="btn btn-sm btn-success" onclick="takeSnapshot()" style="padding: 6px 12px; font-size: 12px; font-weight: 600;">Snapshot</button>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="closeCamera()" style="padding: 6px 12px; font-size: 12px; font-weight: 600;">Cancel</button>
                    </div>
                </div>
            </div>

            <!-- Right Column: Detail Forms -->
            <div style="background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1); padding: 30px; display: flex; flex-direction: column;">
                
                <!-- Tab Headers -->
                <div style="display: flex; gap: 15px; border-bottom: 2px solid rgba(255, 255, 255, 0.1); margin-bottom: 25px; padding-bottom: 5px;">
                    <button type="button" id="tab-btn-personal" class="profile-tab-btn active-tab" onclick="switchTab('personal')" style="background: none; border: none; color: rgba(255,255,255,0.6); padding: 10px 20px; font-size: 16px; font-weight: 700; cursor: pointer; border-bottom: 3px solid transparent; transition: all 0.3s;">
                        👤 Personal details
                    </button>
                    <button type="button" id="tab-btn-professional" class="profile-tab-btn" onclick="switchTab('professional')" style="background: none; border: none; color: rgba(255,255,255,0.6); padding: 10px 20px; font-size: 16px; font-weight: 700; cursor: pointer; border-bottom: 3px solid transparent; transition: all 0.3s;">
                        💼 Professional details (Global Church)
                    </button>
                    <button type="button" id="tab-btn-account" class="profile-tab-btn" onclick="switchTab('account')" style="background: none; border: none; color: rgba(255,255,255,0.6); padding: 10px 20px; font-size: 16px; font-weight: 700; cursor: pointer; border-bottom: 3px solid transparent; transition: all 0.3s;">
                        🔒 Account settings
                    </button>
                </div>

                <!-- Tab 1: Personal details -->
                <div id="tab-content-personal" class="profile-tab-content">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <label style="font-size:13px; font-weight:600; color:rgba(255,255,255,0.7); display:block; margin-bottom:6px;">First Name</label>
                            <?= $form->field($member, 'first_name', ['template' => '{input}{error}'])->textInput([
                                'style' => 'width:100%; padding:11px 14px; border:1px solid rgba(255,255,255,0.2); border-radius:8px; font-size:14px; outline:none; background:rgba(0,0,0,0.2); color:#fff; box-sizing:border-box;'
                            ]) ?>
                        </div>
                        <div>
                            <label style="font-size:13px; font-weight:600; color:rgba(255,255,255,0.7); display:block; margin-bottom:6px;">Last Name</label>
                            <?= $form->field($member, 'last_name', ['template' => '{input}{error}'])->textInput([
                                'style' => 'width:100%; padding:11px 14px; border:1px solid rgba(255,255,255,0.2); border-radius:8px; font-size:14px; outline:none; background:rgba(0,0,0,0.2); color:#fff; box-sizing:border-box;'
                            ]) ?>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                        <div>
                            <label style="font-size:13px; font-weight:600; color:rgba(255,255,255,0.7); display:block; margin-bottom:6px;">Gender</label>
                            <?= $form->field($member, 'gender', ['template' => '{input}{error}'])->dropDownList([
                                'Male' => 'Male',
                                'Female' => 'Female'
                            ], [
                                'style' => 'width:100%; padding:11px 14px; border:1px solid rgba(255,255,255,0.2); border-radius:8px; font-size:14px; outline:none; background:rgba(0,0,0,0.2); color:#fff; box-sizing:border-box;'
                            ]) ?>
                        </div>
                        <div>
                            <label style="font-size:13px; font-weight:600; color:rgba(255,255,255,0.7); display:block; margin-bottom:6px;">Date of Birth</label>
                            <?= $form->field($member, 'dob', ['template' => '{input}{error}'])->input('date', [
                                'style' => 'width:100%; padding:11px 14px; border:1px solid rgba(255,255,255,0.2); border-radius:8px; font-size:14px; outline:none; background:rgba(0,0,0,0.2); color:#fff; box-sizing:border-box;'
                            ]) ?>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                        <div>
                            <label style="font-size:13px; font-weight:600; color:rgba(255,255,255,0.7); display:block; margin-bottom:6px;">Phone Number</label>
                            <?= $form->field($member, 'phone', ['template' => '{input}{error}'])->textInput([
                                'style' => 'width:100%; padding:11px 14px; border:1px solid rgba(255,255,255,0.2); border-radius:8px; font-size:14px; outline:none; background:rgba(0,0,0,0.2); color:#fff; box-sizing:border-box;'
                            ]) ?>
                        </div>
                        <div>
                            <label style="font-size:13px; font-weight:600; color:rgba(255,255,255,0.7); display:block; margin-bottom:6px;">Marital Status</label>
                            <?= $form->field($member, 'marital_status', ['template' => '{input}{error}'])->dropDownList([
                                'Single' => 'Single',
                                'Married' => 'Married',
                                'Widowed' => 'Widowed',
                                'Divorced' => 'Divorced'
                            ], [
                                'style' => 'width:100%; padding:11px 14px; border:1px solid rgba(255,255,255,0.2); border-radius:8px; font-size:14px; outline:none; background:rgba(0,0,0,0.2); color:#fff; box-sizing:border-box;'
                            ]) ?>
                        </div>
                    </div>

                    <div style="margin-top: 20px;">
                        <label style="font-size:13px; font-weight:600; color:rgba(255,255,255,0.7); display:block; margin-bottom:6px;">Residential Address</label>
                        <?= $form->field($member, 'address', ['template' => '{input}{error}'])->textarea([
                            'rows' => 3,
                            'style' => 'width:100%; padding:11px 14px; border:1px solid rgba(255,255,255,0.2); border-radius:8px; font-size:14px; outline:none; background:rgba(0,0,0,0.2); color:#fff; box-sizing:border-box;'
                        ]) ?>
                    </div>
                </div>

                <!-- Tab 2: Professional details -->
                <div id="tab-content-professional" class="profile-tab-content" style="display: none;">
                    <p style="font-size: 13px; color: rgba(255,255,255,0.6); margin-top:-5px; margin-bottom: 20px;">
                        🌍 Fill in details related to your role in global church systems.
                    </p>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <label style="font-size:13px; font-weight:600; color:rgba(255,255,255,0.7); display:block; margin-bottom:6px;">Denomination (e.g. Pentecostal, Baptist, Anglican)</label>
                            <?= $form->field($member, 'denomination', ['template' => '{input}{error}'])->textInput([
                                'placeholder' => 'Enter denomination',
                                'style' => 'width:100%; padding:11px 14px; border:1px solid rgba(255,255,255,0.2); border-radius:8px; font-size:14px; outline:none; background:rgba(0,0,0,0.2); color:#fff; box-sizing:border-box;'
                            ]) ?>
                        </div>
                        <div>
                            <label style="font-size:13px; font-weight:600; color:rgba(255,255,255,0.7); display:block; margin-bottom:6px;">Church Position / Title (e.g. Senior Pastor, Youth Director)</label>
                            <?= $form->field($member, 'church_position', ['template' => '{input}{error}'])->textInput([
                                'placeholder' => 'Enter position title',
                                'style' => 'width:100%; padding:11px 14px; border:1px solid rgba(255,255,255,0.2); border-radius:8px; font-size:14px; outline:none; background:rgba(0,0,0,0.2); color:#fff; box-sizing:border-box;'
                            ]) ?>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                        <div>
                            <label style="font-size:13px; font-weight:600; color:rgba(255,255,255,0.7); display:block; margin-bottom:6px;">Theological / Professional Qualification</label>
                            <?= $form->field($member, 'theological_qualification', ['template' => '{input}{error}'])->textInput([
                                'placeholder' => 'e.g. M.Div, B.Th, Ministry Certificate',
                                'style' => 'width:100%; padding:11px 14px; border:1px solid rgba(255,255,255,0.2); border-radius:8px; font-size:14px; outline:none; background:rgba(0,0,0,0.2); color:#fff; box-sizing:border-box;'
                            ]) ?>
                        </div>
                        <div>
                            <label style="font-size:13px; font-weight:600; color:rgba(255,255,255,0.7); display:block; margin-bottom:6px;">Ordination Date (if applicable)</label>
                            <?= $form->field($member, 'ordination_date', ['template' => '{input}{error}'])->input('date', [
                                'style' => 'width:100%; padding:11px 14px; border:1px solid rgba(255,255,255,0.2); border-radius:8px; font-size:14px; outline:none; background:rgba(0,0,0,0.2); color:#fff; box-sizing:border-box;'
                            ]) ?>
                        </div>
                    </div>

                    <div style="margin-top: 20px;">
                        <label style="font-size:13px; font-weight:600; color:rgba(255,255,255,0.7); display:block; margin-bottom:6px;">Spiritual Gifts / Ministry Skills (comma separated)</label>
                        <?= $form->field($member, 'spiritual_gifts', ['template' => '{input}{error}'])->textInput([
                            'placeholder' => 'e.g. Preaching, Worship, Administration, Counseling',
                            'style' => 'width:100%; padding:11px 14px; border:1px solid rgba(255,255,255,0.2); border-radius:8px; font-size:14px; outline:none; background:rgba(0,0,0,0.2); color:#fff; box-sizing:border-box;'
                        ]) ?>
                    </div>

                    <div style="margin-top: 20px;">
                        <label style="font-size:13px; font-weight:600; color:rgba(255,255,255,0.7); display:block; margin-bottom:6px;">Biography / Ministry Vision Statement</label>
                        <?= $form->field($member, 'ministry_vision', ['template' => '{input}{error}'])->textarea([
                            'rows' => 4,
                            'placeholder' => 'Describe your call, testimony, or vision for the ministry...',
                            'style' => 'width:100%; padding:11px 14px; border:1px solid rgba(255,255,255,0.2); border-radius:8px; font-size:14px; outline:none; background:rgba(0,0,0,0.2); color:#fff; box-sizing:border-box;'
                        ]) ?>
                    </div>
                </div>

                <!-- Tab 3: Account Settings -->
                <div id="tab-content-account" class="profile-tab-content" style="display: none;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <label style="font-size:13px; font-weight:600; color:rgba(255,255,255,0.7); display:block; margin-bottom:6px;">Username</label>
                            <input type="text" name="User[username]" value="<?= Html::encode($user->username) ?>" style="width:100%; padding:11px 14px; border:1px solid rgba(255,255,255,0.2); border-radius:8px; font-size:14px; outline:none; background:rgba(0,0,0,0.2); color:#fff; box-sizing:border-box;" required />
                        </div>
                        <div>
                            <label style="font-size:13px; font-weight:600; color:rgba(255,255,255,0.7); display:block; margin-bottom:6px;">Email Address</label>
                            <input type="email" name="User[email]" value="<?= Html::encode($user->email) ?>" style="width:100%; padding:11px 14px; border:1px solid rgba(255,255,255,0.2); border-radius:8px; font-size:14px; outline:none; background:rgba(0,0,0,0.2); color:#fff; box-sizing:border-box;" required />
                        </div>
                    </div>

                    <div style="margin-top: 20px;">
                        <label style="font-size:13px; font-weight:600; color:rgba(255,255,255,0.7); display:block; margin-bottom:6px;">New Password (leave blank if keeping current)</label>
                        <input type="password" name="User[password_new]" placeholder="Type new password" style="width:100%; padding:11px 14px; border:1px solid rgba(255,255,255,0.2); border-radius:8px; font-size:14px; outline:none; background:rgba(0,0,0,0.2); color:#fff; box-sizing:border-box;" />
                    </div>
                </div>

                <!-- Form Submit Buttons -->
                <div style="margin-top: 35px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px; display: flex; justify-content: flex-end; gap: 15px;">
                    <a href="<?= yii\helpers\Url::to(['/site/index']) ?>" class="btn btn-secondary" style="padding: 12px 25px; border-radius: 8px; font-weight: 600; font-size: 15px;">Cancel</a>
                    <?= Html::submitButton('Save Profile Changes →', [
                        'class' => 'btn',
                        'style' => 'background: linear-gradient(135deg, #1cc88a 0%, #17a673 100%); color: white; padding: 12px 30px; border: none; border-radius: 8px; font-size: 15px; font-weight: 700; cursor: pointer; box-shadow: 0 4px 15px rgba(28,200,138,0.4);'
                    ]) ?>
                </div>

            </div>

        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

<style>
.profile-tab-btn {
    position: relative;
    outline: none !important;
}
.profile-tab-btn:hover {
    color: #fff !important;
}
.active-tab {
    color: #1cc88a !important;
    border-bottom: 3px solid #1cc88a !important;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(5px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
// Tab Switching logic
function switchTab(tabName) {
    // Hide all contents
    const contents = document.querySelectorAll('.profile-tab-content');
    contents.forEach(content => {
        content.style.display = 'none';
    });

    // Remove active styles from all tab buttons
    const buttons = document.querySelectorAll('.profile-tab-btn');
    buttons.forEach(button => {
        button.classList.remove('active-tab');
    });

    // Show selected content and activate button
    document.getElementById('tab-content-' + tabName).style.display = 'block';
    document.getElementById('tab-btn-' + tabName).classList.add('active-tab');
}

// Preview uploaded file
function previewFile(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatar-preview').src = e.target.result;
            // Clear any captured photo since file upload is chosen
            document.getElementById('captured-photo-input').value = '';
        }
        reader.readAsDataURL(file);
    }
}

// Camera Capture Logic using HTML5 WebRTC API
let localStream = null;

function openCamera() {
    const widget = document.getElementById('camera-widget');
    const video = document.getElementById('webcam');
    
    widget.style.display = 'block';

    // Request webcam stream
    navigator.mediaDevices.getUserMedia({ video: true, audio: false })
        .then(function(stream) {
            localStream = stream;
            video.srcObject = stream;
        })
        .catch(function(err) {
            console.error("Camera access error: ", err);
            alert("Unable to access the camera. Please check your browser permissions or use device file upload.");
            widget.style.display = 'none';
        });
}

function takeSnapshot() {
    if (!localStream) return;

    const video = document.getElementById('webcam');
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');
    const preview = document.getElementById('avatar-preview');
    const hiddenInput = document.getElementById('captured-photo-input');

    // Set canvas dimensions equal to the video stream size
    canvas.width = video.videoWidth || 640;
    canvas.height = video.videoHeight || 480;

    // Draw the current video frame onto the canvas
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    // Convert canvas data to base64 Data URL
    const dataUrl = canvas.toDataURL('image/jpeg', 0.9);

    // Set as preview source
    preview.src = dataUrl;

    // Put into hidden input to be sent with form submission
    hiddenInput.value = dataUrl;

    // Close camera after capturing snapshot
    closeCamera();
}

function closeCamera() {
    const widget = document.getElementById('camera-widget');
    const video = document.getElementById('webcam');

    // Stop all video tracks
    if (localStream) {
        localStream.getTracks().forEach(track => track.stop());
        localStream = null;
    }

    video.srcObject = null;
    widget.style.display = 'none';
}
</script>
