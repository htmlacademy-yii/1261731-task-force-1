<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%actions_history}}`.
 */
class m211028_182827_create_actions_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%actions_history}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'action' => $this->string(255),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull()
        ]);

        $this->addForeignKey(
            'fk-actions_history-user_id',
            'actions_history',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-actions_history-user_id',
            'actions_history',
        );
        
        $this->dropTable('{{%actions_history}}');
    }
}
