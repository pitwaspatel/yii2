<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sub_category".
 *
 * @property int $id
 * @property string $name
 * @property int $category_category_id
 *
 * @property Articles[] $articles
 */
class SubCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'category_category_id'], 'required'],
            [['name','targetAttribute' => 'category_category_id'], 'unique'],
            [['name'], 'filter', 'filter'=>'trim'],
            [['category_category_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'category_category_id' => 'Category Category ID',
        ];
    }

    /**
     * Gets query for [[Articles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Articles::className(), ['sub_category_id' => 'id']);
    }
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_category_id']);
    }
}
