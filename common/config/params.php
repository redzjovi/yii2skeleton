<?php
return [
    'adminEmail' => 'admin@example.com',
    'kartikGrid' => [
        'condensed' => true,
        'panel' => ['after' => false],
        'responsiveWrap' => false,
        'toolbar' => [
            // ['content' => Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['view', 'id' => $model->id], ['class' => 'btn btn-default', 'data-pjax' => 1, 'title' => Yii::t('kvgrid', 'Reset Grid')])],
            // ['content' => Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''], ['class' => 'btn btn-default', 'data-pjax' => 1, 'title' => Yii::t('kvgrid', 'Reset Grid')])],
            '{toggleData}',
            // '{export}',
        ],
    ],
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
];
