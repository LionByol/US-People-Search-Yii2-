<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Forgot password - Hero Searches';
?>
<br>
<div class="container" id="account-div">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="pv-20 ph-20 feature-box-2 light-gray-bg boxed shadow object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
                <div class="body">
                    <h4 class="title text-center">Input your email</h4>

                    <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'options' => ['class' => 'form-horizontal'],
                    ]); ?>

                    <input type="text" class="form-control" name="email" id="email" required placeholder="Email">

                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-6">
                            <?= Html::submitButton('Send', ['class' => 'btn btn-success width-100'])?>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>