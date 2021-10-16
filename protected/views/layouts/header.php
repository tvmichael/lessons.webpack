<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

NavBar::begin([
    'brandLabel' => Yii::t('app/main', 'My home'),
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-default navbar-fixed-top',
    ],
]);

// https://www.yiiframework.com/extension/yiisoft/yii2-bootstrap/doc/api/2.0/yii-bootstrap-nav
$items = [];

if(Yii::$app->user->isGuest)
{
    $items[] = ['label' => Yii::t('app/main','Login'), 'url' => ['/user/login']];
}

if(Yii::$app->user->can('admin'))
{
    $items[] = [
        'label' => Yii::t('app/main', 'General expenses'),
        'items' => [
            ['label' => Yii::t('app/main', 'List of products'), 'url' => ['/product/index']],
            ' <li role="separator" class="divider"></li>',
            ['label' => Yii::t('app/main', 'Add product'), 'url' => ['/product/add-product']],
            ['label' => Yii::t('app/main', 'Add costs'), 'url' => ['/product/costs']],
        ]
    ];
    $items[] = [
        'label' => Yii::t('app/main', 'Utility costs'),
        'items' => [
            ['label' => 'p1', 'url' => ['/main/about']],
            ['label' => 'p2', 'url' => ['/main/contact']],
        ]
    ];
}

if(Yii::$app->user->can('user'))
{
    $items[] = [
        'label' => Yii::t('app/main', 'General information'),
        'items' => [
            ['label' => 'About', 'url' => ['/main/about']],
            ['label' => 'Contact', 'url' => ['/main/contact']],
        ]
    ];
}

if(!Yii::$app->user->isGuest)
{
    $items[] = (
        '<li class="nav-form">'
        . Html::beginForm(['/user/logout'], 'post')
        . Html::submitButton(
            'Вихід (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>'
    );
}

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $items
]);

NavBar::end();
?>
