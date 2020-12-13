<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);

$items = [];

if(Yii::$app->user->isGuest)
{
    $items = [
        ['label' => Yii::t('app/main','Login'), 'url' => ['/user/login']]
    ];
}
else
{
    $items = [
        ['label' => 'About', 'url' => ['/main/about']],
        ['label' => 'Contact', 'url' => ['/main/contact']],
        (
            '<li>'
            . Html::beginForm(['/user/logout'], 'post')
            . Html::submitButton(
                'Вихід (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'
        )
    ];
}

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $items
]);

NavBar::end();
?>
