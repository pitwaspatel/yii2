<?php

namespace backend\models;

use kartik\daterange\DateRangeBehavior;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CmDataReport;

/**
 * CmDataReportSearch represents the model behind the search form of 'backend\models\CmDataReport'.
 */
class CmDataReportSearch extends CmDataReport
{
    /**
     * {@inheritdoc}
     */
    public $brand;
    public $product;
    public $tag;
    public $ad_code;
    public $brand_id;
    public $media_type;
    public $start;
    public $end;
    public $country;
    public $category_id;
    public $sub_cat_id;


    public function rules()
    {
        return [
            [['id', 'type', 'apps_countries_id', 'media_id'], 'integer'],
            [['sample_ID', 'language', 'match_date', 'match_time', 'start', 'end', 'name', 'match_start', 'match_end', 'cm_duration', 'ber', 'match_percantage', 'brand', 'product', 'tag', 'ad_code'], 'safe'],
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
    public function search($params)
    {
        $query = CmDataReport::find();//->select(['cm_data_report.id', 'cm_data_report.sample_ID', 'brands.name', 'product_name', 'cm_data_report.media_id', 'match_date', 'match_time', 'cm_duration', 'ber', 'match_percantage'])->joinWith('media')->innerJoin("articles", "articles.media_id=media.id")->innerJoin("cm_data","cm_data.article_id=articles.id")->innerJoin("brands", "brands.id=articles.brand");

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
            'type' => $this->type,
            'apps_countries_id' => $this->apps_countries_id,
            'cm_data_report.media_id' => $this->media_id,
            'match_time' => $this->match_time,
            'brand' => $this->brand,


        ]);
        if ( ! is_null($this->match_date) && strpos($this->match_date, ' - ') !== false ) {
            list($start_date, $end_date) = explode(' - ', $this->match_date);
            $query->andFilterWhere(['between', 'match_date', $start_date, $end_date]);
            $this->match_date = null;
        }


        $query->andFilterWhere(['like', 'sample_ID', $this->sample_ID])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'match_start', $this->match_start])
            ->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['like', 'ad_code', $this->ad_code])
            ->andFilterWhere(['like', 'product', $this->match_start])
            ->andFilterWhere(['like', 'tag', $this->match_start])
            ->andFilterWhere(['like', 'ad_code', $this->match_start])
            ->andFilterWhere(['like', 'product_name', $this->name])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'match_end', $this->match_end])
            ->andFilterWhere(['like', 'cm_duration', $this->cm_duration])
            ->andFilterWhere(['like', 'ber', $this->ber])
            ->andFilterWhere(['like', 'match_percantage', $this->match_percantage]);

echo  $query->createCommand()->getRawSql();
//die;
        return $dataProvider;
    }
}
