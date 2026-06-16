<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attendance".
 *
 * @property int $id
 * @property int $event_id
 * @property int $member_id
 * @property string|null $status
 * @property string|null $recorded_at
 *
 * @property Events $event
 * @property Members $member
 */
class attendance extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const STATUS_PRESENT = 'Present';
    const STATUS_ABSENT = 'Absent';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attendance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => 'Present'],
            [['event_id', 'member_id'], 'required'],
            [['event_id', 'member_id'], 'integer'],
            [['status'], 'string'],
            [['recorded_at'], 'safe'],
            ['status', 'in', 'range' => array_keys(self::optsStatus())],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::class, 'targetAttribute' => ['event_id' => 'id']],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Members::class, 'targetAttribute' => ['member_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'Event ID',
            'member_id' => 'Member ID',
            'status' => 'Status',
            'recorded_at' => 'Recorded At',
        ];
    }

    /**
     * Gets query for [[Event]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Events::class, ['id' => 'event_id']);
    }

    /**
     * Gets query for [[Member]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Members::class, ['id' => 'member_id']);
    }


    /**
     * column status ENUM value labels
     * @return string[]
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_PRESENT => 'Present',
            self::STATUS_ABSENT => 'Absent',
        ];
    }

    /**
     * @return string
     */
    public function displayStatus()
    {
        return self::optsStatus()[$this->status];
    }

    /**
     * @return bool
     */
    public function isStatusPresent()
    {
        return $this->status === self::STATUS_PRESENT;
    }

    public function setStatusToPresent()
    {
        $this->status = self::STATUS_PRESENT;
    }

    /**
     * @return bool
     */
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
            $this->created_at = date('Y-m-d H:i:s');
        }
        return true;
    }
    return false;
}
}
