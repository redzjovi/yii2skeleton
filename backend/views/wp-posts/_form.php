<?php

use common\models\WpCategories;
use common\models\WpTags;
use common\models\WpTermRelationships;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="wp-posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'author')->hiddenInput(['value' => Yii::$app->user->id])->label(false); ?>

    <?= $form->field($model, 'title')->textInput(); ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 5]); ?>

    <?= $form->field($model, 'type')->hiddenInput(['value' => 'post'])->label(false); ?>

    <?php $model->status = $model->isNewRecord ? 'publish' : $model->status; ?>
    <?= $form->field($model, 'status')->dropDownList($model->getStatusOptions()); ?>

    <?= $form->field($model, 'comment_status')->dropDownList($model->getCommentStatusOptions()); ?>

    <?php $WpCategories = new WpCategories();
    $WpCategories->setTreePrefix('&nbsp;&nbsp;&nbsp;');
    $categoriesOptions = $WpCategories->getCategoriesTreeOptions(); ?>
    <?= $form->field($model, 'categories')->checkboxList(
        ArrayHelper::map($categoriesOptions, 'id', 'name'),
        [
            'class' => 'categories-container',
            'item' => function ($index, $label, $name, $checked, $value) use ($categoriesOptions) {
                return '<div class="checkbox">'.
                    $categoriesOptions[$value]['tree_prefix'].
                    Html::checkbox($name, $checked, ['label' => $label, 'value' => $value]).
                '</div>';
            },
        ]
    ); ?>

    <?= $form->field($model, 'tags')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(WpTags::find()->taxonomyTag()->orderBy(['name' => SORT_ASC])->asArray()->all(), 'name', 'name'),
        'options' => ['multiple' => true],
        'pluginOptions' => ['tags' => true],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
