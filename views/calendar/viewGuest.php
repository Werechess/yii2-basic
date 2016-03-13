<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Calendar */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calendars'), 'url' => ['calendar/friendcalendars/'.$model->creator]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calendar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'text:ntext',
            [
                'attribute' => 'creator',
                'format' => 'raw',
                'value' => Html::a(
                    $model->user->name . " " . $model->user->surname,
                    ['/calendar/friendcalendars/'.$model->user->id]
                )
            ],
            'date_create',
        ],
    ]) ?>

</div>
