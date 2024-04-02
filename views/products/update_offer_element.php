<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Products $model */

$this->title = 'Update Product: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Offers', 'url' => ['offers/index']];
$this->params['breadcrumbs'][] = ['label' => $model->offer_number, 'url' => ['offers/view', 'number' => $offer_number]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
