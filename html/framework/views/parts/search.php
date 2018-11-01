<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 14.07.18
 * Time: 11:09
 */

use yii\helpers\Html;

/** @var $this \yii\web\View */

?>

<?= Html::beginForm(['/search'], 'get') ?>
<div class="input-group">
    <?= Html::input('text', 'term', '', ['class' => 'form-control']) ?>
    <span class="input-group-btn">
        <button class="btn">
            <i class="glyphicon glyphicon-search"></i>
        </button>
    </span>
</div>
<?= Html::endForm() ?>
