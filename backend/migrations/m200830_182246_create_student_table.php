<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%student}}`.
 */
class m200830_182246_create_student_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%student}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(30)->notNull(),
            'last_name' => $this->string(30)->notNull(),
            'email' => $this->string(50),
            'pocket_money' => $this->integer(),
            'password' => $this->string()->notNull(),
            'is_deleted'=> $this->integer(1)->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%student}}');
    }
}
