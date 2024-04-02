<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Offers $model */

$this->title = $model->number;
$this->params['breadcrumbs'][] = ['label' => 'Offers Templates', 'url' => ['templates']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="offers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'number' => $model->number], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'number' => $model->number], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'number',
            'data',
            'invoice',
            'about',
            'pdf',
            'montage_text',
            'montage_price',
            'additional_price_text',
            'additional_price',
            'disposal_text',
            'disposal_price',
            'vat',
            'discount',
            'text_top',
            'text_bottom_1',
            'text_bottom_2',
            'text_bottom_3',
        ],
    ]) ?>
</div>
