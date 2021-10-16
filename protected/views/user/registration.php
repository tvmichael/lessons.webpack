<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\RegistrationForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app/user', 'Registration');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2><?= Html::encode($this->title) ?></h2>

                    <?php $form = ActiveForm::begin([
                        'id' => 'registration-form',
                        'layout' => 'horizontal',
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
                            'labelOptions' => ['class' => 'col-lg-1 control-label'],
                        ],
                    ]); ?>

                    <?= $form->field($model, 'username')
                        ->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email')
                        ->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')
                        ->passwordInput() ?>

                    <?= $form->field($model, 'password_repeat')
                        ->passwordInput() ?>

                    <div class="form-group">
                        <div class="col-lg-offset-1 col-lg-11">
                            <?= Html::submitButton(
                                Yii::t('app/user', 'Registration'),
                                ['class' => 'btn btn-primary', 'name' => 'registration-button']
                            );?>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
