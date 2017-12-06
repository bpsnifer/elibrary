<?php

namespace app\models;

/**
 * Модель таблицы author
 *
 * @property int $id
 * @property string $name
 *
 * @property Book[] $books
 */
class Author extends BaseModel
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->detailFields = [
            'books' => function ($model) {
                return $model->books;
            }
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'author';
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
     * Получить книги автора
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['author_id' => 'id']);
    }
}