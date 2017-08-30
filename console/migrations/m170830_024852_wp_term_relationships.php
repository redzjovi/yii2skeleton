<?php

use yii\db\Schema;
use yii\db\Migration;

class m170830_024852_wp_term_relationships extends Migration
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
            '{{%wp_term_relationships}}',
            [
                'post_id'=> $this->bigInteger(20)->notNull(),
                'term_taxonomy_id'=> $this->bigInteger(20)->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%wp_term_relationships}}');
    }
}
