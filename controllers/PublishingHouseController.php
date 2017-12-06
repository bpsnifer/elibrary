<?php

namespace app\controllers;

use app\models\PublishingHouse;

class PublishingHouseController extends BaseController
{
    public $modelClass = 'app\models\PublishingHouse';


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
        }

        return $res;
    }

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
        }

        return $res;
    }
}
