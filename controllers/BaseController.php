<?php

namespace app\controllers;


use yii\rest\ActiveController;
use \yii\web\Response;

/**
 * Базовый контроллер
 * @package app\controllers
 */
class BaseController extends ActiveController
{
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'only' => ['index', 'view', 'create'],
                'formats' => ['application/json' => Response::FORMAT_JSON]
            ],
        ];
    }
}