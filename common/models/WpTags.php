<?php

namespace common\models;

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
            if (self::find()->where(['<>', 'id', $this->id])->andWhere(['slug' => $this->slug])->andWhere(['taxonomy' => 'tag'])->exists()) {
                $this->slug = Inflector::slug($this->slug.' '.$this->id);
                $this->save();
            }
        }
    }

    public function beforeSave($insert)
    {
        $this->slug = Inflector::slug($this->name);

        if (! $this->isNewRecord) {
            if (self::find()->where(['<>', 'id', $this->id])->andWhere(['slug' => $this->slug])->andWhere(['taxonomy' => 'tag'])->exists()) {
                $this->slug = Inflector::slug($this->slug.' '.$this->id);
            }
        }

        return true;
    }
}
