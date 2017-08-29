<?php

use kartik\widgets\FileInput;
use kartik\widgets\SwitchInput;
use jlorente\remainingcharacters\RemainingCharacters;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'options' => ['enctype' => 'multipart/form-data', 'id' => 'products_form'],
    ]); ?>

    <?= $form->field($model, 'product_name')->widget(
        RemainingCharacters::classname(),
        [
            'text' => Yii::t('app', '{n} characters remaining'),
            'type' => RemainingCharacters::INPUT_TEXT,
            'options' => [
                'class' => 'form-control',
                'maxlength' => true,
            ],
        ]
    ); ?>

    <?php $initialPreview = $initialPreviewConfig = [];
    if (! $model->isNewRecord) {
        foreach ($productImagesModel as $row) {
            $initialPreview[] = Html::img(
                Url::to('@web'. '/'. $row->path),
                [
                    'alt' => $row->name . '.' .$row->type,
                    'class' => 'file-preview-image',
                    'title' => $row->name . '.' .$row->type,
                    'style' => 'height: inherit; width: inherit;',
                ]
            )
            .Html::activeHiddenInput(
                $productsForm,
                'product_images[]',
                ['value' => $row->path]
            );

            $initialPreviewConfig[] = [
                'caption' => $row->name . '.' .$row->type,
                'extra' => ['type' => 'temp'],
                'key' => $row->id,
                'size' => $row->size,
                'url' => Url::to('@web/products/image-delete'),
            ];
        }
    } ?>

    <?= $form->field($productsForm, 'product_images_array[]')->widget(
        FileInput::classname(),
        [
            'options' => [
                'accept' => 'image/*',
                'id' => 'product_images',
                'multiple' => true,
            ],
            'pluginOptions' => [
                'initialPreview' => $initialPreview,
                'initialPreviewConfig' => $initialPreviewConfig,
                'maxFileCount' => 5,
                'overwriteInitial' => false,
                'showRemove' => false,
                'showUpload' => false,
                'uploadAsync' => true,
                'uploadUrl' => Url::to('@web/products/image-upload'),
            ],
        ]
    ); ?>

    <?= $form->field($model, 'description')->widget(
        RemainingCharacters::classname(),
        [
            'text' => Yii::t('app', '{n} characters remaining'),
            'type' => RemainingCharacters::INPUT_TEXTAREA,
            'options' => [
                'class' => 'form-control',
                'maxlength' => true,
                'rows' => 5,
            ],
        ]
    ); ?>

    <div class="row">
        <div class="col-md-3">
            <?php if (empty($model->weight)) {
                $model->weight = 1000;
            } ?>
            <?= $form->field($model, 'weight')->widget(
                MaskedInput::classname(),
                [
                    'clientOptions' => [
                        'alias' => 'decimal',
                        'autoGroup' => true,
                        'groupSeparator' => ',',
                        'removeMaskOnSubmit' => true,
                    ],
                ]
            ); ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'sell_price')->widget(
                MaskedInput::classname(),
                [
                    'clientOptions' => [
                        'alias' => 'decimal',
                        'autoGroup' => true,
                        'groupSeparator' => ',',
                        'removeMaskOnSubmit' => true,
                    ],
                ]
            ); ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'stock')->widget(
                MaskedInput::classname(),
                [
                    'clientOptions' => [
                        'alias' => 'decimal',
                        'autoGroup' => true,
                        'groupSeparator' => ',',
                        'removeMaskOnSubmit' => true,
                    ],
                ]
            ); ?>
        </div>

        <div class="col-md-3">
            <?php if ($model->isNewRecord) {
                $model->status = true;
            } ?>
            <?= $form->field($model, 'status')->widget(
                SwitchInput::classname(),
                [
                    'pluginOptions' => [
                        'offText' => Yii::t('app', 'Inactive'),
                        'onText' => Yii::t('app', 'Active'),
                    ],
                ]
            ); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php $js = <<< JS
$('#product_images').on('filebatchselected', function(event, files) {
    $(this).fileinput('upload');
});
JS;
$this->registerJs(
    $js,
    View::POS_READY
); ?>
