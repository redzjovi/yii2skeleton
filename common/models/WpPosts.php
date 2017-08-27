<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wp_posts".
 *
 * @property integer $id
 * @property integer $author
 * @property string $title
 * @property string $name
 * @property string $content
 * @property string $type
 * @property string $mime_type
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $comment_status
 * @property integer $comment_count
 */
class WpPosts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wp_posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author', 'title', 'name', 'content', 'mime_type', 'created_at', 'comment_count'], 'required'],
            [['author', 'comment_count'], 'integer'],
            [['title', 'content', 'type', 'status', 'comment_status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'mime_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'author' => Yii::t('app', 'Author'),
            'title' => Yii::t('app', 'Title'),
            'name' => Yii::t('app', 'Name'),
            'content' => Yii::t('app', 'Content'),
            'type' => Yii::t('app', 'Type'),
            'mime_type' => Yii::t('app', 'Mime Type'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'comment_status' => Yii::t('app', 'Comment Status'),
            'comment_count' => Yii::t('app', 'Comment Count'),
        ];
    }
}
