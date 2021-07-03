<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AppsCountries */

$this->title = 'Create Apps Countries';
$this->params['breadcrumbs'][] = ['label' => 'Apps Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apps-countries-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
