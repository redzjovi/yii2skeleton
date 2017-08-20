<?php

use common\models\User;
use yii\db\Migration;

class m170612_053259_initial_data extends Migration
{
    public function safeUp()
    {
        $this->createUser();
        $this->createRbac();
    }

    public function safeDown()
    {
        $this->deleteRbac();
        $this->deleteUser();
    }

    public function createRbac()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $superadmin = $auth->createRole('superadmin');
        $auth->add($superadmin);
        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $permission = $auth->createPermission('backend/cms');
        $auth->add($permission);
        $auth->addChild($superadmin, $permission);

        $permission = $auth->createPermission('backend/menu');
        $auth->add($permission);
        $auth->addChild($superadmin, $permission);

        $permission = $auth->createPermission('backend/products');
        $auth->add($permission);
        $auth->addChild($superadmin, $permission);
        $auth->addChild($admin, $permission);

        $permission = $auth->createPermission('backend/top');
        $auth->add($permission);
        $auth->addChild($superadmin, $permission);
        $auth->addChild($admin, $permission);

        $permission = $auth->createPermission('backend/user');
        $auth->add($permission);
        $auth->addChild($superadmin, $permission);

        $permission = $auth->createPermission('backend/wp-options');
        $auth->add($permission);
        $auth->addChild($superadmin, $permission);

        $user = User::findOne(['username' => 'superadmin']);
        $auth->assign($superadmin, $user->id);
        $user = User::findOne(['username' => 'admin']);
        $auth->assign($admin, $user->id);
    }

    public function createUser()
    {
        $this->addColumn('{{%user}}', 'status', $this->smallInteger()->notNull()->defaultValue(10)->after('email'));

        $user = new User();
        $user->username = 'superadmin';
        $user->email = 'superadmin@email.com';
        $user->setPassword('superadmin');
        $user->generateAuthKey();
        $user->confirmed_at = time();
        $user->save();

        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@email.com';
        $user->setPassword('admin');
        $user->generateAuthKey();
        $user->confirmed_at = time();
        $user->save();
    }

    public function deleteRbac()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }

    public function deleteUser()
    {
        $this->dropColumn('{{%user}}', 'status');
        $users = User::find()->where(['in', 'username', ['superadmin', 'admin']])->all();
        foreach ($users as $user) {
            $user->delete();
        }
    }
}
