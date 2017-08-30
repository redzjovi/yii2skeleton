<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wp_term_relationships}}".
 *
 * @property integer $post_id
 * @property integer $term_taxonomy_id
 */
class WpTermRelationships extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wp_term_relationships}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'term_taxonomy_id'], 'required'],
            [['post_id', 'term_taxonomy_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => Yii::t('app', 'Post ID'),
            'term_taxonomy_id' => Yii::t('app', 'Term Taxonomy ID'),
        ];
    }
}
