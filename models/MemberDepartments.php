<?php

namespace app\models;

use yii\db\ActiveRecord;

class MemberDepartments extends ActiveRecord
{
    public static function tableName()
    {
        return 'member_departments';
    }

    public function rules()
    {
        return [
            [['member_id', 'department_id'], 'required'],
            [['member_id', 'department_id'], 'integer'],
            [['joined_date'], 'safe'],
            [['status'], 'in', 'range' => ['Pending', 'Approved', 'Rejected']],
        ];
    }

    public function getDepartment()
    {
        return $this->hasOne(Departments::class, ['id' => 'department_id']);
    }

    public function getMember()
    {
        return $this->hasOne(Members::class, ['id' => 'member_id']);
    }
}