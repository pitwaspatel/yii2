<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cm_data_report".
 *
 * @property int $id
 * @property string $sample_ID
 * @property int|null $type
 * @property string|null $language
 * @property int|null $apps_countries_id
 * @property int|null $media_id
 * @property string $match_date
 * @property string $match_time
 * @property string $name
 * @property string|null $match_start
 * @property string|null $match_end
 * @property string $cm_duration
 * @property string $ber
 * @property string $match_percantage
 */
class CmDataReport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $product_name;
    public static function tableName()
    {
        return 'cm_data_report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sample_ID', 'match_date', 'match_time', 'name', 'cm_duration', 'ber', 'match_percantage'], 'required'],
            [['type', 'apps_countries_id', 'media_id'], 'integer'],
            [['match_date', 'match_time'], 'safe'],
            [['sample_ID', 'name', 'match_start', 'match_end', 'cm_duration', 'ber', 'match_percantage'], 'string', 'max' => 255],
            [['language'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sample_ID' => 'Sample ID',
            'type' => 'Type',
            'language' => 'Language',
            'apps_countries_id' => 'Countries',
            'media_id' => 'Media',
            'match_date' => 'Match Date',
            'match_time' => 'Match Time',
            'name' => 'Name',
            'match_start' => 'Match Start',
            'match_end' => 'Match End',
            'cm_duration' => 'Cm Duration',
            'ber' => 'Ber',
            'match_percantage' => 'Match Percantage',
        ];
    }
    public function getMedia()
    {
        return $this->hasOne(Media::className(), ['id' => 'media_id']);
    }
}
