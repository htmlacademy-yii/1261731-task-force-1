<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%photos_of_works}}`.
 */
class m211028_182232_create_photos_of_works_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%photos_of_works}}', [
            'id' => $this->primaryKey(),
            'path_file' => $this->string(255),
            'user_id' => $this->integer()->notNull() . 'UNSIGNED',
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull() 
        ]);

        $this->addForeignKey(
            'fk-photos_of_works-user_id',
            'photos_of_works',
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
            'fk-photos_of_works-user_id',
            'photos_of_works'
        );

        $this->dropTable('{{%photos_of_works}}');
    }
}
