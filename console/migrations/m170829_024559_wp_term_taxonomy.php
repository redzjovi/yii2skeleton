<?php

use yii\db\Schema;
use yii\db\Migration;

class m170829_024559_wp_term_taxonomy extends Migration
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
            '{{%wp_term_taxonomy}}',
            [
                'id'=> $this->bigPrimaryKey(20),
                'name'=> $this->string(255)->notNull(),
                'slug'=> $this->string(255)->notNull(),
                'taxonomy'=> $this->string(255)->notNull(),
                'description'=> $this->text()->notNull(),
                'parent'=> $this->bigInteger(20)->notNull(),
                'count'=> $this->bigInteger(20)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%wp_term_taxonomy}}');
    }
}
