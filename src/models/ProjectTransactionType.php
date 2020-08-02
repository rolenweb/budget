<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "project_transaction_type".
 *
 * @property integer $id
 * @property string $title
 * @property integer $type
 * @property integer $currency_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class ProjectTransactionType extends \yii\db\ActiveRecord
{
    const TYPE_COST = 1;
    const TYPE_INCOME = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_transaction_type';
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
            [['type', 'currency_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'type' => 'Type',
            'currency_id' => 'Currency ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }

    public static function listDD()
    {
        return [
            1 => 'Cost',
            2 => 'Income',
        ];
    }

    public function typeName()
    {
        if ($this->type === self::TYPE_COST) {
            return 'Cost';
        }
        if ($this->type === self::TYPE_INCOME) {
            return 'Income';
        }
    }
}
