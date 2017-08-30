<?php

namespace common\models;

use common\models\WpTagsQuery;
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
class WpTags extends WpTermTaxonomy
{
    public function rules()
    {
        return [
            [['name', 'slug', 'taxonomy', 'count'], 'required'],
            [['description'], 'string'],
            [['parent', 'count'], 'integer'],
            [['name', 'slug', 'taxonomy'], 'string', 'max' => 255],
        ];
    }

    public function scenarios()
    {
		$scenarios = parent::scenarios();
        $scenarios['backend.wp-tags'] = ['name', 'taxonomy', 'description'];
        return $scenarios;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            if (self::find()->where(['<>', 'id', $this->id])->andWhere(['slug' => $this->slug])->taxonomyTag()->exists()) {
                $this->slug = Inflector::slug($this->slug.' '.$this->id);
                $this->update();
            }
        }
    }

    public function beforeSave($insert)
    {
        $this->slug = Inflector::slug($this->name);

        if (! $this->isNewRecord) {
            if (self::find()->where(['<>', 'id', $this->id])->andWhere(['slug' => $this->slug])->taxonomyTag()->exists()) {
                $this->slug = Inflector::slug($this->slug.' '.$this->id);
            }
        }

        return true;
    }

    public static function find()
    {
        return new WpTagsQuery(get_called_class());
    }

    /**
     * @param array $names
     * @return array $WpTags
     */
    public function createTag($names = [])
    {
        $WpTags = [];

        if (is_array($names)) {
            foreach ($names as $name) {
                $model = self::find()->where(['=', 'name', $name])->taxonomyTag()->one();
                if ($model == false) {
                    $model = new WpTags();
                    $model->scenario = 'backend.wp-tags';
                    $model->name = $name;
                    $model->taxonomy = 'tag';
                    $model->save();
                }
                $WpTags[] = $model;
            }
        }

        return $WpTags;
    }
}
