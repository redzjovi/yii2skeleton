<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[WpTags]].
 *
 * @see WpTags
 */
class WpTagsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return WpTags[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return WpTags|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function taxonomyTag()
    {
        return $this->andWhere(['taxonomy' => 'tag']);
    }
}
