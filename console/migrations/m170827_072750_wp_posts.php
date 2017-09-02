<?php

use yii\db\Schema;
use yii\db\Migration;

class m170827_072750_wp_posts extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%wp_posts}}',
            [
                'id'=> $this->bigPrimaryKey(20),
                'author'=> $this->bigInteger(20)->notNull()->comment('$user->id'),
                'title'=> $this->text()->notNull(),
                'name'=> $this->string(255)->notNull(),
                'content'=> $this->text()->notNull(),
                'type'=> "enum('attachment', 'page', 'post') NOT NULL DEFAULT 'post'",
                'mime_type'=> $this->string(255)->notNull(),
                'status'=> "enum('draft', 'publish', 'trash', 'deleted') NOT NULL DEFAULT 'publish'",
                'created_at'=> $this->timestamp()->null()->defaultValue(null),
                'updated_at'=> $this->timestamp()->null()->defaultValue(null),
                'comment_status'=> "enum('open', 'closed') NULL DEFAULT 'open'",
                'comment_count'=> $this->bigInteger(11)->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%wp_posts}}');
    }
}
