<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "balance_start_year".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $amount
 * @property integer $client_id
 * @property integer $account_id
 * @property integer $status
 */
class BalanceStartYear extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'balance_start_year';
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
            [['created_at', 'updated_at', 'client_id', 'account_id', 'status'], 'integer'],
            [['amount'], 'number']
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
            'amount' => 'Amount',
            'client_id' => 'Client ID',
            'account_id' => 'Account ID',
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
}
