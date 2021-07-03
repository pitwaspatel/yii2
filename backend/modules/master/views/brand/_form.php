<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\models\Brands */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brands-form">

    <?php $form = ActiveForm::begin(['id'=>'brand-form','layout'=> 'horizontal']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'country_id', [
    ])->widget(Select2::classname(), [
        'theme' => Select2::THEME_DEFAULT,
        'initValueText' => (!$model->isNewRecord)?\backend\models\AppsCountries::findOne($model->country_id)->country_name:'',
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
<?php //print "<pre>"; print_r($model);?>
    <?= $form->field($model, 'cat_id', [
    ])->widget(Select2::classname(), [
        'theme' => Select2::THEME_DEFAULT,
//        'data' => [$model->cat_id],
        'initValueText' => (!$model->isNewRecord)?\backend\models\Category::findOne($model->cat_id)->name:'',
        'options' => ['multiple' => false, 'placeholder' => 'Search Category ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => yii\helpers\Url::to(['/cmdata/cm-data/get-category-list']),
                'dataType' => 'json',
                'results' => new yii\web\JsExpression('function(data) { return data }')
            ],
            'escapeMarkup' => new yii\web\JsExpression('function (markup) { return markup; }'),
            'templateResult' => new yii\web\JsExpression('function(product) { return product.text; }'),
            'templateSelection' => new yii\web\JsExpression('function (product) { return product.text; }'),
        ],

    ]); ?>
    <?= $form->field($model, 'sub_cat_id', [
    ])->widget(Select2::classname(), [
        'theme' => Select2::THEME_DEFAULT,
        'initValueText' => (!$model->isNewRecord)?\backend\models\SubCategory::findOne($model->sub_cat_id)->name:'',
        'options' => ['multiple' => false, 'placeholder' => 'Search for a item ...'],
        'pluginOptions' => [
            'depends' => 'brands-cat_id',
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => yii\helpers\Url::to(['/cmdata/cm-data/get-sub-category-list']),
                'dataType' => 'json',
                'data' => new yii\web\JsExpression('function(params) { 
                                                            var category_id = $("#brands-cat_id").val();
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


    <?= $form->field($model, 'logo')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
