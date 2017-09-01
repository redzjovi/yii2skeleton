<?php

use common\models\WpCategories;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="wp-term-taxonomy-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

    <?= $model->isNewRecord ? '' : $form->field($model, 'slug')->textInput(['readonly' => 'readonly']); ?>

    <?= $form->field($model, 'taxonomy')->hiddenInput(['value' => 'category'])->label(false); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 5]); ?>

    <?= $form->field($model, 'parent')->dropDownList(
        ArrayHelper::map($model->getCategoriesTreeOptions(), 'id', 'tree_name'),
        ['prompt' => Yii::t('app', 'None')]
    ); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
