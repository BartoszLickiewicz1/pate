<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Offers $model */

$this->title = 'Update Offer: ' . $model->number;
$this->params['breadcrumbs'][] = ['label' => 'Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->number, 'url' => ['view', 'number' => $model->number]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="offers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
