<?php

use yii\db\Migration;

/**
 * Handles the creation of table `project_transaction_type`.
 */
class m161212_092320_create_project_transaction_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('project_transaction_type', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'type' => $this->integer(),
            'currency_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('project_transaction_type');
    }
}
