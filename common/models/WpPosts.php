<?php

namespace common\models;

use common\models\WpTermRelationships;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Inflector;

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
class WpPosts extends ActiveRecord
{
    public $categories;
    public $tags;

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
            [['author', 'title', 'name', 'mime_type', 'status', 'created_at', 'comment_status', 'comment_count'], 'required'],
            [['author', 'comment_count'], 'integer'],
            [['title', 'content', 'type', 'status', 'comment_status'], 'string'],
            [['created_at', 'updated_at', 'categories', 'tags'], 'safe'],
            [['name', 'mime_type'], 'string', 'max' => 255],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['backend.wp-posts'] = ['author', 'title', 'content', 'status', 'comment_status', 'categories', 'tags'];
        return $scenarios;
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
            'tags' => Yii::t('app', 'Tags'),
        ];
    }

    public function afterFind()
    {
        parent::afterFind();
        $WpTermRelationships = WpTermRelationships::find()->where(['post_id' => $this->id])->all();
        foreach ($WpTermRelationships as $WpTermRelationship) {
            $this->categories[] = $WpTermRelationship->wpTermTaxonomy->id;
            $this->tags[] = $WpTermRelationship->wpTermTaxonomy->name;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $this->name = Inflector::slug($this->title);
            if (self::find()->where(['<>', 'id', $this->id])->andWhere(['name' => $this->name])->andWhere(['type' => 'post'])->exists()) {
                $this->name = Inflector::slug($this->name.' '.$this->id);
                $this->update();
            }
        }
    }

    public function beforeSave($insert)
    {
        $this->name = Inflector::slug($this->title);

        if ($this->isNewRecord) {
            $this->created_at = new Expression('NOW()');
        } else if ($this->isNewRecord) {
            if (self::find()->where(['<>', 'id', $this->id])->andWhere(['name' => $this->name])->andWhere(['type' => 'post'])->exists()) {
                $this->name = Inflector::slug($this->name.' '.$this->id);
            }
        }

        $this->updated_at = new Expression('NOW()');

        return true;
    }

    public function getCommentStatusOptions()
    {
        return [
            'open' => Yii::t('app', 'Open'),
            'closed' => Yii::t('app', 'Closed'),
        ];
    }

    public function getStatusOptions($type = '')
    {
        if ($type == 'all') {
            return [
                'draft' => Yii::t('app', 'Draft'),
                'publish' => Yii::t('app', 'Publish'),
                'trash' => Yii::t('app', 'Trash'),
                'deleted' => Yii::t('app', 'Deleted'),
            ];
        } else {
            return [
                'draft' => Yii::t('app', 'Draft'),
                'publish' => Yii::t('app', 'Publish'),
                'trash' => Yii::t('app', 'Trash'),
            ];
        }
    }

    public function getTypeOptions()
    {
        return [
            'attachment' => Yii::t('app', 'Attachment'),
            'page' => Yii::t('app', 'Page'),
            'post' => Yii::t('app', 'Post'),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'author']);
    }

    public function getWpTermRelationships()
    {
        return $this->hasMany(WpTermRelationships::className(), ['post_id' => 'id']);
    }
}
