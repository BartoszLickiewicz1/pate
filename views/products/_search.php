<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ProductsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'glass') ?>

    <?= $form->field($model, 'mullion') ?>

    <?= $form->field($model, 'color') ?>

    <?= $form->field($model, 'depth') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'width') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'photo_path') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'options') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'price_netto') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'is_template') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
