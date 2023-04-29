<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'apiresult';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'date',
        'hours',
        'start',
        'numberOfLines',
        'result',
    ],
]); ?>

