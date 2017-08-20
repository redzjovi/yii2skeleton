<?php

use yii\db\Schema;
use yii\db\Migration;

class m170818_032119_menuDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%menu}}',
                           ["id", "name", "parent_id", "lft", "rgt", "depth"],
                            [
    [
        'id' => '1',
        'name' => 'root',
        'parent_id' => '0',
        'lft' => '1',
        'rgt' => '2',
        'depth' => '0',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%menu}} CASCADE');
    }
}
