<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat_messages}}`.
 */
class m211028_183011_create_chat_messages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chat_messages}}', [
            'id' => $this->primaryKey(),
            'content' => $this->text()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'chat_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull()
        ]);

        $this->addForeignKey(
            'fk-chat_messages-user_id',
            'chat_messages',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-chat_messages-chat_id',
            'chat_messages',
            'chat_id',
            'chats',
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
            'fk-chat_messages-user_id',
            'chat_messages'
        );

        $this->dropForeignKey(
            'fk-chat_messages-chat_id',
            'chat_messages'
        );

        $this->dropTable('{{%chat_messages}}');
    }
}
