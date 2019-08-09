<?php

namespace frontend\models;

use common\models\Ingredient;
use yii\base\Model;

class FoodModel extends Model
{
    public $ingredients;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ingredients'], 'required', 'message' => 'Необходимо выбрать продукты.'],
            [
                ['ingredients'],
                'exist',
                'targetClass' => Ingredient::class,
                'targetAttribute' => 'id',
                'allowArray' => true,
                'message' => 'Выбраны отсутствующие продукты. Обновите страницу и повторите попытку.',
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'ingredients' => 'Продукты',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function formName()
    {
        return '';
    }
}
