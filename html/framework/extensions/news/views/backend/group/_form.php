<?php

use tina\news\models\Group;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model tina\news\models\Group */
?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'hidden')->dropDownList(Group::getHiddenList()) ?>
