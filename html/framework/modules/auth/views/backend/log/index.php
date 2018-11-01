<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\auth\models\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('system', 'Log');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="card-header">
        <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
    </div>

    <div class="card-content">

        <?= GridView::widget([
            'tableOptions' => ['class' => 'table'],
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                [
                    'attribute' => 'authId',
                    'filter' => $searchModel::getAuthList(),
                    'value' => function ($model) {
                        /** @var app\modules\auth\models\Log $model */
                        if ($model->auth) {
                            return Html::a($model->auth->login, ['auth/view', 'id' => $model->auth->id],
                                ['target' => '_blank']);
                        } else {
                            return null;
                        }
                    },
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'status',
                    'filter' => $searchModel::getStatusList(),
                    'value' => function ($model) {
                        /** @var app\modules\auth\models\Log $model */
                        return $model->getStatus();
                    },
                ],
                [
                    'attribute' => 'ip',
                    'value' => function ($model) {
                        /** @var app\modules\auth\models\Log $model */
                        return long2ip($model->ip);
                    },
                ],
                [
                    'class' => \krok\extend\grid\DatePickerColumn::class,
                    'attribute' => 'createdAt',
                ],
            ],
        ]); ?>

    </div>
</div>
