<?php

namespace app\models;

use \yii\db\ActiveRecord;

/**
 * Модель таблицы book
 *
 * @property int $id
 * @property int $author_id
 * @property string $name
 * @property int $year
 *
 * @property Author $author
 * @property PublishingHouse[] $publishingHouses
 */
class Book extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'name'], 'required'],
            [['author_id', 'year'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'targetClass' => Author::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublishingHouses()
    {
        return $this->hasMany(
            PublishingHouse::className(),
            ['id' => 'publishing_house_id']
        )->viaTable(
            'publishing_house_book',
            ['book_id' => 'id']
        );
    }
}