<?php

namespace app\models;

/**
 * Модель таблицы book
 *
 * @property int $id
 * @property int $author_id
 * @property string $title
 * @property string $description
 * @property int $year
 *
 * @property Author $author
 * @property PublishingHouse[] $publishingHouses
 */
class Book extends BaseModel
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->detailFields = [
            'author',
            'publishing_houses' => function ($model) {
                return $model->publishingHouses;
            }
        ];
    }

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
            [['author_id', 'title'], 'required'],
            [['author_id', 'year'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['description'], 'string'],
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