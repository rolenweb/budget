<?php

use yii\db\Migration;

/**
 * Handles the creation of table `project_transaction`.
 */
class m161212_091822_create_project_transaction_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('project_transaction', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->text(),
            'project_id' => $this->integer(),
            'type_id' => $this->integer(),
            'value' => $this->float(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('project_transaction');
    }
}
