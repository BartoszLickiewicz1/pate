<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Products $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Offers', 'url' => ['offers/index']];
$this->params['breadcrumbs'][] = ['label' => $model->offer_number, 'url' => ['offers/view', 'number' => $offer_number]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'glass',
            'mullion',
            'color',
            'depth',
            'height',
            'width',
            'quantity',
            'name',
            'options',
            'description',
            'price_netto',
            'discount',
            'is_template',
            [
                'attribute'=>'photo',
                'format'=>'raw',
                'value' => function ($model) {
                    return '<img src="data:image/jpeg;base64,'.base64_encode($model->photo).'" height="100" width="100"/>';
                }
            ]
        ],
    ]) ?>



</div>
