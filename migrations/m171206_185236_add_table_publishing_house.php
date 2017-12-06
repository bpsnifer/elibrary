<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Добавляет таблицу Publishing house
 */
class m171206_185236_add_table_publishing_house extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $options = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('publishing_house', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
        ], $options);

        $this->createTable('publishing_house_book', [
            'publishing_house_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'book_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $options);

        $this->createIndex(
            'idx_ph_publishing_house',
            'publishing_house_book',
            'publishing_house_id'
        );
        $this->addForeignKey(
            'fk_ph_publishing_house',
            'publishing_house_book',
            'publishing_house_id',
            'publishing_house',
            'id'
        );
        $this->createIndex(
            'idx_ph_book',
            'publishing_house_book',
            'book_id'
        );
        $this->addForeignKey(
            'fk_ph_book',
            'publishing_house_book',
            'book_id',
            'book',
            'id'
        );

        $this->createIndex('idx_unique_publishing_house_book',
            'publishing_house_book',
            [
                'book_id',
                'publishing_house_id'
            ],
            true
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_ph_book', 'publishing_house_book');
        $this->dropForeignKey('fk_ph_publishing_house', 'publishing_house_book');
        $this->delete('publishing_house_book');
        $this->delete('publishing_house');
    }

}