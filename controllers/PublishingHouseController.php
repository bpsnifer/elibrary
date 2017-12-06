<?php

namespace app\controllers;

use app\models\PublishingHouse;

class PublishingHouseController extends BaseController
{
    public $modelClass = 'app\models\PublishingHouse';

    /**
     * @api {POST} /publishing-house/:id/book/:bookId Добавить книгу к изданию
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
     * @api {DELETE} /publishing-house/:id/book/:bookId Добавить книгу к изданию
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
}
