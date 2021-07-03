<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CmDataSearch */
/* @var $form yii\widgets\ActiveForm */
    $params = Yii::$app->request->getQueryParams();
//print_r($params);die;
?>

<div class="cm-data-search row">

    <?php $form = ActiveForm::begin([
        'action' => ['report'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="col-md-12">

        <div class="col-md-3">
            <?php $form->field($searchModel, 'brand_id', [
            ])->widget(Select2::classname(), [
                'theme' => Select2::THEME_DEFAULT,
                'initValueText' => !empty($params['CmDataSearch']['brand_id']) ? \backend\models\Brands::findOne($searchModel->brand_id)->name : '',
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
        </div>
        <div class="col-md-3">
            <?php $form->field($searchModel, 'category_id', [
            ])->widget(Select2::classname(), [
                'theme' => Select2::THEME_DEFAULT,
                'initValueText' => !empty($params['CmDataSearch']['category_id']) ? \backend\models\Category::findOne($searchModel->category_id)->name : '',                'options' => ['multiple' => false, 'placeholder' => 'Search Category ...'],
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
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-3">
            <?php $form->field($searchModel, 'sub_cat_id', [
            ])->widget(Select2::classname(), [
                'theme' => Select2::THEME_DEFAULT,
                'initValueText' => !empty($params['CmDataSearch']['sub_cat_id']) ? \backend\models\SubCategory::findOne($searchModel->sub_cat_id)->name : '',                'options' => ['multiple' => false, 'placeholder' => 'Search for a item ...'],
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
                                                            var category_id = $("#cmdatasearch-category_id").val();
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

        </div>
        <div class="col-md-3">
            <?php $form->field($searchModel, 'product', [
            ])->widget(Select2::classname(), [
                'theme' => Select2::THEME_DEFAULT,
                'initValueText' => !empty($params['CmDataSearch']['product']) ? \backend\models\Products::findOne($searchModel->product)->name : '',                'options' => ['multiple' => false, 'placeholder' => 'Search for a Product ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'language' => [
                        'errorLoading' => new yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
                    ],
                    'ajax' => [
                        'url' => yii\helpers\Url::to(['get-product-list']),
                        'dataType' => 'json',
                        'data' => new yii\web\JsExpression('function(params) { 
                                                               return {
                                                                    term: params.term,
                                           
                                                                };
                                                            }'),
                        'results' => new yii\web\JsExpression('function(data) { return data }')
                    ],
                    'escapeMarkup' => new yii\web\JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new yii\web\JsExpression('function(product) { return product.text; }'),
                    'templateSelection' => new yii\web\JsExpression('function (product) { return product.text; }'),
                ]
            ]) ?>

        </div>
        <div class="col-md-3">
            <?php $data =\backend\models\Media::find()->innerJoin('media_type',"media_type.id=media.type")->where(['media_type.id'=>$searchModel->media_type])->one();
//            print_r($data);die;
            ?>
            <?php $form->field($searchModel, 'media_type', [
            ])->widget(Select2::classname(), [
                'theme' => Select2::THEME_DEFAULT,
                'initValueText' => !empty($params['CmDataSearch']['media_type']) ? $data->name : '',//            'value'=>4,
                'options' => ['multiple' => false, 'placeholder' => 'Search for a Product ...'],
                'pluginOptions' => [
                    'allowClear' => true,
//                        'minimumInputLength' => 3,
                    'language' => [
                        'errorLoading' => new yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
                    ],
                    'ajax' => [
                        'url' => yii\helpers\Url::to(['get-media-type-list']),
                        'dataType' => 'json',
                        'data' => new yii\web\JsExpression('function(params) { 
                                                               return {
                                                                    term: params.term,
                                           
                                                                };
                                                            }'),
                        'results' => new yii\web\JsExpression('function(data) { return data }')
                    ],
                    'escapeMarkup' => new yii\web\JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new yii\web\JsExpression('function(product) { return product.text; }'),
                    'templateSelection' => new yii\web\JsExpression('function (product) { return product.text; }'),
                ]
            ]) ?>

        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-3" style="margin-top: 20px;">
            <!--            --><?php //$searchModel->match_date = !empty($params) ? $params['match_date'] : '';
            echo DateRangePicker::widget([
                'model' => $searchModel,
                'attribute' => 'match_date',
                'convertFormat' => true,
                'useWithAddon' => true,
                'presetDropdown' => true,
                'hideInput' => true,
                'startAttribute' => 'start',
                'endAttribute' => 'end',
                'pluginOptions' => [
                    'opens' => 'right',
                    'locale' => [
                        'cancelLable' => 'clear',
                        'format' => 'Y-m-d'
                    ]
                ],
                'options' => ['placeholder' => '  Match Date', 'class' => 'form-control',
                    'autocomplete' => 'off'
                ],

            ]);
            ?>

        </div>

        <div class="col-md-3">

            <?php echo $form->field($searchModel, 'sample_ID') ?>


        </div>

    </div>


    <?php // echo $form->field($searchModel, 'file_id') ?>

    <?php // echo $form->field($searchModel, 'sample_ID') ?>

    <?php // echo $form->field($searchModel, 'sample_status') ?>

    <?php // echo $form->field($searchModel, 'cm_code') ?>

    <?php // echo $form->field($searchModel, 'article_id') ?>

    <?php // echo $form->field($searchModel, 'report_id_number') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', ['report'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
