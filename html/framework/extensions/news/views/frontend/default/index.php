<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $list \tina\news\models\News[] */
/** @var $configs \krok\configure\ConfigurableInterface */

$this->title = 'Новости';

?>
<?php if ($list): ?>
    <div class="content">
        <div class="row">
            <?php foreach ($list as $model): ?>
                <div class="col-xs-12 col-md-6">
                    <?php if ($model->getSrc()): ?>
                        <?= Html::img($model->getPreview()) ?>
                    <?php endif ?>
                    <a href="<?= Url::to(['view', 'id' => $model->id]) ?>">
                        <div class="h2"><?= $model->title ?></div>
                    </a>
                    <div>
                        <?= Yii::$app->formatter->asDate($model->date); ?>
                    </div>
                    <div>
                        <?= $model->announce ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <h1>Нет новостей</h1>
<?php endif; ?>
