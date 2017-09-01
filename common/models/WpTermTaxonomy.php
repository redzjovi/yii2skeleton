<?php

namespace common\models;

use common\models\WpTermRelationships;
use Yii;

/**
 * This is the model class for table "{{%wp_term_taxonomy}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $taxonomy
 * @property string $description
 * @property integer $parent
 * @property integer $count
 */
class WpTermTaxonomy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wp_term_taxonomy}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'taxonomy', 'parent', 'count'], 'required'],
            [['description'], 'string'],
            [['parent', 'count'], 'integer'],
            [['name', 'slug', 'taxonomy'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'slug' => Yii::t('app', 'Slug'),
            'taxonomy' => Yii::t('app', 'Taxonomy'),
            'description' => Yii::t('app', 'Description'),
            'parent' => Yii::t('app', 'Parent'),
            'count' => Yii::t('app', 'Count'),
        ];
    }

    public function calculateCount($id)
    {
        if ($model = self::findOne($id)) {
            $model->count = WpTermRelationships::find()->where(['term_taxonomy_id' => $id])->count();
            $model->save();
        }
    }
}
