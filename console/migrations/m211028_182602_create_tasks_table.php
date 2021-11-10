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
            'user_id' => $this->integer()->notNull(),
            'title' => $this->text()->notNull(),
            'address' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'current_executor_id' => $this->integer()->notNull(),
            'status' => $this->string(255)->notNull(),
            'city_id' => $this->integer(),
            'latitude' => $this->string(255),
            'longitude' => $this->string(255),
            'budget' => $this->decimal(12, 2),
            'date_finished' => $this->dateTime(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull()
        ]);

        $this->addForeignKey(
            'fk-tasks-user_id',
            'tasks',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-tasks-category_id',
            'tasks',
            'category_id',
            'categories',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-tasks-city_id',
            'tasks',
            'city_id',
            'cities',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-tasks-current_executor_id',
            'tasks',
            'current_executor_id',
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
            'fk-tasks-user_id',
            'tasks'
        );

        $this->dropForeignKey(
            'fk-tasks-category_id',
            'tasks'
        );

        $this->dropForeignKey(
            'fk-tasks-city_id',
            'tasks'
        );

        $this->dropForeignKey(
            'fk-tasks-current_executor_id',
            'tasks'
        );

        $this->dropTable('{{%tasks}}');
    }
}
