<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member_departments".
 *
 * @property int $id
 * @property int $member_id
 * @property int $department_id
 * @property string|null $joined_date
 *
 * @property Departments $department
 * @property Members $member
 */
class member_derpartments extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member_departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
{
    
}
    return [
            [['joined_date'], 'default', 'value' => null],
            [['member_id', 'department_id'], 'required'],
            [['member_id', 'department_id'], 'integer'],
            [['joined_date'], 'safe'],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Members::class, 'targetAttribute' => ['member_id' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::class, 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => 'Member ID',
            'department_id' => 'Department ID',
            'joined_date' => 'Joined Date',
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Departments::class, ['id' => 'department_id']);
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

}
