<?php
use yii\helpers\Html;
$this->title = 'Take Attendance';
?>

<div style="padding-top:70px;">

    <div style="background:linear-gradient(135deg, #4e73df 0%, #224abe 100%); color:white; padding:25px 30px; border-radius:12px; margin-bottom:25px;">
        <h2 style="margin:0;">📊 Take Attendance</h2>
        <p style="margin:8px 0 0 0; opacity:0.85; font-size:14px;">Select event and mark member attendance</p>
    </div>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div style="background:#d4edda; color:#155724; padding:12px; border-radius:8px; margin-bottom:15px;">
            ✅ <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <!-- Event Selection -->
    <div style="background:white; border-radius:12px; padding:20px; box-shadow:0 3px 12px rgba(0,0,0,0.08); margin-bottom:20px;">
        <form method="get">
            <label style="font-weight:600; color:#444;">📅 Select Event:</label>
            <select name="event_id" onchange="this.form.submit()" style="margin-left:10px; padding:8px 15px; border:2px solid #e0e0e0; border-radius:8px; font-size:14px;">
                <option value="">-- Select Event --</option>
                <?php foreach ($events as $event): ?>
                    <option value="<?= $event->id ?>" <?= $event_id == $event->id ? 'selected' : '' ?>>
                        <?= Html::encode($event->title) ?> — <?= Html::encode($event->event_date) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <?php if ($event_id && !empty($members)): ?>
    <div style="background:white; border-radius:12px; padding:20px; box-shadow:0 3px 12px rgba(0,0,0,0.08);">
        <form method="post">
            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
            <input type="hidden" name="event_id" value="<?= $event_id ?>">

            <table class="table table-striped">
                <thead style="background:#4e73df; color:white;">
                    <tr>
                        <th>#</th>
                        <th>Member Name</th>
                        <th>Present ✅</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($members as $i => $member): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= Html::encode($member->first_name . ' ' . $member->last_name) ?></td>
                        <td>
                            <input type="checkbox" name="attendance[<?= $member->id ?>]" value="1" checked style="width:18px; height:18px;">
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <button type="submit" style="background:#1cc88a; color:white; padding:12px 30px; border:none; border-radius:10px; font-size:15px; font-weight:700; cursor:pointer;">
                💾 Save Attendance
            </button>
        </form>
    </div>
    <?php endif; ?>

</div>