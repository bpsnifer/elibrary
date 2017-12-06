<?php

namespace app\models;

use \yii\db\ActiveRecord;

/**
 * Базовая модель
 * @package app\models
 */
class BaseModel extends ActiveRecord
{
    /** Сценарий детального просмотра */
    const SCENARIO_DETAIL = 'detail';

    protected $detailFields = [];

    /** @inheritdoc */
    public function fields()
    {
        $fields = parent::fields();
        if ($this->scenario == self::SCENARIO_DETAIL) {
            $fields = array_merge (
                $fields,
                $this->detailFields
            );
        }

        return $fields;
    }

}