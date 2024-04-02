<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Offers;

/**
 * OffersSearch represents the model behind the search form of `app\models\Offers`.
 */
class OffersSearch extends Offers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number','is_template'], 'integer'],
            [['date', 'invoice', 'about', 'montage_text', 'additional_price_text', 'disposal_text', 'text_top', 'text_bottom_1', 'text_bottom_2', 'text_bottom_3'], 'safe'],
            [['montage_price', 'additional_price', 'disposal_price', 'vat', 'discount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $templateOnly = null)
    {
        $query = Offers::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'number' => $this->number,
            'date' => $this->date,
            'montage_price' => $this->montage_price,
            'additional_price' => $this->additional_price,
            'disposal_price' => $this->disposal_price,
            'vat' => $this->vat,
            'discount' => $this->discount,
            'is_template' => $templateOnly ? 1 : 0,
        ]);

        $query->andFilterWhere(['like', 'invoice', $this->invoice])
            ->andFilterWhere(['like', 'about', $this->about])
            ->andFilterWhere(['like', 'montage_text', $this->montage_text])
            ->andFilterWhere(['like', 'additional_price_text', $this->additional_price_text])
            ->andFilterWhere(['like', 'disposal_text', $this->disposal_text])
            ->andFilterWhere(['like', 'text_top', $this->text_top])
            ->andFilterWhere(['like', 'text_bottom_1', $this->text_bottom_1])
            ->andFilterWhere(['like', 'text_bottom_2', $this->text_bottom_2])
            ->andFilterWhere(['like', 'text_bottom_3', $this->text_bottom_3]);

        return $dataProvider;
    }
}
