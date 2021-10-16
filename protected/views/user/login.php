<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::t('app/user', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2><?= Html::encode($this->title) ?></h2>
                    <hr>
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'layout' => 'horizontal',
                        'fieldConfig' => [
                            'template' => "<div class='col-lg-3'>{label}</div>\n<div class='col-lg-9'>{input}</div>\n<div class='col-lg-12 text-right'>{error}</div>",
                            'labelOptions' => ['class' => 'control-label'],
                        ],
                    ]); ?>
                    <?= $form->field($model, 'email')
                        ->textInput(['autofocus' => true]);?>
                    <?= $form->field($model, 'password')
                        ->passwordInput()->label(Yii::t('app/user', 'Password'));?>
                    <?= $form->field($model, 'rememberMe')
                        ->checkbox([
                            'template' => "<div class=\"col-lg-offset-3 col-lg-4\">{input} {label}</div>\n<div class=\"col-lg-7\">{error}</div>",
                        ]) ?>
                    <div class="form-group">
                        <div class="col-lg-offset-9 col-lg-3">
                            <?= Html::submitButton(
                                Yii::t('app/user', 'Login'),
                                ['class' => 'btn btn-primary', 'style'=>'width:100%;', 'name' => 'login-button']
                            );?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3><?=Yii::t('app/user', 'Registration')?></h3>
                    <?=Html::a(Yii::t('app/user', 'Register in the system'), Url::to(['/user/registration']), ['class' => '']);?>
                </div>
            </div>
        </div>
    </div>
</div>
