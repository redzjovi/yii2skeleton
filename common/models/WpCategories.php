<?php

namespace common\models;

use common\components\helpers\ArrayHelper;
use common\models\WpCategoriesQuery;
use common\models\WpTermTaxonomy;
use Yii;
use yii\helpers\Inflector;

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
class WpCategories extends WpTermTaxonomy
{
    public $treePrefix = '--';

    public function rules()
    {
        return [
            [['name', 'slug', 'taxonomy'], 'required'],
            [['description'], 'string'],
            [['parent', 'count'], 'integer'],
            [['name', 'slug', 'taxonomy'], 'string', 'max' => 255],
        ];
    }

    public function scenarios()
    {
		$scenarios = parent::scenarios();
        $scenarios['backend.wp-categories'] = ['name', 'taxonomy', 'description', 'parent', 'count'];
        return $scenarios;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            if (self::find()->where(['<>', 'id', $this->id])->andWhere(['slug' => $this->slug])->taxonomyCategory()->exists()) {
                $this->slug = Inflector::slug($this->slug.' '.$this->id);
                $this->update();
            }
        }
    }

    public function beforeSave($insert)
    {
        $this->slug = Inflector::slug($this->name);

        if (! $this->isNewRecord) {
            if (self::find()->where(['<>', 'id', $this->id])->andWhere(['slug' => $this->slug])->taxonomyCategory()->exists()) {
                $this->slug = Inflector::slug($this->slug.' '.$this->id);
            }
        }

        $this->parent = intval($this->parent);

        return true;
    }

    public static function find()
    {
        return new WpCategoriesQuery(get_called_class());
    }

    /**
     * @param array $names
     * @return array $WpCategories
     */
    public function createCategory($names = [])
    {
        $WpCategories = [];

        if (is_array($names)) {
            foreach ($names as $name) {
                $model = self::find()->where(['=', 'name', $name])->taxonomyCategory()->one();
                if ($model == false) {
                    $model = new WpCategories();
                    $model->scenario = 'backend.wp-categories';
                    $model->name = $name;
                    $model->taxonomy = 'category';
                    $model->save();
                }
                $WpCategories[] = $model;
            }
        }

        return $WpCategories;
    }

    public function getCategoriesTreeOptions()
    {
        $query = self::find();
        if ($this->id) { $query->where(['<>', 'id', $this->id]); }
        $WpCategories = $query->taxonomyCategory()->orderBy(['name' => SORT_ASC])->asArray()->all();

        $tree = ArrayHelper::buildTree($WpCategories);
        $treeOptions = ArrayHelper::printTree($tree, $this->treePrefix);
        return $treeOptions;
    }

    /**
     * @param array $ids
     * @return array $WpCategories
     */
    public function selectCategories($ids = [])
    {
        $WpCategories = [];

        if (is_array($ids)) {
            foreach ($ids as $id) {
                if ($model = self::findOne($id)) {
                    $WpCategories[] = $model;
                }
            }
        }

        return $WpCategories;
    }

    public function setTreePrefix($value)
    {
        $this->treePrefix = $value;
    }
}
