<?php

use backend\models\Dates;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CmDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cm Data Report';
$this->params['breadcrumbs'][] = $this->title;

//print "<pre>";
//print_r($dataProvider->models);
?>
    <div class="cm-data-index">

        <h1><?= Html::encode($this->title) ?></h1>
        <div class="row">
            <?= $this->render("_searchReport", ['searchModel' => $searchModel]) ?>
        </div>
        <div class="row">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php
            $header = [];
            $header2 = [];
            $columns = [];
            if (!empty($searchModel->start) && !empty($searchModel->end)) {
                $dates = Dates::find()->andWhere(['between', 'date', $searchModel->start, $searchModel->end])->asArray()->all();
                $cmDatas = \backend\models\CmDataReport::find()
                    ->select(["id", 'name','match_date', 'sample_ID','media_id'
                    ])
                    ->andWhere(['between', 'match_date', $searchModel->start, $searchModel->end])
                    ->andWhere(['like', 'sample_ID', $searchModel->sample_ID])
//                    ->groupBy(['media_id','match_date'])
//                    ->indexBy('media_id')
                    ->asArray()->all();
//            print "<pre>";   print_r($cmDatas);
//die;
                $spots = [];
                 foreach ($cmDatas as $data) {
//                     print "<pre>";
//                     print_r($data);
                    $spots['id'][$data['name']][$data['match_date']] = $data['id'];
                  }
//                print_r($cmDatas);die;

                 //die;

                $columns[] = [
                    'class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['width' => "40px"],
                ];

                $columns[] = ['label' => "Media",
                    'group'=>true,
                    'value' => function ($model)use($cmDatas)  {
//                    print_r($model);
//                        foreach ($cmDatas as $k=> $data) {
////                            print "<pre>";print_r($data['name']);
                        return $model['name'];
//                    }
                    }
                ];
//                print_r($spots);die;

                //                die;
                foreach ($dates as $date){

                    $columns[] = ['label' => "spots",
                        'group' => true,
                        'value' => function ($model) use ($spots,$dates,$date) {
//                            foreach ($spots as  $data) {
//                                print "<pre>";
//                                print_r($spots);
//                                print_r($data);
//                                return @$data[$model['name']][[$date['date']]];
////
//                            }
                        }
                    ];
                }


                $header[] = [
                    'content' => "",];

                $header[] = [
                    'content' => "",];

                foreach ($dates as $date) {
                    $header[] = ['content' => Yii::$app->formatter->asDate($date['date']),
                    ];

                }
                $header2[] = [
                    'content' => "",];
                $header2[] = [
                    'content' => "",];
                foreach ($dates as $date) {
                    $day = date('D', strtotime($date['date']));
                    $header2[] = ['content' => $day// Yii::$app->formatter->($date['date'], ''),
                    ];
                }
            }
            ?>
            <?= GridView::widget([
                'dataProvider' => new \yii\data\ArrayDataProvider(
                        ['allModels'=>$cmDatas]
                ),
//        'filterModel' => $searchModel,
//                'panel' => [
//                    'type' => GridView::TYPE_PRIMARY
//                ],
//            'pjax' => true,
                'bordered' => true,
                'striped' => false,
                'condensed' => false,
                'responsive' => true,
                'hover' => true,
//                'floatHeader' => true,
//                'showPageSummary' => true,
//                'toolbar' => [
//                    ['content' =>
//                        Html::button("<i class='glyphicon glyphicon-trash' title='With Seleted Delete All'></i> Delete All", ['type' => 'button', 'class' => 'btn btn-danger deleteRows ', 'disabled' => 'disabled']),
//                    ],
//                    '{export}',
//                    '{toggleData}'
//                ],
                'columns' => $columns,
                'beforeHeader' => [
                    [
                        'columns' => $header,
                    ]
                ], 'afterHeader' => [
                    [
                        'columns' => $header2,
                    ]
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