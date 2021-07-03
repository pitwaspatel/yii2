<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\components\CommonFuntion;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\CmData */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="cm-data-form">

    <?php $form = ActiveForm::begin(['id' => 'cm-form',
        'layout' => 'horizontal'
    ]); ?>

<?= $form->field($model, 'product')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'brand_id', [
    ])->widget(Select2::classname(), [
        'theme' => Select2::THEME_DEFAULT,
//        'data' => $itemCategory,
        'options' => ['multiple' => false, 'placeholder' => 'Search Brand ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => yii\helpers\Url::to(['get-brand-list']),
                'dataType' => 'json',
                'results' => new yii\web\JsExpression('function(data) { return data }')
            ],
        ],

    ]); ?>

    <?= $form->field($model, 'category_id', [
    ])->widget(Select2::classname(), [
        'theme' => Select2::THEME_DEFAULT,
//        'data' => $itemCategory,
        'options' => ['multiple' => false, 'placeholder' => 'Search Category ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => yii\helpers\Url::to(['get-category-list']),
                'dataType' => 'json',
                'results' => new yii\web\JsExpression('function(data) { return data }')
            ],
        ],

    ]); ?>
    <?= $form->field($model, 'sub_cat_id', [
    ])->widget(Select2::classname(), [
        'theme' => Select2::THEME_DEFAULT,
//        'data' => $itemData,
        'options' => ['multiple' => false, 'placeholder' => 'Search for a item ...'],
        'pluginOptions' => [
            'depends' => 'cmdata-category_id',
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => yii\helpers\Url::to(['get-sub-category-list']),
                'dataType' => 'json',
                'data' => new yii\web\JsExpression('function(params) { 
                                                            var category_id = $("#cmdata-category_id").val();
                                                              return {
                                                                    term: params.term,
                                                                    category:category_id,
                                           
                                                                };
                                                            }'),
                'results' => new yii\web\JsExpression('function(data) { return data }')
            ],
            'escapeMarkup' => new yii\web\JsExpression('function (markup) { return markup; }'),
            'templateResult' => new yii\web\JsExpression('function(product) { return product.text; }'),
            'templateSelection' => new yii\web\JsExpression('function (product) { return product.text; }'),
        ]
    ]) ?>

    <?= $form->field($model, 'ad_form')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tag')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ad_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slogan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_id')->fileInput() ?>

    <?= $form->field($model, 'sample_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sample_status')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'cm_code')->textInput(['maxlength' => true]) ?>
    <?php // $form->field($model, 'article_id', [
//    ])->widget(Select2::classname(), [
//        'theme' => Select2::THEME_DEFAULT,
////        'data' => $itemCategory,
//        'options' => ['multiple' => false, 'placeholder' => 'Search Article ...'],
//        'pluginOptions' => [
//            'allowClear' => true,
//            'minimumInputLength' => 3,
//            'language' => [
//                'errorLoading' => new yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
//            ],
//            'ajax' => [
//                'url' => yii\helpers\Url::to(['get-article-list']),
//                'dataType' => 'json',
//                'results' => new yii\web\JsExpression('function(data) { return data }')
//            ],
//        ],
//
//    ]); ?>

    <?= $form->field($articleModel, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'report_id_number')->textInput(['maxlength' => true]) ?>
    <?= $this->render("_formCmDataReport", ['CmDataReportModel' => $CmDataReportModel,'form'=>$form]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
