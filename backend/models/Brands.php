<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brands".
 *
 * @property int $id
 * @property string $name
 * @property int $country_id
 * @property int $cat_id
 * @property int $sub_cat_id
 * @property string|null $logo
 * @property int $user_id
 * @property string $created_at
 * @property int $type
 * @property string $url
 *
 * @property Products[] $products
 */
class Brands extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brands';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['name'], 'unique'],
            [['name'], 'filter','filter'=>'trim'],
            [['country_id', 'cat_id', 'sub_cat_id', 'user_id', 'type'], 'integer'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['logo', 'url'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'country_id' => 'Country ID',
            'cat_id' => 'Cat ID',
            'sub_cat_id' => 'Sub Cat ID',
            'logo' => 'Logo',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'type' => 'Type',
            'url' => 'Url',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['brand' => 'id']);
    }
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'cat_id']);
    }
    public function getSubCategory()
    {
        return $this->hasOne(SubCategory::className(), ['id' => 'sub_cat_id']);
    }
    public function getCountry()
    {
        return $this->hasOne(AppsCountries::className(), ['id' => 'country_id']);
    }
}
