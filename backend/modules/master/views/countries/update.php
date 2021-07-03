<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AppsCountries */

$this->title = 'Update Apps Countries: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Apps Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="apps-countries-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
