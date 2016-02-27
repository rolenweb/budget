<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "type_debit_credit".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $type
 * @property string $name
 * @property integer $parent_id
 * @property integer $status
 */
class TypeDebitCredit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type_debit_credit';
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
            [['created_at', 'updated_at', 'type', 'parent_id', 'status'], 'integer'],
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
            'type' => 'Type',
            'name' => 'Name',
            'parent_id' => 'Parent ID',
            'status' => 'Status',
        ];
    }

    public function getParent()
    {
        return $this->hasOne(TypeDebitCredit::className(), ['id' => 'parent_id']);
    }
}
