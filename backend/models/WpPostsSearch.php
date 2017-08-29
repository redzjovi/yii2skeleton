<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\WpPosts;

/**
 * WpPostsSearch represents the model behind the search form about `common\models\WpPosts`.
 */
class WpPostsSearch extends WpPosts
{
    public $author_name;
    public $updated_at_date;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author', 'comment_count'], 'integer'],
            [['author_name'], 'string'],
            [['title', 'name', 'content', 'type', 'mime_type', 'status', 'created_at', 'updated_at', 'updated_at_date', 'comment_status'], 'safe'],
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

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'author' => $this->author,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
            'comment_count' => $this->comment_count,
        ]);

        if ($this->updated_at_date) { $query->andFilterWhere(['DATE('.self::tableName().'.updated_at)' => $this->updated_at_date]); }

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'mime_type', $this->mime_type])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'comment_status', $this->comment_status]);

        return $dataProvider;
    }
}
