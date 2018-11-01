<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 14.07.18
 * Time: 11:57
 */

use elfuvo\menu\widgets\MenuWidget;

/** @var $this \yii\web\View */
?>
<div class="navbar navbar-right">
    <?= MenuWidget::widget([
        // 'section' => 'top', // if sections is enabled - uncomment this and set section name value
        'view' => '@vendor/yii2-developer/yii2-menu/src/widgets/views/index',
    ]); ?>
</div>
