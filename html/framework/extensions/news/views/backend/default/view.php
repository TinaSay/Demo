<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model tina\news\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('system', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="card-header">
        <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
    </div>

    <div class="card-header">
        <p>
            <?= Html::a(Yii::t('system', 'Update'), ['update', 'id' => $model->id], [
                'class' => 'btn btn-primary',
            ]) ?>
            <?= Html::a(Yii::t('system', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('system', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>

    <div class="card-content">
        <?= DetailView::widget([
            'options' => ['class' => 'table'],
            'model' => $model,
            'attributes' => [
                'id',
                'title',
                'date:datetime',
                'announce:html',
                'text:html',
                'hidden:boolean',
                'createdAt:datetime',
                'updatedAt:datetime',
                [
                    'attribute' => 'Изображение',
                    'value' => $model->getSrc() ? Html::img($model->getPreview()) : '',
                    'format' => 'raw',
                ],
            ],
        ]) ?>

    </div>
</div>
