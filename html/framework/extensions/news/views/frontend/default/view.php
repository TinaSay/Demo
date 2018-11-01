<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model tina\news\models\News */
/** @var $configs \krok\configure\ConfigurableInterface */

$this->title = $model->title;
?>
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <?php if ($model->getSrc()): ?>
                <?= Html::img($model->getPreview()) ?>
            <?php endif ?>
            <div class="h2">
                <?= $model->title ?>
            </div>
            <div>
                <?= Yii::$app->formatter->asDate($model->date); ?>
            </div>
            <div>
                <?= $model->announce ?>
            </div>
            <div>
                <?= $model->text ?>
            </div>
        </div>
    </div>
</div>
