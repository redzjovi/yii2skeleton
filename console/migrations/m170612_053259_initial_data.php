<?php

use common\models\User;
use yii\db\Migration;

class m170612_053259_initial_data extends Migration
{
    public function safeUp()
    {
        $user = new User();
        $user->username = 'admin';
        $user->email = 'redzjovi@gmail.com';
        $user->setPassword('admin');
        $user->generateAuthKey();
        $user->save();
    }

    public function safeDown()
    {
        echo "m170612_053259_initial_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170612_053259_initial_data cannot be reverted.\n";

        return false;
    }
    */
}
