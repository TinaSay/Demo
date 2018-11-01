<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $dto \krok\content\dto\frontend\ContentDto */

$this->title = $dto->getTitle();
$this->params['breadcrumbs'][] = $this->title;

$this->registerMetaTag(['name' => 'keywords', 'content' => $dto->getKeywords()]);
$this->registerMetaTag(['name' => 'description', 'content' => $dto->getDescription()]);
?>
<div class="site-about">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <p>
        <?= $dto->getText() ?>
    </p>

</div>
