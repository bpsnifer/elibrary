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

}