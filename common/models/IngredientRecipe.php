<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ingredient_recipe".
 *
 * @property int $ingredient_id
 * @property int $recipe_id
 *
 * @property Ingredient $ingredient
 * @property Recipe $recipe
 */
class IngredientRecipe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredient_recipe';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ingredient_id', 'recipe_id'], 'required'],
            [['ingredient_id', 'recipe_id'], 'integer'],
            [['ingredient_id', 'recipe_id'], 'unique', 'targetAttribute' => ['ingredient_id', 'recipe_id']],
            [
                ['ingredient_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Ingredient::class,
                'targetAttribute' => ['ingredient_id' => 'id']
            ],
            [
                ['recipe_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Recipe::class,
                'targetAttribute' => ['recipe_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ingredient_id' => 'Ингредиент',
            'recipe_id' => 'Рецепт',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredient()
    {
        return $this->hasOne(Ingredient::class, ['id' => 'ingredient_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipe()
    {
        return $this->hasOne(Recipe::class, ['id' => 'recipe_id']);
    }
}
