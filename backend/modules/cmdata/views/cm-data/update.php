<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CmData */

$this->title = 'Update Cm Data: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cm Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cm-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'CmDataReportModel' => $CmDataReportModel,
        'articleModel' => $articleModel,

    ]) ?>

</div>
