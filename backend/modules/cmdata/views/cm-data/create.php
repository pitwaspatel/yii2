<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CmData */

$this->title = 'Create Cm Data';
$this->params['breadcrumbs'][] = ['label' => 'Cm Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cm-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'CmDataReportModel' => $CmDataReportModel,
        'articleModel' => $articleModel,

    ]) ?>

</div>
