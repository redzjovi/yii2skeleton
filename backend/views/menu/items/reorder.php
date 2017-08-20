<?php

use common\models\Menu;
use slatiusa\nestable\Nestable;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Reorder Menu Items');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Back'), ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= Nestable::widget([
        'modelOptions' => ['name' => 'name'],
        'pluginEvents' => [
            'change' => 'function(e) {}',
        ],
        'pluginOptions' => ['maxDepth' => 7],
        'type' => Nestable::TYPE_WITH_HANDLE,
        // 'query' => Menu::find(),
        // 'query' => Menu::find()->where(['id' => $model->id]),
        'query' => Menu::find()->where(['parent_id' => $model->id])->andWhere(['depth' => 2])->orderBy('lft'),
    ]); ?>

</div>
