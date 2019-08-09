<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\FoodModel */
/* @var $foods \common\models\Recipe[]|null */

use common\models\Ingredient;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Блюда';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Для подбора блюд выберите интересующие Вас продукты и нажмите кнопку подбора.</p>

    <?php Pjax::begin(['id' => 'form']) ?>
    <div class="row">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'food-form', 'options' => ['data-pjax' => true]]); ?>

            <?= $form->field($model, 'ingredients', ['inline' => true])
                ->checkboxList(Ingredient::find()->orderByName()->asDropDownList())
                ->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton('Подобрать', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php if ($foods !== null): ?><div class="row result">
        <?php if (!empty($foods)): ?>
            <p>Из выбранных Вами продуктов мы можем предложить: </p>
            <ul><?php foreach ($foods as $food): ?>
                <li><?= $food->name ?> (<?= $food->cooking_time ?> мин)</li>
            <?php endforeach; ?></ul>
        <?php else: ?>
            <p>К сожалению из выбранных Вами продуктов нам нечего предложить.</p>
        <?php endif; ?>
    </div><?php endif; ?>
    <?php Pjax::end() ?>
</div>
