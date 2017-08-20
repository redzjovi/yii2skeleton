<?php

use yii\db\Schema;
use yii\db\Migration;

class m170702_023629_product_images extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable('{{%product_images}}',[
            'id'=> $this->primaryKey(11),
            'product_id'=> $this->integer(11)->notNull(),
            'name'=> $this->text()->notNull(),
            'path'=> $this->text()->notNull(),
            'size'=> $this->integer(11)->notNull(),
            'type'=> $this->string(50)->notNull(),
            'mime'=> $this->string(50)->notNull(),
            'position'=> $this->integer(11)->notNull(),
        ], $tableOptions);

        $this->createIndex('product_id','{{%product_images}}',['product_id'],false);
        $this->addForeignKey(
            'fk_product_images_product_id',
            '{{%product_images}}', 'product_id',
            '{{%products}}', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
            $this->dropForeignKey('fk_product_images_product_id', '{{%product_images}}');
            $this->dropTable('{{%product_images}}');
    }
}
