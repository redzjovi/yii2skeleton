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
                           ["id", "name", "link", "auth_item_name", "parent_id", "lft", "rgt", "depth"],
                            [
    [
        'id' => '1',
        'name' => 'root',
        'link' => '',
        'auth_item_name' => '',
        'parent_id' => '0',
        'lft' => '1',
        'rgt' => '16',
        'depth' => '0',
    ],
    [
        'id' => '2',
        'name' => 'CMS',
        'link' => '',
        'auth_item_name' => '',
        'parent_id' => '1',
        'lft' => '8',
        'rgt' => '15',
        'depth' => '1',
    ],
    [
        'id' => '3',
        'name' => 'Users, Roles, Permissions',
        'link' => '/user/admin',
        'auth_item_name' => 'backend/user',
        'parent_id' => '2',
        'lft' => '12',
        'rgt' => '13',
        'depth' => '3',
    ],
    [
        'id' => '4',
        'name' => 'Menu',
        'link' => '/menu',
        'auth_item_name' => 'backend/menu',
        'parent_id' => '2',
        'lft' => '10',
        'rgt' => '11',
        'depth' => '3',
    ],
    [
        'id' => '5',
        'name' => 'CMS',
        'link' => '#',
        'auth_item_name' => 'backend/cms',
        'parent_id' => '2',
        'lft' => '9',
        'rgt' => '14',
        'depth' => '2',
    ],
    [
        'id' => '7',
        'name' => 'Backend Top',
        'link' => '',
        'auth_item_name' => null,
        'parent_id' => '1',
        'lft' => '2',
        'rgt' => '7',
        'depth' => '1',
    ],
    [
        'id' => '8',
        'name' => 'Products',
        'link' => '/products',
        'auth_item_name' => 'backend/products',
        'parent_id' => '7',
        'lft' => '4',
        'rgt' => '5',
        'depth' => '3',
    ],
    [
        'id' => '9',
        'name' => 'Backend Top',
        'link' => '#',
        'auth_item_name' => 'backend/top',
        'parent_id' => '7',
        'lft' => '3',
        'rgt' => '6',
        'depth' => '2',
    ],
]
        );
    }

    public function safeDown()
    {
        $this->truncateTable('{{%menu}} CASCADE');
    }
}
