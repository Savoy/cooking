<?php

namespace common\models;

use voskobovich\linker\LinkerBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "recipe".
 *
 * @property int $id
 * @property string $name
 * @property int $cooking_time
 * @property string $created_at
 * @property string $updated_at
 *
 * @property array $ingredients
 *
 * @property IngredientRecipe[] $ingredientRecipesRelation
 * @property Ingredient[] $ingredientsRelation
 */
class Recipe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recipe';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
            ],
            'ManyToManyBehaviour' => [
                'class' => LinkerBehavior::class,
                'relations' => [
                    'ingredients' => 'ingredientsRelation',
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['cooking_time'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [
                ['ingredients'],
                'exist',
                'targetClass' => Ingredient::class,
                'targetAttribute' => 'id',
                'allowArray' => true,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'cooking_time' => 'Время приготовления, мин',
            'ingredients' => 'Ингредиенты',
            'created_at' => 'Добавлено',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredientRecipesRelation()
    {
        return $this->hasMany(IngredientRecipe::class, ['recipe_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredientsRelation()
    {
        return $this->hasMany(Ingredient::class, ['id' => 'ingredient_id'])
            ->via('ingredientRecipesRelation');
    }
}
