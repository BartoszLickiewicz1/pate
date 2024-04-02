<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Offers $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="offers-form">

    <?php $form = ActiveForm::begin(
        [
           'errorCssClass'=> 'is-invalid',
           'successCssClass'=> 'is-valid',
           'validationStateOn'=> ActiveForm::VALIDATION_STATE_ON_INPUT,
           'fieldConfig' =>[
            'errorOptions' => ['class' => 'invalid-feedback'],
           ]
        ]
    ); ?>
    <div class="container">

    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::classname(), [
    //'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
    'options'=>[
      'class'=>'form-control',
      'readonly' => true,
    ]
]) ?>

    <?= $form->field($model, 'invoice')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'about')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'montage_text')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'montage_price')->textInput() ?>

    <?= $form->field($model, 'additional_price_text')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'additional_price')->textInput() ?>

    <?= $form->field($model, 'disposal_text')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'disposal_price')->textInput() ?>

    <?= $form->field($model, 'travel_time_price')->textInput() ?>

    <?= $form->field($model, 'vat')->textInput() ?>

    <?= $form->field($model, 'discount')->textInput() ?>

    <?= $form->field($model, 'text_top')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'text_bottom_1')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'text_bottom_2')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'text_bottom_3')->textarea(['rows' => 4]) ?>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>