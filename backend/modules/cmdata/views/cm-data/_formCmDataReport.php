<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $CmDataReportModel backend\CmDataReportModels\CmDataReport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cm-data-report-form">

    <?= $form->field($CmDataReportModel, 'language', [
    ])->widget(Select2::classname(), [
        'theme' => Select2::THEME_DEFAULT,
        'value' => $CmDataReportModel->language,
        'options' => ['multiple' => false, 'placeholder' => 'Search for a Language ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => yii\helpers\Url::to(['/cmdata/cm-data-report/get-language-list']),
                'dataType' => 'json',
                'results' => new yii\web\JsExpression('function(data) { return data }')
            ],

        ]
    ]) ?>
    <?= $form->field($CmDataReportModel, 'apps_countries_id', [
    ])->widget(Select2::classname(), [
        'theme' => Select2::THEME_DEFAULT,
//        'data' => $itemData,
        'options' => ['multiple' => false, 'placeholder' => 'Search for a Country ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => yii\helpers\Url::to(['/cmdata/cm-data-report/get-country-list']),
                'dataType' => 'json',
                'results' => new yii\web\JsExpression('function(data) { return data }')
            ],
            'escapeMarkup' => new yii\web\JsExpression('function (markup) { return markup; }'),
            'templateResult' => new yii\web\JsExpression('function(product) { return product.text; }'),
            'templateSelection' => new yii\web\JsExpression('function (product) { return product.text; }'),
        ]
    ]) ?>
<!--    --><?php //$form->field($CmDataReportModel, 'media_id', [
//    ])->widget(Select2::classname(), [
//        'theme' => Select2::THEME_DEFAULT,
////        'data' => $itemData,
//        'options' => ['multiple' => false, 'placeholder' => 'Search for a Media ...'],
//        'pluginOptions' => [
//            'allowClear' => true,
//            'minimumInputLength' => 3,
//            'language' => [
//                'errorLoading' => new yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
//            ],
//            'ajax' => [
//                'url' => yii\helpers\Url::to(['get-media-list']),
//                'dataType' => 'json',
//                'results' => new yii\web\JsExpression('function(data) { return data }')
//            ],
//            'escapeMarkup' => new yii\web\JsExpression('function (markup) { return markup; }'),
//            'templateResult' => new yii\web\JsExpression('function(product) { return product.text; }'),
//            'templateSelection' => new yii\web\JsExpression('function (product) { return product.text; }'),
//        ]
//    ]) ?>
   <?= $form->field($CmDataReportModel, 'match_date')->textInput() ?>

    <?= $form->field($CmDataReportModel, 'match_time')->textInput() ?>

    <?= $form->field($CmDataReportModel, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($CmDataReportModel, 'cm_duration')->textInput(['maxlength' => true]) ?>

    <?= $form->field($CmDataReportModel, 'ber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($CmDataReportModel, 'match_percantage')->textInput(['maxlength' => true]) ?>


</div>
