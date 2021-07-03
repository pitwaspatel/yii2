<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "client_enduser_subscription_view_ad_verification".
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $media_type
 * @property string|null $service_type
 * @property string|null $enduser_id
 * @property string|null $country_id
 * @property int $category_id
 * @property string|null $category_name
 * @property int $subcategory_id
 * @property string|null $subcategory_name
 * @property int|null $brand_id
 * @property string $brand_name
 * @property string|null $brand_logo
 * @property string|null $tag
 * @property int $status
 * @property string $start_dt
 * @property string|null $end_dt
 * @property int|null $media_id
 * @property string|null $product
 * @property string|null $product_type
 * @property string|null $plan_type
 * @property string|null $ad_form
 * @property string|null $ad_code
 * @property string|null $slogan
 * @property int|null $file_id
 * @property string|null $sample_ID
 * @property string|null $cm_code
 */
class ClientEnduserSubscriptionViewAdVerification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client_enduser_subscription_view_ad_verification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'media_type', 'category_id', 'subcategory_id', 'brand_id', 'status', 'media_id', 'file_id'], 'integer'],
            [['brand_name', 'status'], 'required'],
            [['start_dt', 'end_dt'], 'safe'],
            [['service_type', 'enduser_id', 'subcategory_name', 'brand_logo', 'tag', 'product', 'product_type', 'plan_type', 'sample_ID'], 'string', 'max' => 255],
            [['country_id', 'slogan'], 'string', 'max' => 250],
            [['category_name'], 'string', 'max' => 200],
            [['brand_name', 'ad_form'], 'string', 'max' => 100],
            [['ad_code', 'cm_code'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'media_type' => 'Media Type',
            'service_type' => 'Service Type',
            'enduser_id' => 'Enduser ID',
            'country_id' => 'Country ID',
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
            'subcategory_id' => 'Subcategory ID',
            'subcategory_name' => 'Subcategory Name',
            'brand_id' => 'Brand ID',
            'brand_name' => 'Brand Name',
            'brand_logo' => 'Brand Logo',
            'tag' => 'Tag',
            'status' => 'Status',
            'start_dt' => 'Start Dt',
            'end_dt' => 'End Dt',
            'media_id' => 'Media ID',
            'product' => 'Product',
            'product_type' => 'Product Type',
            'plan_type' => 'Plan Type',
            'ad_form' => 'Ad Form',
            'ad_code' => 'Ad Code',
            'slogan' => 'Slogan',
            'file_id' => 'File ID',
            'sample_ID' => 'Sample ID',
            'cm_code' => 'Cm Code',
        ];
    }
}
