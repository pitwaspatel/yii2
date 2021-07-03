<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "media".
 *
 * @property int $id
 * @property string $name
 * @property int|null $type
 * @property string $language
 * @property string|null $circulation
 * @property string|null $mediacol
 * @property float|null $rank
 * @property string|null $logo
 * @property int $apps_countries_id
 * @property string|null $frequency
 * @property string|null $subject
 * @property int $geo
 * @property string|null $zone
 * @property string|null $format
 * @property string|null $section
 * @property string|null $genre
 *
 * @property Articles[] $articles
 * @property AppsCountries $appsCountries
 */
class Media extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'media';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'language', 'apps_countries_id'], 'required'],
            [['type', 'apps_countries_id', 'geo'], 'integer'],
            [['rank'], 'number'],
            [['name', 'language', 'circulation', 'mediacol'], 'string', 'max' => 45],
            [['logo'], 'string', 'max' => 255],
            [['frequency'], 'string', 'max' => 20],
            [['subject', 'zone', 'format', 'section'], 'string', 'max' => 100],
            [['genre'], 'string', 'max' => 75],
            [['apps_countries_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppsCountries::className(), 'targetAttribute' => ['apps_countries_id' => 'id']],
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
            'type' => 'Type',
            'language' => 'Language',
            'circulation' => 'Circulation',
            'mediacol' => 'Mediacol',
            'rank' => 'Rank',
            'logo' => 'Logo',
            'apps_countries_id' => 'Apps Countries ID',
            'frequency' => 'Frequency',
            'subject' => 'Subject',
            'geo' => 'Geo',
            'zone' => 'Zone',
            'format' => 'Format',
            'section' => 'Section',
            'genre' => 'Genre',
        ];
    }

    /**
     * Gets query for [[Articles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Articles::className(), ['media_id' => 'id']);
    }

    /**
     * Gets query for [[AppsCountries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppsCountries()
    {
        return $this->hasOne(AppsCountries::className(), ['id' => 'apps_countries_id']);
    }
}
