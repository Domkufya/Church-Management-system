<?php
declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property int    $id
 * @property string $name
 * @property string $label
 * @property int    $level
 * @property int    $is_active
 */
class Roles extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'roles';
    }

    public function rules(): array
    {
        return [
            [['name', 'label'], 'required'],
            [['name', 'label'], 'string', 'max' => 100],
            ['level', 'integer'],
            ['is_active', 'integer'],
            ['is_active', 'default', 'value' => 1],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id'        => 'ID',
            'name'      => 'Role Name',
            'label'     => 'Display Label',
            'level'     => 'Level',
            'is_active' => 'Active',
        ];
    }

    // Relation back to users
    public function getUsers(): \yii\db\ActiveQuery
    {
        return $this->hasMany(User::class, ['role_id' => 'id']);
    }
}