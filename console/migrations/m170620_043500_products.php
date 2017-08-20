<?php

use yii\db\Schema;
use yii\db\Migration;

class m170620_043500_products extends Migration
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
            '{{%products}}',
            [
                'id'=> $this->primaryKey(11),
                'product_name'=> $this->string(70)->notNull(),
                'description'=> $this->text()->notNull(),
                'weight'=> $this->integer(11)->notNull()->comment('Grams'),
                'sell_price'=> $this->integer(11)->notNull(),
                'stock'=> $this->integer(11)->notNull(),
                'status'=> "enum('0', '1', '', '') NOT NULL COMMENT '{ 0: \'inactive\', 1: \'active\' }'",
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }
}
