<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "client_enduser_subscription_view".
 *
 * @property int $id
 * @property string|null $service_type
 * @property string|null $enduser_id
 * @property string|null $country_id
 * @property int|null $category_id
 * @property string $category_name
 * @property int|null $subcategory_id
 * @property string $subcategory_name
 * @property int|null $brand_id
 * @property string $brand_name
 * @property string|null $brand_logo
 * @property string|null $tag
 * @property int|null $competitor_id
 * @property string $competitor_name
 * @property int $status
 * @property string $start_dt
 * @property string|null $end_dt
 */
class ClientEnduserSubscriptionView extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client_enduser_subscription_view';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'subcategory_id', 'brand_id', 'competitor_id', 'status'], 'integer'],
            [['category_name', 'subcategory_name', 'brand_name', 'competitor_name', 'status'], 'required'],
            [['start_dt', 'end_dt'], 'safe'],
            [['service_type', 'enduser_id', 'subcategory_name', 'brand_logo', 'tag'], 'string', 'max' => 255],
            [['country_id'], 'string', 'max' => 250],
            [['category_name'], 'string', 'max' => 200],
            [['brand_name', 'competitor_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
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
            'competitor_id' => 'Competitor ID',
            'competitor_name' => 'Competitor Name',
            'status' => 'Status',
            'start_dt' => 'Start Dt',
            'end_dt' => 'End Dt',
        ];
    }
}
