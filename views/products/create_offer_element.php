<?php

use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Products $model */

$this->title = 'Create Product Offer Element';
$offer_number = $model->offer_number;
$this->params['breadcrumbs'][] = ['label' => 'Offers', 'url' => ['offers/index']];
$this->params['breadcrumbs'][] = ['label' => $model->offer_number, 'url' => ['offers/view', 'number' => $offer_number]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
Use Product Template
</button>

<!-- Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Select Product Template</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="list-group">
      <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'glass',
            'mullion',
            'color',
            'depth',
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
                'template'=>'{use}',
                'buttons' =>[
                   'use'=> function ($url, $model, $key) use ($offer_number) {
                    return '<a class="btn btn-primary" href="'.yii\helpers\Url::toRoute(['products/create-offer-element', 'offer_number' => $offer_number,'product_template_id'=>$model->id]).'" role="button">Use</a>';
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
