<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\models\SubCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-category-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'category_category_id', [
    ])->widget(Select2::classname(), [
        'theme' => Select2::THEME_DEFAULT,
       'value' => Yii::$app->request->queryParams?[$model->category_category_id]:[],
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
        ],

    ]); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
 
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
