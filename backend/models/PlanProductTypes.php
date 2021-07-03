<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "plan_product_types".
 *
 * @property int $id
 * @property string|null $plan_type
 * @property string|null $service_type
 * @property string|null $product
 * @property string|null $product_type
 * @property string|null $monthly
 * @property string|null $annually
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class PlanProductTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan_product_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['plan_type', 'service_type', 'product', 'product_type', 'monthly', 'annually'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plan_type' => 'Plan Type',
            'service_type' => 'Service Type',
            'product' => 'Product',
            'product_type' => 'Product Type',
            'monthly' => 'Monthly',
            'annually' => 'Annually',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
