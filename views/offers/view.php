<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Offers $model */

$this->title = $model->number;
$this->params['breadcrumbs'][] = ['label' => 'Offers', 'url' => ['index']];
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
            'file_path',
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
<h2>Offer Elements</h2>

    <p>
        <?= Html::a('Add Product', ['products/create-offer-element','offer_number' => $model->number], ['class' => 'btn btn-success']) ?>
    </p>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'glass',
            'mullion',
            'color',
            [
                'attribute'=>'photo',
                'format'=>'raw',
                'value' => function ($model) {
                    return '<img src="data:image/jpeg;base64,'.base64_encode($model->photo).'" height="200" width="200"/> ';
              
                }
            ],
            //'height',
            //'width',
            //'quantity',
            //'photo_path',
            //'name',
            //'options',
            //'description',
            //'price_netto',
            //'discount',
            //'is_template',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\Products $model, $key, $index, $column) {
                    return yii\helpers\Url::toRoute(['products/'.$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

</div>
