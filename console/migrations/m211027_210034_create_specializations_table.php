<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%specializations}}`.
 */
class m211027_210034_create_specializations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%specializations}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%specializations}}');
    }
}
