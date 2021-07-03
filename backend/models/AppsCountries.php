<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "apps_countries".
 *
 * @property int $id
 * @property string $country_code
 * @property string $country_name
 *
 * @property Media[] $media
 */
class AppsCountries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apps_countries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_code', 'country_name'], 'required'],
            [['country_code'], 'unique'],
            [['country_code'], 'filter', 'filter' => 'trim'],
            [['country_name'], 'filter', 'filter' => 'trim'],
            [['country_name'], 'unique'],
            [['country_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_code' => 'Country Code',
            'country_name' => 'Country Name',
        ];
    }

    /**
     * Gets query for [[Media]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasMany(Media::className(), ['apps_countries_id' => 'id']);
    }
}
