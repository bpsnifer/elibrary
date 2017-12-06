<?php

namespace app\controllers;

use app\models\PublishingHouse;

class PublishingHouseController extends BaseController
{
    public $modelClass = 'app\models\PublishingHouse';

    /**
     * @api {POST} /publishing-house/:id/book/:bookId Добавить книгу к издательству
     *
     * @apiParam {Number} id ID издания.
     * @apiParam {Number} bookId ID книги.
     *
     * @apiSuccess {Bool} success success=true
     */
    public function actionAddBook($id, $bookId)
    {
        $publishingHouse = PublishingHouse::findOne($id);
        if ($publishingHouse === null) {
            return [
                'name' => 'Adding book',
                'message' => 'Publishing house not found'
            ];
        }

        $res = $publishingHouse->addBook($bookId);
        if ($res !== null) {
            $res = [
                'name' => 'Adding book',
                'message' => $res,
            ];
        } else {
            $res = ['success' => true];
        }

        return $res;
    }

    /**
     * @api {DELETE} /publishing-house/:id/book/:bookId Добавить книгу к издательству
     *
     * @apiParam {Number} id ID издания.
     * @apiParam {Number} bookId ID книги.
     *
     * @apiSuccess {Bool} success success=true
     */
    public function actionRemoveBook($id, $bookId)
    {
        $publishingHouse = PublishingHouse::findOne($id);
        if ($publishingHouse === null) {
            return [
                'name' => 'Removing book',
                'message' => 'Publishing house not found'
            ];
        }

        $res = $publishingHouse->removeBook($bookId);
        if ($res !== null) {
            $res = [
                'name' => 'Removing book',
                'message' => $res,
            ];
        } else {
            $res = ['success' => true];
        }

        return $res;
    }

    /**
     * @api {GET} /publishing-house/:id Просмотреть издательство детально
     *
     * @apiParam {Number} id ID издательства.
     *
     * @apiSuccess {Number}   id                ID издательства
     * @apiSuccess {String}   name              Название издательства
     * @apiSuccess {Object[]} Book              Список книг
     * @apiSuccess {Number}   Book.id           ID
     * @apiSuccess {Number}   Book.author_id    ID автора
     * @apiSuccess {String}   Book.title        Заголовок
     * @apiSuccess {String}   Book.description  Описание
     * @apiSuccess {Number}   Book.year         Год
     */
    public function actionDetail($id)
    {
        $publishingHouse = PublishingHouse::findOne($id);
        $publishingHouse->scenario = PublishingHouse::SCENARIO_DETAIL;

        return $publishingHouse;
    }
}
