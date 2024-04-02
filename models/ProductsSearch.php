<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Products;

/**
 * ProductsSearch represents the model behind the search form of `app\models\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'quantity', 'is_template'], 'integer'],
            [['glass', 'mullion', 'color', 'photo', 'name', 'options', 'description'], 'safe'],
            [['depth', 'height', 'width', 'price_netto', 'discount'], 'number'],
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
        $query = Products::find();

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
            'id' => $this->id,
            'depth' => $this->depth,
            'height' => $this->height,
            'width' => $this->width,
            'quantity' => $this->quantity,
            'price_netto' => $this->price_netto,
            'discount' => $this->discount,
            'is_template' => $templateOnly ? 1 : 0,
        ]);

        $query->andFilterWhere(['like', 'glass', $this->glass])
            ->andFilterWhere(['like', 'mullion', $this->mullion])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'options', $this->options])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
