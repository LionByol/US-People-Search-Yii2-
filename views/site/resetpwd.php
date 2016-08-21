<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Reset password - Hero Searches';
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="container" id="account-div">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="pv-20 ph-20 feature-box-2 light-gray-bg boxed shadow object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
                <div class="body">
                    <h4 class="title text-center">Reset Password</h4>
                    <p class="text-center">Please fill out the following fields to reset password</p>

                    <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-6 col-lg-offset-3\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-3 control-label'],
                    ],
                    'action' => Url::to(['site/resetpwd']),
                ]); ?>

                    <input type="hidden" name="User[email]" id="user-email" value="<?= $model->email ?>">
                    <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control']) ?>

                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-6">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-success width-100', 'name' => 'login-button']) ?>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>