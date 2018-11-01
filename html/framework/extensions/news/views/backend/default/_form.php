<?php

use krok\editor\EditorWidget;
use tina\news\models\Group;
use tina\news\models\News;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model tina\news\models\News */
?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'groupIds')->dropDownList(Group::asDropDown(), [
    'multiple' => true,
]) ?>

<?= $form->field($model, 'date')->widget(DatePicker::class, [
    'options' => [
        'class' => 'form-control',
    ],
    'dateFormat' => 'yyyy-MM-dd',
]) ?>

<?= $form->field($model, 'src')->fileInput(['accept' => 'image/*']) ?>

<?= $form->field($model, 'announce')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'text')->widget(EditorWidget::class) ?>

<?= $form->field($model, 'hidden')->dropDownList(News::getHiddenList()) ?>

<?= $form->field($model, 'createdAt')->widget(DatePicker::class, [
    'options' => [
        'class' => 'form-control',
    ],
    'dateFormat' => 'yyyy-MM-dd',
]) ?>

<?= $form->field($model, 'updatedAt')->widget(DatePicker::class, [
    'options' => [
        'class' => 'form-control',
    ],
    'dateFormat' => 'yyyy-MM-dd',
]) ?>
