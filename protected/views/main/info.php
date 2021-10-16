<?php

/* @var $this yii\web\View */

$this->title = 'MiniSite';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-md-12">
                <pre>
                    <?php
                    if (!Yii::$app->user->isGuest)
                    {
                        $userId = \Yii::$app->user->getId();

                        //Все роли текущего пользователя
                        var_dump(\Yii::$app->authManager->getRolesByUser($userId));
                        PHP_EOL;

                        //Разрешение пользователя
                        var_dump(\Yii::$app->authManager->getAssignment('user', $userId));
                        PHP_EOL;

                        //Все разрешения пользователя
                        var_dump(\Yii::$app->authManager->getAssignments($userId));
                        PHP_EOL;

                        //Проверка доступа пользователя
                        var_dump(\Yii::$app->authManager->checkAccess($userId, 'user', $params = []));
                        PHP_EOL;

                        //Тоже проверка доступа пользователя
                        var_dump(Yii::$app->user->can('user'));


                        // --------------
                        echo '<p>Admin:</p>';

                        //Все роли текущего пользователя
                        var_dump(\Yii::$app->authManager->getRolesByUser($userId));
                        PHP_EOL;

                        //Разрешение пользователя
                        var_dump(\Yii::$app->authManager->getAssignment('admin', $userId));
                        PHP_EOL;

                        //Все разрешения пользователя
                        var_dump(\Yii::$app->authManager->getAssignments($userId));
                        PHP_EOL;

                        //Проверка доступа пользователя
                        var_dump(\Yii::$app->authManager->checkAccess($userId, 'admin', $params = []));
                        PHP_EOL;

                        //Тоже проверка доступа пользователя
                        var_dump(Yii::$app->user->can('admin'));


                    } else
                    {
                        echo "Гість!";
                    }
                    ?>
                </pre>
                <pre>
                    <?php
                    print_r($_SESSION);
                    print_r($_SERVER);
                    ?>
                </pre>
            </div>
        </div>
    </div>
</div>
