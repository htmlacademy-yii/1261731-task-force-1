<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tasks}}`.
 */
class m211028_182602_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tasks}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull() . 'UNSIGNED',
            'title' => $this->text()->notNull(),
            'address' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'category_id' => $this->integer()->notNull() . 'UNSIGNED',
            'current_executor_id' => $this->intege()->notNull() . 'UNSIGNED',
            'status' => $this->string(255)-notNull(),
            'city_id' => $this->integer() . 'UNSIGNED'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tasks}}');
    }
}
