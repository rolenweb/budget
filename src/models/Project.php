<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

use app\models\ProjectTransactionType;
/**
 * This is the model class for table "project".
 *
 * @property integer $id
 * @property string $domain
 * @property string $description
 * @property integer $group_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Project extends \yii\db\ActiveRecord
{
    const STATUS_STAR = 1;
    const STATUS_CASH_COW = 2;
    const STATUS_PROBLEM_CHILD = 3;
    const STATUS_DOG = 4;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
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
            [['description'], 'string'],
            [['group_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['domain'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'domain' => 'Domain',
            'description' => 'Description',
            'group_id' => 'Group ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getGroup()
    {
        return $this->hasOne(ProjectGroup::className(), ['id' => 'group_id']);
    }

    public function getTransactions()
    {
        return $this->hasMany(ProjectTransaction::className(), ['project_id' => 'id']);
    }

    public static function listStatusDD()
    {
        return [
            self::STATUS_STAR => 'Star',
            self::STATUS_CASH_COW => 'Cash cow',
            self::STATUS_PROBLEM_CHILD => 'Problem child',
            self::STATUS_DOG => 'Dog',
        ];
    }

    public function getStatusName()
    {
        if ($this->status === self::STATUS_STAR) {
            return 'Star';
        }
        if ($this->status === self::STATUS_CASH_COW) {
            return 'Cash cow';
        }
        if ($this->status === self::STATUS_PROBLEM_CHILD) {
            return 'Problem child';
        }
        if ($this->status === self::STATUS_DOG) {
            return 'Dog';
        }
    }

    public function getProfit()
    {
        $out = 0;
        $transactions = $this->transactions;
        if(empty($transactions)){
            return $out;
        }
        foreach ($transactions as $transaction) {
            if ($transaction->type->type == ProjectTransactionType::TYPE_COST) {
                $out -= $transaction->value;
            }
            if ($transaction->type->type == ProjectTransactionType::TYPE_INCOME) {
                $out += $transaction->value;
            }
        }
        return $out;
    }
}
