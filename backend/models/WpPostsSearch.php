<?php

namespace backend\models;

use common\models\User;
use common\models\WpPosts;
use common\models\WpTermRelationships;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * WpPostsSearch represents the model behind the search form about `common\models\WpPosts`.
 */
class WpPostsSearch extends WpPosts
{
    public $author_name;
    public $updated_at_date;
    public $category_id;
    public $tag_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author', 'comment_count', 'category_id'], 'integer'],
            [['author_name', 'tag_id'], 'string'],
            [['title', 'name', 'content', 'type', 'mime_type', 'status', 'created_at', 'updated_at', 'updated_at_date', 'comment_status', 'category_id', 'tag_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = WpPosts::find()->with(['user']);
        $query->joinWith(['user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['author'] = [
            'asc' => [User::tableName().'.email' => SORT_ASC],
            'desc' => [User::tableName().'.email' => SORT_DESC],
        ];

        $this->load($params);

        if (! $this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query
            ->andFilterWhere(['=', 'id', $this->id])
            ->andFilterWhere(['=', 'author', $this->author])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'mime_type', $this->mime_type])
            ->andFilterWhere(['like', 'status', $this->status])
            // ->andFilterWhere(['like', 'created_at', $this->created_at])
            // ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['=', 'DATE('.self::tableName().'.updated_at)', $this->updated_at_date])
            ->andFilterWhere(['like', 'comment_status', $this->comment_status])
            ->andFilterWhere(['=', 'comment_count', $this->comment_count]);

        if ($this->category_id) {
            $posts_id = ArrayHelper::getColumn(WpTermRelationships::find()->select('post_id')->where(['term_taxonomy_id' => $this->category_id])->asArray()->all(), 'post_id');
            $query->andFilterWhere(['IN', self::tableName().'.id', $posts_id]);
        }
        if ($this->tag_id) {
            $posts_id = ArrayHelper::getColumn(WpTermRelationships::find()->select('post_id')->where(['term_taxonomy_id' => $this->tag_id])->asArray()->all(), 'post_id');
            $query->andFilterWhere(['IN', self::tableName().'.id', $posts_id]);
        }

        return $dataProvider;
    }
}
