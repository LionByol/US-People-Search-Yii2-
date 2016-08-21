<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Sign in - Hero Searches';
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="container" id="account-div">
    <div class="row">
        <div class="col-md-6">
            <div class="pv-20 ph-20 feature-box-2 light-gray-bg boxed shadow object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
                <div class="body">
                    <h4 class="title text-center">Sign In</h4>
                    <p class="text-center">Please fill out the following fields to sign in</p>

                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'options' => ['class' => 'form-horizontal'],
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-6 col-lg-offset-3\">{error}</div>",
                            'labelOptions' => ['class' => 'col-lg-3 control-label'],
                        ],
                    ]); ?>

                    <?= $form->field($model, 'email')->textInput(['class' => 'form-control']) ?>

                    <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control']) ?>

                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "<div class=\"col-lg-offset-3 col-lg-6\">{input} {label}</div>\n<div class=\"col-lg-6 col-lg-offset-3\">{error}</div>",
                    ]) ?>

                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-6">
                            <?= Html::submitButton('Sign in', ['class' => 'btn btn-success width-100', 'name' => 'login-button']) ?>
                        </div>
                        <div class="col-lg-offset-3 col-lg-6 margin-top-20">                        
                            <a class="text-center" href="<?= Url::to(['site/forgotpwd']) ?>">Forgot your password?</a>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="pv-20 ph-20 feature-box-2 light-gray-bg boxed shadow object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
                <div class="body">
                    <h4 class="title text-center">Not a Member?</h4>
                    <br>
                    <br>
                    <br>
                    <p class="text-center">Hero Searches members get full access to mobile numbers, emails, addresses, and family members. <br>Need more? Our background reports include criminal records, bankruptcies, and more.</p>
                    <br>
                    <br>

                    <div class="row">
                        <div class="col-lg-offset-3 col-lg-6">
                        <form action="<?= Url::to(['site/signup']) ?>">
                            <?= Html::submitButton('Get Started', ['class' => 'btn btn-primary width-100', 'name' => 'login-button']) ?>
                        </form>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>