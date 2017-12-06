<?php

namespace app\models;

use \yii\db\ActiveRecord;

/**
 * Модель таблицы publishing_house
 *
 * @property int $id
 * @property string $name
 *
 * Реляции
 * @property Book[] $books
 */
class PublishingHouse extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publishing_house';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * Получить книги издания
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(
            Book::className(),
            ['id' => 'book_id']
        )->viaTable(
            'publishing_house_book',
            ['publishing_house_id' => 'id']
        );
    }


    /**
     * Добавляет книгу к издательству
     * @param int $bookId
     * @return null|string
     */
    public function addBook($bookId)
    {
        $book = Book::findOne($bookId);
        if ($book === null) {
            return 'Book not found.';
        }

        if ($this->bookExists($book)) {
            return 'Book already in publishing house.';
        }

        try {
            $this->link('books', $book);
        } catch (\Exception $e) {
            return 'Error when adding publishing house.';
        }

        return null;
    }

    /**
     * Удаляет книгу из издания
     * @param int $bookId
     * @return null|string
     */
    public function removeBook($bookId)
    {
        $book = Book::findOne($bookId);
        if ($book === null) {
            return 'Book not found.';
        }

        if (!$this->bookExists($book)) {
            return 'Book not in publishing house.';
        }

        try {
            $this->unlink('books', $book, true);
        } catch (\Exception $e) {
            return 'Error when removing book.';
        }

        return null;
    }

    /**
     * Проверяем есть ли книга у этого издательства
     * @param Book $book
     * @return bool
     */
    protected function bookExists(Book $book)
    {
        return $book !== null && $this->getBooks()
                ->where(['id' => $book->id])
                ->exists();
    }
}