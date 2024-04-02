<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Offers $model */

$this->title = 'Create Offers';
$this->params['breadcrumbs'][] = ['label' => 'Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
Use Offer Template
</button>
<!-- Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Select Offer Template</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="list-group">
      <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
                'template'=>'{use}',
                'buttons' =>[
                   'use'=> function ($url, $model, $key) {
                    return '<a class="btn btn-primary" href="'.yii\helpers\Url::toRoute(['offers/create','offer_template_number'=>$model->number]).'" role="button">Use</a>';
                 }
                ]
            ],
        ],
    ]); ?>
        </div>
      </div>
    </div>
  </div>
</div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
