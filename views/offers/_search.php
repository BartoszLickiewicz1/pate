<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\OffersSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="offers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'data') ?>

    <?= $form->field($model, 'invoice') ?>

    <?= $form->field($model, 'about') ?>

    <?= $form->field($model, 'file_path') ?>

    <?php // echo $form->field($model, 'montage_text') ?>

    <?php // echo $form->field($model, 'montage_price') ?>

    <?php // echo $form->field($model, 'additional_price_text') ?>

    <?php // echo $form->field($model, 'additional_price') ?>

    <?php // echo $form->field($model, 'disposal_text') ?>

    <?php // echo $form->field($model, 'disposal_price') ?>

    <?php // echo $form->field($model, 'vat') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'text_top') ?>

    <?php // echo $form->field($model, 'text_bottom_1') ?>

    <?php // echo $form->field($model, 'text_bottom_2') ?>

    <?php // echo $form->field($model, 'text_bottom_3') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
