<?php

namespace common\models;

use common\models\query\IngredientQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "ingredient".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 *
 * @property IngredientRecipe[] $ingredientRecipesRelation
 * @property Recipe[] $recipesRelation
 */
class Ingredient extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredient';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
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
            [['name'], 'string', 'max' => 255],
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
            'created_at' => 'Добавлено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredientRecipesRelation()
    {
        return $this->hasMany(IngredientRecipe::class, ['ingredient_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipesRelation()
    {
        return $this->hasMany(Recipe::class, ['id' => 'recipe_id'])
            ->via('ingredientRecipesRelation');
    }

    /**
     * {@inheritdoc}
     * @return IngredientQuery
     */
    public static function find()
    {
        return new IngredientQuery(get_called_class());
    }
}
