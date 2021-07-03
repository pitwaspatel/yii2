<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CmData */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cm Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cm-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'product',
            'brand_id:ntext',
            'category_id',
            'sub_cat_id',
            'ad_form',
            'tag:ntext',
            'ad_code',
            'slogan',
            'file_id',
            'sample_ID',
            'sample_status',
            'cm_code',
            'article_id',
            'report_id_number',
        ],
    ]) ?>

</div>
