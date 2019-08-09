<?php

namespace frontend\components;

use common\models\IngredientRecipe;
use common\models\Recipe;
use frontend\models\FoodModel;
use yii\base\Component;
use yii\base\ErrorException;
use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * SelectorComponent
 *
 * Класс для подбора блюд по заданным ингредиентам
 */
class SelectorComponent extends Component
{
    /**
     * @param FoodModel $model
     *
     * @return array|\yii\db\ActiveRecord[]
     * @throws ErrorException
     */
    public function select(FoodModel $model): array
    {
        if ($model->validate()) {
            $query = Recipe::find()->alias('r')
                ->select(['[[r]].*'])
                ->joinWith([
                    'ingredientRecipesRelation' => function (ActiveQuery $query) use ($model) {
                        return $query->alias('ir')->andOnCondition(['[[ir]].[[ingredient_id]]' => $model->ingredients]);
                    },
                ], false)
                ->groupBy('[[r]].[[id]]')
                ->having([
                    '=',
                    new Expression('COUNT([[ir]].[[ingredient_id]])'),
                    count($model->ingredients)
                ])
                ->orderBy('[[r]].[[name]]');

            return $query->all();
        }

        throw new ErrorException('Неверный запрос');
    }
}
