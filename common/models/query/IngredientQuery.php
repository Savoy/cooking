<?php

namespace common\models\query;

use common\models\Ingredient;
use yii\helpers\ArrayHelper;

/**
 * This is the ActiveQuery class for [[Ingredient]].
 *
 * @see Ingredient
 */
class IngredientQuery extends \yii\db\ActiveQuery
{
    /**
     * @return $this
     */
    public function orderByName(): self
    {
        return $this->orderBy([Ingredient::tableName() . '.[[name]]' => SORT_ASC]);
    }

    /**
     * @inheritdoc
     * @return Ingredient[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Ingredient|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return array
     */
    public function asDropDownList(): array
    {
        return ArrayHelper::map($this->all(), 'id', 'name');
    }
}
