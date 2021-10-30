<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%files}}`.
 */
class m211028_182632_create_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%files}}', [
            'id' => $this->primaryKey(),
            'path_file' => $this->string(255),
            'task_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull()
        ]);

        $this->addForeignKey(
            'fk-files-task_id',
            'files',
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
            'fk-files-task_id',
            'files'
        );

        $this->dropTable('{{%files}}');
    }
}
