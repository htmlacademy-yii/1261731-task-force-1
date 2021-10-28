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
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%photos_of_works}}');
    }
}
