<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chats}}`.
 */
class m211028_182908_create_chats_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chats}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),        
            'task_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull()
        ]);

        $this->addForeignKey(
            'fk-chats-task_id',
            'chats',
            'task_id',
            'tasks',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-chats-author_id',
            'chats',
            'author_id',
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
            'fk-chats-task_id',
            'chats'
        );

        $this->dropForeignKey(
            'fk-chats-author_id',
            'chats'
        );

        $this->dropTable('{{%chats}}');
    }
}
