<?php

namespace app\commands;

// перед тим як додавати правили слід створити відповідні таблиці (якщо їх нема в БД)
// yii migrate --migrationPath=@yii/rbac/migrations

// в консолі виконати
// yii rbac/init

use app\models\advanced\AdvancedUser;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "create"
        $create = $auth->createPermission('create');
        $create->description = 'Create item';
        $auth->add($create);

        // добавляем разрешение "update"
        $update = $auth->createPermission('update');
        $update->description = 'Update item';
        $auth->add($update);

        // добавляем разрешение "views"
        $views = $auth->createPermission('views');
        $views->description = 'Views item';
        $auth->add($views);

        // ---

        // добавляем роль "author" и даём роли разрешение "create"
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $views);
        $auth->addChild($author, $create);
        $auth->addChild($author, $update);

        // добавляем роль "admin" и даём роли разрешение "update"
        // а также все разрешения роли "author"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $update);
        $auth->addChild($admin, $author);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        //$auth->assign($author, 2);
        //$auth->assign($admin, 1);
    }

    public function actionSetRole($id = null, $role = 'user')
    {

        // перевіряємо id
        if(!$id || is_int($id))
        {
            // throw new \yii\base\InvalidConfigException("param 'id' must be set");
            $this->stdout("Param 'id' must be set!\n", Console::BG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        // чи є користувач з таким id
        $user = (new AdvancedUser())->findIdentity($id);
        if(!$user)
        {
            // throw new \yii\base\InvalidConfigException("User witch id:'$id' is not found");
            $this->stdout("User witch id:'$id' is not found!\n", Console::BG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        // беремо объект yii\rbac\DbManager, який назначили в конфіг для компонента authManager
        $auth = Yii::$app->authManager;

        // отримуємо обєкт ролі
        $role = $auth->getRole($role);

        // видаляємо всі роля користувача
        $auth->revokeAll($id);

        // присвоюємо роль по id
        $auth->assign($role, $id);

        // виводимо повідомлення
        $this->stdout("Done!\n", Console::BOLD);
        return ExitCode::OK;
    }
}