<?php

namespace common\models;

use common\models\WpTermTaxonomy;
use Yii;

/**
 * This is the model class for table "{{%wp_term_relationships}}".
 *
 * @property integer $id
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
            'id' => Yii::t('app', 'ID'),
            'post_id' => Yii::t('app', 'Post ID'),
            'term_taxonomy_id' => Yii::t('app', 'Term Taxonomy ID'),
        ];
    }

    public function createWpTermRelationships($post_id, $term_taxonomies = [], $taxonomy = 'category')
    {
        $term_taxonomies_id = [];

        foreach ($term_taxonomies as $term_taxonomy) {
            $term_taxonomies_id[] = $term_taxonomy->id;

            $exist = self::find()->where(['post_id' => $post_id])->andWhere(['term_taxonomy_id' => $term_taxonomy->id])->exists();
            if ($exist == false) {
                $model = new WpTermRelationships();
                $model->isNewRecord = true;
                $model->post_id = $post_id;
                $model->term_taxonomy_id = $term_taxonomy->id;
                $model->save();
            }
            $WpTermTaxonomy = new WpTermTaxonomy();
            $WpTermTaxonomy->calculateCount($term_taxonomy->id);
        }

        $WpTermRelationships = self::find()
            ->joinWith(['wpTermTaxonomy' => function ($q) use ($taxonomy) { $q->where(['taxonomy' => $taxonomy]); }])
            ->where(['post_id' => $post_id])->andWhere(['NOT IN', 'term_taxonomy_id', $term_taxonomies_id])->all();
        foreach ($WpTermRelationships as $WpTermRelationship) {
            $WpTermRelationship->delete();

            $WpTermTaxonomy = new WpTermTaxonomy();
            $WpTermTaxonomy->calculateCount($WpTermRelationship->term_taxonomy_id);
        }
    }

    public function getWpCategory()
    {
        return $this->hasOne(WpTermTaxonomy::className(), ['id' => 'term_taxonomy_id'])->andOnCondition(['taxonomy' => 'category']);
    }

    public function getWpTag()
    {
        return $this->hasOne(WpTermTaxonomy::className(), ['id' => 'term_taxonomy_id'])->andOnCondition(['taxonomy' => 'tag']);
    }

    public function getWpTermTaxonomy()
    {
        return $this->hasOne(WpTermTaxonomy::className(), ['id' => 'term_taxonomy_id']);
    }

    public function getWpTermRelationshipName()
    {
        return ($this->wpTermTaxonomy ? $this->wpTermTaxonomy->name : '');
    }
}
