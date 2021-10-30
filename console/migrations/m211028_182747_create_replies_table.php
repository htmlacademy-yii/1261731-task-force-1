<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%replies}}`.
 */
class m211028_182747_create_replies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%replies}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'task_id' => $this->integer()->notNull(),
            'cost' => $this->decimal(12, 2),
            'comment' => $this->text()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull()
        ]);

        $this->addForeignKey(
            'fk-replies-user_id',
            'replies',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-replies-task_id',
            'replies',
            'task_id',
            'tasks',
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
            'fk-replies-user_id',
            'replies'
        );

        $this->dropForeignKey(
            'fk-replies-task_id',
            'replies'
        );

        $this->dropTable('{{%replies}}');
    }
}
