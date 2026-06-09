<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "children".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $dob
 * @property string|null $gender
 * @property int|null $parent_id
 * @property string|null $class
 * @property string|null $status
 *
 * @property Members $parent
 */
class children extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const GENDER_MALE = 'Male';
    const GENDER_FEMALE = 'Female';
    const STATUS_ACTIVE = 'Active';
    const STATUS_INACTIVE = 'Inactive';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'children';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dob', 'gender', 'parent_id', 'class'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 'Active'],
            [['first_name', 'last_name'], 'required'],
            [['dob'], 'safe'],
            [['gender', 'status'], 'string'],
            [['parent_id'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 100],
            [['class'], 'string', 'max' => 50],
            ['gender', 'in', 'range' => array_keys(self::optsGender())],
            ['status', 'in', 'range' => array_keys(self::optsStatus())],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Members::class, 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'dob' => 'Dob',
            'gender' => 'Gender',
            'parent_id' => 'Parent ID',
            'class' => 'Class',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Members::class, ['id' => 'parent_id']);
    }


    /**
     * column gender ENUM value labels
     * @return string[]
     */
    public static function optsGender()
    {
        return [
            self::GENDER_MALE => 'Male',
            self::GENDER_FEMALE => 'Female',
        ];
    }

    /**
     * column status ENUM value labels
     * @return string[]
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
        ];
    }

    /**
     * @return string
     */
    public function displayGender()
    {
        return self::optsGender()[$this->gender];
    }

    /**
     * @return bool
     */
    public function isGenderMale()
    {
        return $this->gender === self::GENDER_MALE;
    }

    public function setGenderToMale()
    {
        $this->gender = self::GENDER_MALE;
    }

    /**
     * @return bool
     */
    public function isGenderFemale()
    {
        return $this->gender === self::GENDER_FEMALE;
    }

    public function setGenderToFemale()
    {
        $this->gender = self::GENDER_FEMALE;
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
    public function isStatusActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function setStatusToActive()
    {
        $this->status = self::STATUS_ACTIVE;
    }

    /**
     * @return bool
     */
    public function isStatusInactive()
    {
        return $this->status === self::STATUS_INACTIVE;
    }

    public function setStatusToInactive()
    {
        $this->status = self::STATUS_INACTIVE;
    }
}
