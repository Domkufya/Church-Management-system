<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prayer_request".
 *
 * @property int $id
 * @property string|null $full_name
 * @property string $phone_number
 * @property string $category
 * @property string $title
 * @property string $description
 * @property string|null $status
 * @property string $created_at
 */
class PrayerRequest extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prayer_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 'Pending'],
            [['phone_number', 'category', 'title', 'description'], 'required'],
            [['description'], 'string'],
            [['created_at'], 'safe'],
            [['full_name', 'title'], 'string', 'max' => 255],
            [['phone_number', 'status'], 'string', 'max' => 20],
            [['category'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'phone_number' => 'Phone Number',
            'category' => 'Category',
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

}
