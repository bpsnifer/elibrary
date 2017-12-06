<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Добавляет таблицу Author
 */
class m171206_184728_add_table_author extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('author', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('author');
    }
}