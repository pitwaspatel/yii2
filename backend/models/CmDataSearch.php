<?php

namespace backend\models;

use backend\models\CmData;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CmDataSearch represents the model behind the search form of 'backend\models\CmData'.
 */
class CmDataSearch extends CmData
{
    /**
     * {@inheritdoc}
     */
    public $country;
    public $media_id;
    public $media_type;
    public $match_date;
    public $match_time;
    public $cm_duration;
    public $match_start;
    public $match_end;
    public $ber;
    public $match_percantage;
    public $sample_ID;
    public $language;
    public $product_name;
    public $product;
    public $start;
    public $end;
    public $tags;
    public $articleSummary;
    public $articlesForm;
    public $articleCode;
    public $articleStatus;



    public function rules()
    {
        return [
            [['id', 'category_id', 'sub_cat_id', 'file_id', 'article_id', 'country', 'media_id','media_type','language'], 'integer'],
            [['product', 'brand_id', 'ad_form', 'tags', 'ad_code', 'slogan', 'sample_ID', 'sample_status', 'cm_code', 'report_id_number', 'match_date', 'match_time','start','end','articleSummary','articlesForm','articleCode','articleStatus'], 'safe'],
            [['match_start', 'match_end', 'cm_duration', 'ber', 'match_percantage'], 'string'],
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
        $query = CmData::find()
            ->select(['cm_data_report.id id','products.name product_name','cm_data_report.language', 'cm_data_report.type media_type', 'brand_id', 'category.category_id', 'sub_category.id sub_cat_id',
                'cm_data.ad_form','articles.ad_form articlesForm','code articleCode', 'tag', 'ad_code', 'cm_data.slogan', 'cm_code', 'article_id','product_name',
                'cm_data_report.sample_ID','booked articleStatus', 'summary articleSummary', 'country', 'cm_data_report.media_id','tags',
                'cm_data_report.match_date', 'cm_data_report.match_time', 'cm_data_report.name', 'match_start', 'match_end', 'cm_duration',
                'ber', 'match_percantage'])
            ->joinWith('brand')
            ->joinWith('category')
            ->joinWith('subCategory')
            ->joinWith("article")
            ->innerJoin("media", 'media.id=articles.media_id')
            ->innerJoin("cm_data_report", "cm_data_report.media_id=media.id")
            ->innerJoin("products", "products.id=articles.product_name");
//        ->groupBy('');

        // add conditions that should always apply here
//echo $query->createCommand()->getRawSql();die;
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
            'category.category_id' => $this->category_id,
            'cm_data.sub_cat_id' => $this->sub_cat_id,
            'file_id' => $this->file_id,
            'article_id' => $this->article_id,
            'cm_data_report.type' => $this->media_type,
            'country' => $this->country,
            'cm_data_report.type' => $this->media_type,
            'cm_data_report.media_id' => $this->media_id,
            'product_name' => $this->product_name,
            'articleStatus' => $this->articleStatus,
            'cm_data_report.language' => $this->language,
        ]);

        $query->andFilterWhere(['like', 'product', $this->product])
            ->andFilterWhere(['like', 'brand_id', $this->brand_id])
            ->andFilterWhere(['like', 'cm_data.ad_form', $this->ad_form])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'articleCode', $this->articleCode])
            ->andFilterWhere(['like', 'ad_code', $this->ad_code])
            ->andFilterWhere(['like', 'slogan', $this->slogan])
            ->andFilterWhere(['between', 'match_date', $this->start,$this->end])
            ->andFilterWhere(['like', 'cm_data_report.sample_ID', $this->sample_ID])
            ->andFilterWhere(['like', 'sample_status', $this->sample_status])
            ->andFilterWhere(['like', 'summary', $this->articleSummary])
            ->andFilterWhere(['like', 'articles.ad_form ', $this->articlesForm])
            ->andFilterWhere(['like', 'cm_code', $this->cm_code])
            ->andFilterWhere(['like', 'report_id_number', $this->report_id_number]);
//            echo $query->createCommand()->getRawSql();
        return $dataProvider;
    }
}
