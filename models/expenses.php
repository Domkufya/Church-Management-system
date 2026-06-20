<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expenses".
 *
 * @property int $id
 * @property string $title
 * @property float $amount
 * @property string|null $category
 * @property string $expense_date
 * @property string|null $description
 * @property int|null $approved_by
 * @property string|null $receipt_photo
 * @property string|null $created_at
 *
 * @property Users $approvedBy
 */
class expenses extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const CATEGORY_UTILITIES = 'Utilities';
    const CATEGORY_SALARIES = 'Salaries';
    const CATEGORY_MAINTENANCE = 'Maintenance';
    const CATEGORY_EVENTS = 'Events';
    const CATEGORY_CHARITY = 'Charity';
    const CATEGORY_OTHER = 'Other';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expenses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'approved_by', 'receipt_photo'], 'default', 'value' => null],
            [['category'], 'default', 'value' => 'Other'],
            [['title', 'amount', 'expense_date'], 'required'],
            [['amount'], 'number'],
            [['category', 'description'], 'string'],
            [['expense_date', 'created_at'], 'safe'],
            [['approved_by'], 'integer'],
            [['title'], 'string', 'max' => 200],
            [['receipt_photo'], 'string', 'max' => 255],
            ['category', 'in', 'range' => array_keys(self::optsCategory())],
            [['approved_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['approved_by' => 'id']],
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
            'amount' => 'Amount',
            'category' => 'Category',
            'expense_date' => 'Expense Date',
            'description' => 'Description',
            'approved_by' => 'Approved By',
            'receipt_photo' => 'Receipt Photo',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[ApprovedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApprovedBy()
    {
        return $this->hasOne(Users::class, ['id' => 'approved_by']);
    }


    /**
     * column category ENUM value labels
     * @return string[]
     */
    public static function optsCategory()
    {
        return [
            self::CATEGORY_UTILITIES => 'Utilities',
            self::CATEGORY_SALARIES => 'Salaries',
            self::CATEGORY_MAINTENANCE => 'Maintenance',
            self::CATEGORY_EVENTS => 'Events',
            self::CATEGORY_CHARITY => 'Charity',
            self::CATEGORY_OTHER => 'Other',
        ];
    }

    /**
     * @return string
     */
    public function displayCategory()
    {
        return self::optsCategory()[$this->category];
    }

    /**
     * @return bool
     */
    public function isCategoryUtilities()
    {
        return $this->category === self::CATEGORY_UTILITIES;
    }

    public function setCategoryToUtilities()
    {
        $this->category = self::CATEGORY_UTILITIES;
    }

    /**
     * @return bool
     */
    public function isCategorySalaries()
    {
        return $this->category === self::CATEGORY_SALARIES;
    }

    public function setCategoryToSalaries()
    {
        $this->category = self::CATEGORY_SALARIES;
    }

    /**
     * @return bool
     */
    public function isCategoryMaintenance()
    {
        return $this->category === self::CATEGORY_MAINTENANCE;
    }

    public function setCategoryToMaintenance()
    {
        $this->category = self::CATEGORY_MAINTENANCE;
    }

    /**
     * @return bool
     */
    public function isCategoryEvents()
    {
        return $this->category === self::CATEGORY_EVENTS;
    }

    public function setCategoryToEvents()
    {
        $this->category = self::CATEGORY_EVENTS;
    }

    /**
     * @return bool
     */
    public function isCategoryCharity()
    {
        return $this->category === self::CATEGORY_CHARITY;
    }

    public function setCategoryToCharity()
    {
        $this->category = self::CATEGORY_CHARITY;
    }

    /**
     * @return bool
     */
    public function isCategoryOther()
    {
        return $this->category === self::CATEGORY_OTHER;
    }

    public function setCategoryToOther()
    {
        $this->category = self::CATEGORY_OTHER;
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
