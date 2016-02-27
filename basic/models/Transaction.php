<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "transaction".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $name
 * @property string $amount
 * @property integer $client_id
 * @property integer $account_id
 * @property integer $type_debit_credit_id
 * @property integer $comment_id
 * @property integer $status
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'client_id', 'account_id', 'type_debit_credit_id', 'comment_id', 'status'], 'integer'],
            [['amount'], 'number'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'name' => 'Name',
            'amount' => 'Amount',
            'client_id' => 'Client ID',
            'account_id' => 'Account ID',
            'type_debit_credit_id' => 'Type Debit Credit ID',
            'comment_id' => 'Comment ID',
            'status' => 'Status',
        ];
    }

    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }
    public function getAccount()
    {
        return $this->hasOne(Accounts::className(), ['id' => 'account_id']);
    }
    public function getType()
    {
        return $this->hasOne(TypeDebitCredit::className(), ['id' => 'type_debit_credit_id']);
    }
    public function getComment()
    {
        return $this->hasOne(Comment::className(), ['id' => 'comment_id']);
    }
}
