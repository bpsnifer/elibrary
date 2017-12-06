<?php

namespace app\controllers;

use app\models\Author;

class AuthorController extends BaseController
{
    public $modelClass = 'app\models\Author';

    /**
     * @api {GET} /author/:id Просмотреть автора детально
     *
     * @apiParam {Number} id ID автора.
     *
     * @apiSuccess {Number}   id                ID автора
     * @apiSuccess {String}   name              Имя автора
     * @apiSuccess {Object[]} Book              Список книг
     * @apiSuccess {Number}   Book.id           ID
     * @apiSuccess {Number}   Book.author_id    ID автора
     * @apiSuccess {String}   Book.title        Заголовок
     * @apiSuccess {String}   Book.description  Описание
     * @apiSuccess {Number}   Book.year         Год
     */
    public function actionDetail($id)
    {
        $author = Author::findOne($id);
        $author->scenario = Author::SCENARIO_DETAIL;

        return $author;
    }
}
