<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WpPosts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wp-posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'author')->textInput() ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'attachment' => 'Attachment', 'page' => 'Page', 'post' => 'Post', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'mime_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'draft' => 'Draft', 'publish' => 'Publish', 'trash' => 'Trash', 'deleted' => 'Deleted', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'comment_status')->dropDownList([ 'open' => 'Open', 'closed' => 'Closed', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'comment_count')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
