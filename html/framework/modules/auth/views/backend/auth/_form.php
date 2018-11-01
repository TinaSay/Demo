<?php

use krok\passwordEye\PasswordEyeWidget;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\modules\auth\models\Auth */
/* @var $roles [] */
?>

<?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'password')->widget(
    PasswordEyeWidget::class
) ?>

<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'blocked')->dropDownList($model::getBlockedList()) ?>

<?= $form->field($model, 'roles')->dropDownList($roles, [
    'multiple' => true,
    'data-live-search' => 'true',
    'data-actions-box' => 'true',
]) ?>
