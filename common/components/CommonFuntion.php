<?php

namespace common\components;
 use Yii;

class CommonFuntion {
public static function getBrandList(){
    return $query = (new \yii\db\Query())
        ->select(['id','name'])
        ->from('brands')
        ->orderBy('name')->all();
}
    public static function getCategoryList(){
        return $query = (new \yii\db\Query())
            ->select(['category_id','name'])
            ->from('category')
            ->orderBy('name')->all();
    }
    public static function getSubCategoryList(){
        return $query = (new \yii\db\Query())
            ->select(['id','name'])
            ->from('sub_category')
            ->orderBy('name')->all();
    }

    public static function getArticleList(){
        return $query = (new \yii\db\Query())
            ->select(['id','title'])
            ->from('articles')
            ->orderBy('title')->all();
    }
    public static function getMediaList(){
        return $query = (new \yii\db\Query())
            ->select(['id','name'])
            ->from('media')
            ->orderBy('name')->all();
    }
    public static function getCountryList(){
        return $query = (new \yii\db\Query())
            ->select(['id','country_name'])
            ->from('apps_countries')
            ->orderBy('country_name')->all();
    }
    public static function getLanguagesList(){
        return $query = (new \yii\db\Query())
            ->select(['id','name'])
            ->from('languages')
            ->orderBy('name')->all();
    }
}
