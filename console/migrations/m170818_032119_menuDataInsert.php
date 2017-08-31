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
        $this->batchInsert(
            '{{%menu}}',
            ["id", "name", "link", "auth_item_name", "parent_id", "lft", "rgt", "depth"],
            [
                [
                    'id' => '1',
                    'name' => 'root',
                    'link' => '',
                    'auth_item_name' => '',
                    'parent_id' => '0',
                    'lft' => '1',
                    'rgt' => '22',
                    'depth' => '0',
                ],
                [
                    'id' => '2',
                    'name' => 'CMS',
                    'link' => '',
                    'auth_item_name' => '',
                    'parent_id' => '1',
                    'lft' => '14',
                    'rgt' => '21',
                    'depth' => '1',
                ],
                [
                    'id' => '3',
                    'name' => 'Users, Roles, Permissions',
                    'link' => '/user/admin',
                    'auth_item_name' => 'backend.user',
                    'parent_id' => '2',
                    'lft' => '18',
                    'rgt' => '19',
                    'depth' => '3',
                ],
                [
                    'id' => '4',
                    'name' => 'Menu',
                    'link' => '/menu',
                    'auth_item_name' => 'backend.menu',
                    'parent_id' => '2',
                    'lft' => '16',
                    'rgt' => '17',
                    'depth' => '3',
                ],
                [
                    'id' => '5',
                    'name' => 'CMS',
                    'link' => '#',
                    'auth_item_name' => 'backend.cms',
                    'parent_id' => '2',
                    'lft' => '15',
                    'rgt' => '20',
                    'depth' => '2',
                ],
                [
                    'id' => '6',
                    'name' => 'Backend Top',
                    'link' => '',
                    'auth_item_name' => null,
                    'parent_id' => '1',
                    'lft' => '2',
                    'rgt' => '13',
                    'depth' => '1',
                ],
                [
                    'id' => '7',
                    'name' => 'Products',
                    'link' => '/products',
                    'auth_item_name' => 'backend.products',
                    'parent_id' => '6',
                    'lft' => '4',
                    'rgt' => '5',
                    'depth' => '3',
                ],
                [
                    'id' => '8',
                    'name' => 'Backend Top',
                    'link' => '#',
                    'auth_item_name' => 'backend.top',
                    'parent_id' => '6',
                    'lft' => '3',
                    'rgt' => '12',
                    'depth' => '2',
                ],
                [
                    'id' => '9',
                    'name' => 'Wp Posts',
                    'link' => '/wp-posts',
                    'auth_item_name' => 'backend.wp-posts',
                    'parent_id' => '6',
                    'lft' => '6',
                    'rgt' => '7',
                    'depth' => '3',
                ],
                [
                    'id' => '10',
                    'name' => 'Wp Tags',
                    'link' => '/wp-tags',
                    'auth_item_name' => 'backend.wp-tags',
                    'parent_id' => '6',
                    'lft' => '10',
                    'rgt' => '11',
                    'depth' => '3',
                ],
                [
                    'id' => '11',
                    'name' => 'Wp Categories',
                    'link' => '/wp-categories',
                    'auth_item_name' => 'backend.wp-categories',
                    'parent_id' => '6',
                    'lft' => '8',
                    'rgt' => '9',
                    'depth' => '3',
                ],
            ]
        );
    }

    public function safeDown()
    {
        $this->truncateTable('{{%menu}}');
    }
}
