<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "accounts".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $client_id
 * @property integer $currency_id
 * @property string $name
 * @property string $type
 * @property integer $status
 */
class Accounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accounts';
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
            [['created_at', 'updated_at', 'client_id', 'currency_id', 'status'], 'integer'],
            [['name', 'type'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'client_id' => 'Пользователь',
            'currency_id' => 'Валюта',
            'name' => 'Название',
            'type' => 'Тип',
            'status' => 'Статус',
        ];
    }

    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }
    public function getTypeaccounts()
    {
        return $this->hasOne(TypeAccounts::className(), ['id' => 'type']);
    }

    public function getTransactions($start,$end)
    {
        return $this->hasMany(Transaction::className(), ['account_id' => 'id'])
            ->where(['between', 'created_at', $start, $end]);
    }

}
