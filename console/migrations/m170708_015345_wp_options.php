<?php

use yii\db\Schema;
use yii\db\Migration;

class m170708_015345_wp_options extends Migration
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
            '{{%wp_options}}',
            [
                'id'=> $this->primaryKey(11),
                'option_name'=> $this->string(255)->notNull(),
                'option_value'=> $this->text()->notNull(),
                'autoload'=> "enum('0', '1') NOT NULL DEFAULT '1'",
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%wp_options}}');
    }
}
