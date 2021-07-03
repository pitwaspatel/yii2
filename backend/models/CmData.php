<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cm_data".
 *
 * @property int $id
 * @property string|null $product
 * @property string|null $brand_id
 * @property int|null $category_id
 * @property int|null $sub_cat_id
 * @property string|null $ad_form
 * @property string|null $tag
 * @property string|null $ad_code
 * @property string|null $slogan
 * @property string|null $file_id
 * @property string|null $sample_ID
 * @property string|null $sample_status
 * @property string|null $cm_code
 * @property int $article_id
 * @property string|null $report_id_number
 */
class CmData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $product_name;
    public $match_date;
    public $match_time;
    public $cm_duration;
    public $match_percantage;
    public $media_id;
//    public $brand;
//    public $product;
    public static function tableName()
    {
        return 'cm_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brand_id', 'tag'], 'string'],
            [['category_id', 'sub_cat_id', 'article_id'], 'integer'],
            [['article_id'], 'required'],
            [['product', 'sample_ID', 'report_id_number'], 'string', 'max' => 255],
            [['ad_form'], 'string', 'max' => 100],
            [['ad_code', 'cm_code'], 'string', 'max' => 50],
            [['slogan', 'sample_status','file_id'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product' => 'Product',
            'brand_id' => 'Brand',
            'category_id' => 'Category',
            'sub_cat_id' => 'Sub Category',
            'ad_form' => 'Ad Form',
            'tag' => 'Tag',
            'ad_code' => 'Ad Code',
            'slogan' => 'Slogan',
            'file_id' => 'File',
            'sample_ID' => 'Sample ID',
            'sample_status' => 'Sample Status',
            'cm_code' => 'Cm Code',
            'article_id' => 'Article',
            'report_id_number' => 'Report Id Number',
        ];
    }
    public function getBrand()
    {
        return $this->hasOne(Brands::className(), ['id' => 'brand_id']);
    }
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
    }
    public function getSubCategory()
    {
        return $this->hasOne(SubCategory::className(), ['id' => 'sub_cat_id']);
    }
    public function getArticle()
    {
        return $this->hasOne(Articles::className(), ['id' => 'article_id']);
    }
}
