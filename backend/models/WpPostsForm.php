<?php

namespace backend\models;

use common\models\WpPosts;

class WpPostsForm extends WpPosts
{
    public function rules()
    {
        return [
            [['author', 'title', 'content', 'status', 'comment_status'], 'required'],
            [['author', 'comment_count'], 'integer'],
            [['title', 'content', 'type', 'status', 'comment_status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'mime_type'], 'string', 'max' => 255],
        ];
    }
}
