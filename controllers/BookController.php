<?php

namespace app\controllers;

use app\models\Book;

class BookController extends BaseController
{
    public $modelClass = 'app\models\Book';

    /**
     * @api {GET} /author/:id Просмотреть книгу детально
     *
     * @apiParam {Number} id ID книги.
     *
     * @apiSuccess {Number}   id                     ID книги
     * @apiSuccess {String}   title                  Заголовок книги
     * @apiSuccess {String}   description            Описание книги
     * @apiSuccess {Number}   year                   Год книги
     * @apiSuccess {Object}   Author                 Автор
     * @apiSuccess {Number}   Author.id              ID автора
     * @apiSuccess {String}   Author.name            Имя автора
     * @apiSuccess {Object[]} PublishingHouse        Список издательств
     * @apiSuccess {Number}   PublishingHouse.id     ID издетсльства
     * @apiSuccess {String}   PublishingHouse.name   Название издательства
     */
    public function actionDetail($id)
    {
        $book = Book::findOne($id);
        $book->scenario = Book::SCENARIO_DETAIL;

        return $book;
    }
}
