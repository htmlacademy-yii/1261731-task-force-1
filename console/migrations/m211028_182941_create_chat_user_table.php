<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat_user}}`.
 */
class m211028_182941_create_chat_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chat_user}}', [            
            'chat_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%chat_user}}');
    }
}
