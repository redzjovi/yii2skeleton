<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_item_name')->textInput(['maxlength' => true]) ?>

    <?php if ($model->isNewRecord) {
        $model->parent_id = $menu->id;
    } ?>
    <?= $form->field($model, 'parent_id')->hiddenInput()->label(false); ?>

    <?php // $form->field($model, 'lft')->textInput() ?>

    <?php // $form->field($model, 'rgt')->textInput() ?>

    <?php // $form->field($model, 'depth')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
