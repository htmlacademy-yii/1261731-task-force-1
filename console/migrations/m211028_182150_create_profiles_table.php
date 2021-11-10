<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profiles}}`.
 */
class m211028_182150_create_profiles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%profiles}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'address' => $this->string(255),
            'bd' => $this->date(),
            'about' => $this->text(),
            'phone' => $this->string(255),
            'skype' => $this->string(255),
            'telegram' => $this->string(255),
            'age' => $this->integer()->unsigned()->notNull(),
            'photo' => $this->string(255),
            'is_notefecation_enabled' => $this->tinyInteger(1),
            'show_contacts' => $this->tinyInteger(1),
            'show_profile' => $this->tinyInteger(1),
            'city_id' => $this->integer(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull() 
        ]);

        $this->addForeignKey(
            'fk-profiles-user_id',
            '{{%profiles}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-profiles-city_id',
            '{{%profiles}}',
            'city_id',
            '{{%cities}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-profiles-user_id',
            'profiles'
        );

        $this->dropForeignKey(
            'fk-profiles-city_id',
            'profiles',
        );

        $this->dropTable('{{%profiles}}');
    }
}
