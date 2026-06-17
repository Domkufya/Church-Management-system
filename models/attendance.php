<?php

namespace app\models;

use Yii;

class Attendance extends \yii\db\ActiveRecord
{
    const STATUS_PRESENT = 'Present';
    const STATUS_ABSENT = 'Absent';

    public static function tableName()
    {
        return 'attendance';
    }

    public function rules()
    {
        return [
            [['status'], 'default', 'value' => self::STATUS_PRESENT],
            [['event_id', 'member_id'], 'required'],
            [['event_id', 'member_id'], 'integer'],
            [['status'], 'string'],
            [['recorded_at'], 'safe'],
            ['status', 'in', 'range' => array_keys(self::optsStatus())],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::class, 'targetAttribute' => ['event_id' => 'id']],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Members::class, 'targetAttribute' => ['member_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'Event',
            'member_id' => 'Member',
            'status' => 'Status',
            'recorded_at' => 'Recorded At',
        ];
    }

    public function getEvent()
    {
        return $this->hasOne(Events::class, ['id' => 'event_id']);
    }

    public function getMember()
    {
        return $this->hasOne(Members::class, ['id' => 'member_id']);
    }

    public static function optsStatus()
    {
        return [
            self::STATUS_PRESENT => 'Present',
            self::STATUS_ABSENT => 'Absent',
        ];
    }

    public function displayStatus()
    {
        return self::optsStatus()[$this->status] ?? $this->status;
    }

    public function isStatusPresent()
    {
        return $this->status === self::STATUS_PRESENT;
    }

    public function setStatusToPresent()
    {
        $this->status = self::STATUS_PRESENT;
    }

    public function isStatusAbsent()
    {
        return $this->status === self::STATUS_ABSENT;
    }

    public function setStatusToAbsent()
    {
        $this->status = self::STATUS_ABSENT;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->recorded_at = date('Y-m-d H:i:s');
            }
            return true;
        }
        return false;
    }
}