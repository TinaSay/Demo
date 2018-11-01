<?php

use app\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->getHomeUrl(),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/content/default/index', 'alias' => 'index']],
            ['label' => 'About', 'url' => ['/content/default/index', 'alias' => 'about']],
            ['label' => 'Sitemap', 'url' => ['/sitemap/default/index']],
            ['label' => 'News', 'url' => ['/news/default/index']],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $this->render('//parts/search') ?>
        <?= $this->render('//parts/menu') ?>
        <?= $content ?>
    </div>
</div>

<div class="container">
    <h4>Подпишитесь на нашу рассылку</h4>
    <?= tina\subscriber\widgets\SubscriberWidget::widget(); ?>
</div>
<footer class="footer">

    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name ?> <?= (new DateTime())->format('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
