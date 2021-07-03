<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AppsCountriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Apps Countries row';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apps-countries-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-md-3">
<?=$this->render("_form",['model'=>$model]);?>
</div>
<div class="col-md-9">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'country_code',
            'country_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
</div>
