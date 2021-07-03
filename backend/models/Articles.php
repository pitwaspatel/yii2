<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $country
 * @property int|null $run
 * @property int $sub_category_id
 * @property string|null $type
 * @property string $title
 * @property string|null $language
 * @property int $brand
 * @property string|null $summary
 * @property string $slogan
 * @property string $tags
 * @property string|null $date
 * @property string|null $date_uploaded
 * @property int|null $priority
 * @property float|null $rank
 * @property float|null $price
 * @property string|null $duration
 * @property int|null $size
 * @property int|null $page
 * @property string|null $pages
 * @property int $media_id
 * @property string|null $location
 * @property string|null $url
 * @property string|null $section
 * @property int $category_category_id
 * @property string|null $time
 * @property string|null $version
 * @property string|null $image_spec
 * @property string|null $product_name
 * @property string|null $ad_form
 * @property string|null $typeOfBanner
 * @property int $booked
 * @property string|null $position_page
 * @property string|null $code
 * @property string|null $websize
 * @property int|null $published
 *
 * @property Category $categoryCategory
 * @property Media $media
 * @property Sizes $size0
 * @property SubCategory $subCategory
 * @property Files[] $files
 * @property Translation[] $translations
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'country', 'run', 'sub_category_id', 'brand', 'priority', 'size', 'page', 'media_id', 'category_category_id', 'booked', 'published'], 'integer'],
            [['sub_category_id', 'title', 'brand', 'slogan', 'tags', 'media_id', 'category_category_id'], 'required'],
            [['summary', 'tags'], 'string'],
            [['date', 'date_uploaded', 'duration'], 'safe'],
            [['rank', 'price'], 'number'],
            [['type', 'language', 'section'], 'string', 'max' => 45],
            [['title', 'ad_form', 'typeOfBanner', 'websize'], 'string', 'max' => 100],
            [['slogan'], 'string', 'max' => 250],
            [['pages', 'location', 'url', 'product_name', 'position_page'], 'string', 'max' => 255],
            [['time', 'version', 'image_spec'], 'string', 'max' => 25],
            [['code'], 'string', 'max' => 50],
            [['category_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_category_id' => 'category_id']],
            [['media_id'], 'exist', 'skipOnError' => true, 'targetClass' => Media::className(), 'targetAttribute' => ['media_id' => 'id']],
            [['size'], 'exist', 'skipOnError' => true, 'targetClass' => Sizes::className(), 'targetAttribute' => ['size' => 'id']],
            [['sub_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategory::className(), 'targetAttribute' => ['sub_category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'country' => 'Country',
            'run' => 'Run',
            'sub_category_id' => 'Sub Category ID',
            'type' => 'Type',
            'title' => 'Title',
            'language' => 'Language',
            'brand' => 'Brand',
            'summary' => 'Summary',
            'slogan' => 'Slogan',
            'tags' => 'Tags',
            'date' => 'Date',
            'date_uploaded' => 'Date Uploaded',
            'priority' => 'Priority',
            'rank' => 'Rank',
            'price' => 'Price',
            'duration' => 'Duration',
            'size' => 'Size',
            'page' => 'Page',
            'pages' => 'Pages',
            'media_id' => 'Media ID',
            'location' => 'Location',
            'url' => 'Url',
            'section' => 'Section',
            'category_category_id' => 'Category Category ID',
            'time' => 'Time',
            'version' => 'Version',
            'image_spec' => 'Image Spec',
            'product_name' => 'Product Name',
            'ad_form' => 'Ad Form',
            'typeOfBanner' => 'Type Of Banner',
            'booked' => 'Booked',
            'position_page' => 'Position Page',
            'code' => 'Code',
            'websize' => 'Websize',
            'published' => 'Published',
        ];
    }

    /**
     * Gets query for [[CategoryCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_category_id']);
    }

    public function getCountry()
    {
        return $this->hasOne(AppsCountries::className(), ['country' => 'id']);
    }
    public function getBrand()
    {
        return $this->hasOne(Brands::className(), ['brand' => 'id']);
    }

    /**
     * Gets query for [[Media]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasOne(Media::className(), ['id' => 'media_id']);
    }

    /**
     * Gets query for [[Size0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSize0()
    {
        return $this->hasOne(Sizes::className(), ['id' => 'size']);
    }

    /**
     * Gets query for [[SubCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategory()
    {
        return $this->hasOne(SubCategory::className(), ['id' => 'sub_category_id']);
    }
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_name']);
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['articles_id' => 'id']);
    }

    /**
     * Gets query for [[Translations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(Translation::className(), ['article_id' => 'id']);
    }
}
