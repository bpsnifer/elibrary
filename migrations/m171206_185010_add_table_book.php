<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Добавляет таблицу Book
 */
class m171206_185010_add_table_book extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('book', [
            'id' => Schema::TYPE_PK,
            'author_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'year' => Schema::TYPE_INTEGER,
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->createIndex('fk_book_author', 'book', 'author_id');
        $this->addForeignKey('fk_book_author', 'book', 'author_id', 'author', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_book_author', 'book');
        $this->delete('book');
    }
}