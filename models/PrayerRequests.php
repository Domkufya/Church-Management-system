<?php

namespace app\models;

use yii\db\ActiveRecord;

class PrayerRequests extends ActiveRecord
{
    public static function tableName()
    {
        return 'prayer_requests';
    }

    public function rules()
    {
        return [
            [['request'], 'required'],
            [['request'], 'string'],
            [['member_id', 'is_anonymous'], 'integer'],
            [['status'], 'string', 'max' => 255],
            [['created_at'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => 'Member',
            'request' => 'Prayer Request',
            'is_anonymous' => 'Anonymous',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
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