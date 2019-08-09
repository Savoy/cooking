<?php

namespace frontend\controllers;

use frontend\components\SelectorComponent;
use frontend\models\FoodModel;
use Yii;
use yii\web\Controller;

/**
 * Food Controller
 */
class FoodController extends Controller
{
    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new FoodModel();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $selector = new SelectorComponent();
            $foods = $selector->select($model);
        }

        return $this->render('index', ['model' => $model, 'foods' => $foods ?? null]);
    }
}
