<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $event_date
 * @property string|null $start_time
 * @property string|null $end_time
 * @property string|null $location
 * @property string|null $type
 * @property string|null $created_at
 *
 * @property Attendance[] $attendances
 */
class events extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const TYPE_SERVICE = 'Service';
    const TYPE_MEETING = 'Meeting';
    const TYPE_SEMINAR = 'Seminar';
    const TYPE_CONFERENCE = 'Conference';
    const TYPE_OTHER = 'Other';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'start_time', 'end_time', 'location'], 'default', 'value' => null],
            [['type'], 'default', 'value' => 'Service'],
            [['title', 'event_date'], 'required'],
            [['description', 'type'], 'string'],
            [['event_date', 'start_time', 'end_time', 'created_at'], 'safe'],
            [['title', 'location'], 'string', 'max' => 200],
            ['type', 'in', 'range' => array_keys(self::optsType())],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'event_date' => 'Event Date',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'location' => 'Location',
            'type' => 'Type',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Attendances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttendances()
    {
        return $this->hasMany(Attendance::class, ['event_id' => 'id']);
    }


    /**
     * column type ENUM value labels
     * @return string[]
     */
    public static function optsType()
    {
        return [
            self::TYPE_SERVICE => 'Service',
            self::TYPE_MEETING => 'Meeting',
            self::TYPE_SEMINAR => 'Seminar',
            self::TYPE_CONFERENCE => 'Conference',
            self::TYPE_OTHER => 'Other',
        ];
    }

    /**
     * @return string
     */
    public function displayType()
    {
        return self::optsType()[$this->type];
    }

    /**
     * @return bool
     */
    public function isTypeService()
    {
        return $this->type === self::TYPE_SERVICE;
    }

    public function setTypeToService()
    {
        $this->type = self::TYPE_SERVICE;
    }

    /**
     * @return bool
     */
    public function isTypeMeeting()
    {
        return $this->type === self::TYPE_MEETING;
    }

    public function setTypeToMeeting()
    {
        $this->type = self::TYPE_MEETING;
    }

    /**
     * @return bool
     */
    public function isTypeSeminar()
    {
        return $this->type === self::TYPE_SEMINAR;
    }

    public function setTypeToSeminar()
    {
        $this->type = self::TYPE_SEMINAR;
    }

    /**
     * @return bool
     */
    public function isTypeConference()
    {
        return $this->type === self::TYPE_CONFERENCE;
    }

    public function setTypeToConference()
    {
        $this->type = self::TYPE_CONFERENCE;
    }

    /**
     * @return bool
     */
    public function isTypeOther()
    {
        return $this->type === self::TYPE_OTHER;
    }

    public function setTypeToOther()
    {
        $this->type = self::TYPE_OTHER;
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




