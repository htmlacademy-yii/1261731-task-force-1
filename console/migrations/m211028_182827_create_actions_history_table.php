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
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%actions_history}}');
    }
}
