<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m260927_150732_create_books_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%books}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'author' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%books}}');
    }
}
