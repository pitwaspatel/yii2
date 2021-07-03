<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ad_codes".
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $brand_id
 * @property string $ad_code
 */
class AdCodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ad_codes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'brand_id'], 'integer'],
            [['ad_code'], 'required'],
            [['ad_code'], 'string', 'max' => 255],
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
            'brand_id' => 'Brand ID',
            'ad_code' => 'Ad Code',
        ];
    }
}
