<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Members extends ActiveRecord
{
    public static function tableName()
    {
        return 'members';
    }

    
    public function getName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            if (empty($this->membership_date)) {
                $this->membership_date = date('Y-m-d');
            }
            $this->created_at = date('Y-m-d H:i:s');
        }
        return parent::beforeSave($insert);
    }

    public function upload()
    {
        $file = UploadedFile::getInstance($this, 'photo');
        if ($file) {
            $fileName = 'member_' . time() . '.' . $file->extension;
            $file->saveAs(\Yii::getAlias('@webroot') . '/uploads/' . $fileName);
            $this->photo = $fileName;
        }
    }

    public function beforeDelete()
    {
        if ($this->photo) {
            $photoPath = \Yii::getAlias('@webroot') . '/uploads/' . $this->photo;
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }
        return parent::beforeDelete();
    }

    public function rules()
    {
        return [
            [['first_name', 'last_name', 'gender'], 'required'],
            [['dob', 'membership_date', 'created_at'], 'safe'],
            [['address'], 'string'],
            [['first_name', 'last_name'], 'string', 'max' => 100],
            [['gender'], 'in', 'range' => ['Male', 'Female']],
            [['marital_status'], 'in', 'range' => ['Single', 'Married', 'Widowed', 'Divorced']],
            [['status'], 'in', 'range' => ['Active', 'Inactive']],
            [['phone'], 'string', 'max' => 20],
            [['email'], 'email'],
            [['photo'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'dob' => 'Date of Birth',
            'phone' => 'Phone',
            'email' => 'Email',
            'address' => 'Address',
            'marital_status' => 'Marital Status',
            'membership_date' => 'Membership Date',
            'status' => 'Status',
            'photo' => 'Photo',
            'created_at' => 'Created At',
        ];
    }
}