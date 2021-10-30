<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%specialization_user}}`.
 */
class m211028_182449_create_specialization_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%specialization_user}}', [
            'specialization_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%specialization_user}}');
    }
}
