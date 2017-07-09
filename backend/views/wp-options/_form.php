<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WpOptions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wp-options-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'option_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'option_value')->textarea(['rows' => 6]) ?>

    <?php if ($model->isNewRecord) {
        $model->autoload = '1';
    } ?>
    <?= $form->field($model, 'autoload')->dropDownList(
        ['0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')],
        ['prompt' => '']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
