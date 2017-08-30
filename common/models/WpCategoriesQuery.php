<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[WpCategories]].
 *
 * @see WpCategories
 */
class WpCategoriesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return WpCategories[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return WpCategories|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function taxonomyCategory()
    {
        return $this->andWhere(['taxonomy' => 'category']);
    }
}
