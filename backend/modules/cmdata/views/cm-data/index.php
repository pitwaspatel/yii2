<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CmDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cm Filters';
$this->params['breadcrumbs'][] = $this->title;

//print "<pre>";
//print_r($dataProvider->models);
?>
    <div class="cm-data-index">

        <h1><?= Html::encode($this->title) ?></h1>
        <div class="row">
            <?= $this->render("_search", ['searchModel' => $searchModel]) ?>
        </div>
        <div class="row">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY
                ],
//            'pjax' => true,
                'bordered' => true,
                'striped' => false,
                'condensed' => false,
                'responsive' => true,
                'hover' => true,
                'floatHeader' => true,
//                'showPageSummary' => true,
                'toolbar' => [
                    ['content' =>
                        Html::button("<i class='glyphicon glyphicon-trash' title='With Seleted Delete All'></i> Delete All", ['type' => 'button', 'class' => 'btn btn-danger deleteRows ', 'disabled' => 'disabled']),
                    ],
                    '{export}',
                    '{toggleData}'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'multiple' => true,
                        'checkboxOptions' => function ($model) {
//            print_r($model);
                            return ['class' => 'check', "id" => "check$model[id]", "value" => $model['id']];
                        },
                    ],
                    [
                        'header' => "Delete",
                        'format' => 'raw',
                        'headerOptions' => ['class' => "skip-export text-center", 'width' => 100],
                        'contentOptions' => ['class' => "skip-export text-center", 'width' => 100],
                        'value' => function ($model) {
                            $list = [];
                            $list[] = Html::a('<i class="glyphicon glyphicon-trash" title="Delete"></i>', ['delete', 'id' => $model->id], ['data-confirm' => "Are You Sure to Delete this Record.?", 'data-method' => "POST"]);
                            return implode('', $list);
                        }],
                    ['attribute' => 'product_name',
                        'value' => function ($model) {
                            return isset($model->article->product->name)?$model->article->product->name:'';
                        }],
                    ['attribute' => 'brand',
                        'value' => function ($model) {


                            return isset($model->brand->name) ? $model->brand->name : '';
                        }],
                    ['attribute' => 'media_id',
                        'value' => function ($model) {
//      print "<pre>";  print_r($model);
                            return isset($model->article->media->name) ? $model->article->media->name : '';
                        }], 'match_date', 'match_time', 'cm_duration', 'match_percantage',

                    ['attribute' => 'sample_ID',

                        'hiddenFromExport' => true,

                        'value' => function ($model) {
                            return isset($model->sample_ID) ? $model->sample_ID : '';

                        }
                    ],
//            ['attribute' => 'sub_cat_id',
//                'value' => function ($model) {
//                    return isset($model->subCategory->name)?$model->subCategory->name:'';
//                }
//            ],
//            'ad_form',
//            'tag:ntext',
////            'ad_code',
//            'slogan',
                    //'file_id',
                    //'sample_ID',
                    //'sample_status',
                    //'cm_code',
                    //'article_id',
                    //'report_id_number',

//            ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

            <?php Pjax::end(); ?>

        </div>
    </div>
<?php
$url = \yii\helpers\Url::to(['delete-all']);
$script = <<< JS
  
var mainArr = [];
$('body').on('change', '.check', function() {
          $('.deleteRows').removeAttr('disabled');
    if ($(this).prop('checked')) {
        var checkbox = $(this).closest('tr').find('.check');
        var ids = checkbox.val();
        mainArr[ids] = checkbox.val();
    } else {      
        var checkbox = $(this).closest('tr').find('.check');
        var ids = checkbox.val();
        if (mainArr[ids]) {
            delete mainArr[ids];
        }  
        if(Object.keys(mainArr).length == 0){
            $('.deleteRows').attr('disabled','disabled');         
         }
        else{
            $('.deleteRows').removeAttr('disabled');         
         }
        
    }
        
});

$("body").on('pjax:end', function() {
    console.log(mainArr);
        $.each(Object.keys(mainArr), function (key, val) {
        $("#check"+val).attr('checked',true);
        if(Object.keys(mainArr).length == 0){
            $('.deleteRows').attr('disabled','disabled');         
         }
        else{
            $('.deleteRows').removeAttr('disabled');         
         }
        });
   
});

$('body').on("click",'.deleteRows',function(){
    var msg = window.confirm("Are You Sure Want To Delete Rows?");
    if(msg){
        $.post("$url",{ids:mainArr}, function(data){
        });
    }else{
        alert("Cancelled");
    }
   
});
JS;
$this->registerJs($script); ?>