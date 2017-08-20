<?php

use yii\db\Schema;
use yii\db\Migration;

class m170818_032042_menu extends Migration
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
            '{{%menu}}',
            [
                'id'=> $this->primaryKey(11),
                'name'=> $this->string(255)->notNull(),
                'parent_id'=> $this->integer(11)->notNull(),
                'lft'=> $this->integer(11)->notNull(),
                'rgt'=> $this->integer(11)->notNull(),
                'depth'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%menu}}');
    }
}
