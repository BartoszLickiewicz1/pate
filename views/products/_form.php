<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Products $model */
/** @var yii\widgets\ActiveForm $form */
$paramList = ['Rolladen' => 'Rolladen', 'Türre' => 'Türre', 'Innenfensterbänke' => 'Innenfensterbänke', 'Fenster' => 'Fenster', 'Außenfensterbänke' => 'Außenfensterbänke'];
?>

<div class="products-form">



<?php $form = ActiveForm::begin(
        [
           'errorCssClass'=> 'is-invalid',
           'successCssClass'=> 'is-valid',
           'validationStateOn'=> ActiveForm::VALIDATION_STATE_ON_INPUT,
           'fieldConfig' =>[
            'errorOptions' => ['class' => 'invalid-feedback'],
           ],
           'options' => ['enctype' => 'multipart/form-data']
        ]
    ); ?>


<?= $form->field($model, 'group')->dropDownList($paramList, ['prompt' => '--Wybierz--']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'options')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'glass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mullion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col">
            <?= $form->field($model, 'height')->textInput() ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'width')->textInput() ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'depth')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'quantity')->textInput() ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'price_netto')->textInput() ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'discount')->textInput() ?>
        </div>
    </div>

    <?php if ($model->photo): ?>

<select id="myDropdown" class="form-select" >
  <option value="1">From Template</option>
  <option value="2">Upload New Photo</option>
</select>

<div class='m-3'>
    <div id="x">Initial content</div>
</div>
<?php
$photo_map = $model->photo;
$model->photo = null;
?>
<script>
$(document).ready(function(){
    toogleMyDropdown();
    $('#myDropdown').change(toogleMyDropdown);
});
function toogleMyDropdown(){
        var selectedValue = $($('#myDropdown')).val();
        if(selectedValue === '1') {
            $('#x').html(`
                <img src="data:image/jpeg;base64,<?= base64_encode($photo_map) ?>" height="300" width="300" />
                <input type="hidden" name="template_photo" value="<?= base64_encode($photo_map) ?>">
            ` );
        } else if(selectedValue === '2') {
            $('#x').html(`
            <?= $form->field($model, 'photo')->fileInput() ?>
            ` );
        }
    }
</script>
    <?php else: ?>
        <?= $form->field($model, 'photo')->fileInput() ?>
    <?php endif; ?>

   

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
