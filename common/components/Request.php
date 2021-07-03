<?php
namespace common\components;
use yii;

class Request extends \yii\web\Request {
    public $web;
    public $adminUrl;

    public function getBaseUrl(){
        return str_replace($this->web, "", parent::getBaseUrl()) . $this->adminUrl;
    }

    public function resolvePathInfo(){
        if($this->getUrl() === $this->adminUrl){
            return "";
        }else{
            return parent::resolvePathInfo();
        }
    }
    
    
    public function base_url($arg = null) {
        //return "hello";
        if ($arg == null)
            return Yii::$app->request->baseUrl;
        return Yii::$app->request->baseUrl."/" . $arg;
    }
    
}
?>