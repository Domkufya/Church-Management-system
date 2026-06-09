<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $leader_id
 * @property string|null $created_at
 *
 * @property Members $leader
 * @property MemberDepartments[] $memberDepartments
 */
class departments extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'leader_id'], 'default', 'value' => null],
            [['name'], 'required'],
            [['description'], 'string'],
            [['leader_id'], 'integer'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['leader_id'], 'exist', 'skipOnError' => true, 'targetClass' => Members::class, 'targetAttribute' => ['leader_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'leader_id' => 'Leader ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Leader]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLeader()
    {
        return $this->hasOne(Members::class, ['id' => 'leader_id']);
    }

    /**
     * Gets query for [[MemberDepartments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemberDepartments()
    {
        return $this->hasMany(MemberDepartments::class, ['department_id' => 'id']);
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
