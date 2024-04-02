<?php

use app\models\Offers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\OffersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Offers Templates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Offer Template', ['create-template'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'number',
            'data',
            'invoice',
            'about',
            'file_path',
            //'montage_text',
            //'montage_price',
            //'additional_price_text',
            //'additional_price',
            //'disposal_text',
            //'disposal_price',
            //'vat',
            //'discount',
            //'text_top',
            //'text_bottom_1',
            //'text_bottom_2',
            //'text_bottom_3',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Offers $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'number' => $model->number]);
                 }
            ],
        ],
    ]); ?>


</div>


