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

                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'layout' => 'horizontal',
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
                            'labelOptions' => ['class' => 'col-lg-1 control-label'],
                        ],
                    ]); ?>

                    <?= $form->field($model, 'username')
                        ->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')
                        ->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')
                        ->checkbox([
                            'template' => "<div class=\"col-lg-offset-1 col-lg-4\">{input} {label}</div>\n<div class=\"col-lg-7\">{error}</div>",
                        ]) ?>

                    <div class="form-group">
                        <div class="col-lg-offset-1 col-lg-11">
                            <?= Html::submitButton(
                                Yii::t('app/user', 'Login'),
                                ['class' => 'btn btn-primary', 'name' => 'login-button']
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
                    <h3><?=Yii::t('app/user', 'Sing Up')?></h3>
                    <?=Html::a(Yii::t('app/user', 'Registration'), Url::to(['/user/registration']), ['class' => '']);?>
                </div>
            </div>
        </div>
    </div>
</div>
