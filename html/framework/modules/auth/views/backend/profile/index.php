<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 19.07.17
 * Time: 18:36
 */

use krok\passwordEye\PasswordEyeWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $profile app\modules\auth\models\Profile */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Мой профиль';
?>
<div class="card">

    <div class="card-header">
        <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
    </div>

    <div class="card-content">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($profile, 'password')->widget(
            PasswordEyeWidget::class
        ) ?>

        <?= $form->field($profile, 'passwordNew')->widget(
            PasswordEyeWidget::class
        ) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('system', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
