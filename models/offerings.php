<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "offerings".
 *
 * @property int $id
 * @property int|null $member_id
 * @property float $amount
 * @property string|null $type
 * @property string|null $payment_method
 * @property string $offering_date
 * @property int|null $received_by
 * @property string|null $notes
 * @property string|null $created_at
 *
 * @property Members $member
 * @property Users $receivedBy
 */
class offerings extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const TYPE_TITHE = 'Tithe';
    const TYPE_OFFERING = 'Offering';
    const TYPE_DONATION = 'Donation';
    const TYPE_FUNDRAISING = 'Fundraising';
    const TYPE_OTHER = 'Other';
    const PAYMENT_METHOD_CASH = 'Cash';
    const PAYMENT_METHOD_MOBILE_MONEY = 'Mobile Money';
    const PAYMENT_METHOD_BANK_TRANSFER = 'Bank Transfer';
    const PAYMENT_METHOD_CHEQUE = 'Cheque';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offerings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member_id', 'received_by', 'notes'], 'default', 'value' => null],
            [['type'], 'default', 'value' => 'Offering'],
            [['payment_method'], 'default', 'value' => 'Cash'],
            [['member_id', 'received_by'], 'integer'],
            [['amount', 'offering_date'], 'required'],
            [['amount'], 'number'],
            [['type', 'payment_method', 'notes'], 'string'],
            [['offering_date', 'created_at'], 'safe'],
            ['type', 'in', 'range' => array_keys(self::optsType())],
            ['payment_method', 'in', 'range' => array_keys(self::optsPaymentMethod())],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Members::class, 'targetAttribute' => ['member_id' => 'id']],
            [['received_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['received_by' => 'id']],
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
            'amount' => 'Amount',
            'type' => 'Type',
            'payment_method' => 'Payment Method',
            'offering_date' => 'Offering Date',
            'received_by' => 'Received By',
            'notes' => 'Notes',
            'created_at' => 'Created At',
        ];
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

    /**
     * Gets query for [[ReceivedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceivedBy()
    {
        return $this->hasOne(Users::class, ['id' => 'received_by']);
    }


    /**
     * column type ENUM value labels
     * @return string[]
     */
    public static function optsType()
    {
        return [
            self::TYPE_TITHE => 'Tithe',
            self::TYPE_OFFERING => 'Offering',
            self::TYPE_DONATION => 'Donation',
            self::TYPE_FUNDRAISING => 'Fundraising',
            self::TYPE_OTHER => 'Other',
        ];
    }

    /**
     * column payment_method ENUM value labels
     * @return string[]
     */
    public static function optsPaymentMethod()
    {
        return [
            self::PAYMENT_METHOD_CASH => 'Cash',
            self::PAYMENT_METHOD_MOBILE_MONEY => 'Mobile Money',
            self::PAYMENT_METHOD_BANK_TRANSFER => 'Bank Transfer',
            self::PAYMENT_METHOD_CHEQUE => 'Cheque',
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
    public function isTypeTithe()
    {
        return $this->type === self::TYPE_TITHE;
    }

    public function setTypeToTithe()
    {
        $this->type = self::TYPE_TITHE;
    }

    /**
     * @return bool
     */
    public function isTypeOffering()
    {
        return $this->type === self::TYPE_OFFERING;
    }

    public function setTypeToOffering()
    {
        $this->type = self::TYPE_OFFERING;
    }

    /**
     * @return bool
     */
    public function isTypeDonation()
    {
        return $this->type === self::TYPE_DONATION;
    }

    public function setTypeToDonation()
    {
        $this->type = self::TYPE_DONATION;
    }

    /**
     * @return bool
     */
    public function isTypeFundraising()
    {
        return $this->type === self::TYPE_FUNDRAISING;
    }

    public function setTypeToFundraising()
    {
        $this->type = self::TYPE_FUNDRAISING;
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

    /**
     * @return string
     */
    public function displayPaymentMethod()
    {
        return self::optsPaymentMethod()[$this->payment_method];
    }

    /**
     * @return bool
     */
    public function isPaymentMethodCash()
    {
        return $this->payment_method === self::PAYMENT_METHOD_CASH;
    }

    public function setPaymentMethodToCash()
    {
        $this->payment_method = self::PAYMENT_METHOD_CASH;
    }

    /**
     * @return bool
     */
    public function isPaymentMethodMobileMoney()
    {
        return $this->payment_method === self::PAYMENT_METHOD_MOBILE_MONEY;
    }

    public function setPaymentMethodToMobileMoney()
    {
        $this->payment_method = self::PAYMENT_METHOD_MOBILE_MONEY;
    }

    /**
     * @return bool
     */
    public function isPaymentMethodBankTransfer()
    {
        return $this->payment_method === self::PAYMENT_METHOD_BANK_TRANSFER;
    }

    public function setPaymentMethodToBankTransfer()
    {
        $this->payment_method = self::PAYMENT_METHOD_BANK_TRANSFER;
    }

    /**
     * @return bool
     */
    public function isPaymentMethodCheque()
    {
        return $this->payment_method === self::PAYMENT_METHOD_CHEQUE;
    }

    public function setPaymentMethodToCheque()
    {
        $this->payment_method = self::PAYMENT_METHOD_CHEQUE;

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
