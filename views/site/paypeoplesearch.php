<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Pay for People Search - Hero Searches';
?>
<br>
<div class="container" id="signup-div">
	<h3 class="text-center">Get the most powerful people data.</h3>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-info" role="alert">
                <p>Your last payment for people search: &nbsp;<strong><?= $lastpay ?></strong>.</p><br>
                <p>You should pay <strong>$29.95</strong>/month for searching people information.</p>
            </div>
        </div>
    </div>
	<br>
	<?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-lg-9 col-lg-offset-3\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-3 control-label'],
        ],
    ]); ?>
    <div class="row">
        <div class="col-md-4">
        	<div class="pv-20 ph-20 feature-box-2 light-gray-bg boxed shadow object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
                <div class="body" style="margin-left: 60px;">
                	<h4 class="title text-center">Personal Information</h4><br>

                    <?= $form->field($usermdl, 'email')->textInput(['class' => 'form-control']) ?>

                    <?= $form->field($usermdl, 'password')->passwordInput(['class' => 'form-control']) ?>

                    <div class="controls checkbox-inline">
                    	<input type="checkbox" id='agree' name="agree" required=""><label for="agree">You agree to Hero Searches' Terms of Service and Privacy Policy. You understand that Hero Searches is not a consumer reporting agency, and will not use Hero Searches to determine an individual’s eligibility for employment, credit, housing, or any other purpose covered under Fair Credit Reporting Act (FCRA).</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
        	<div class="pv-20 ph-20 feature-box-2 light-gray-bg boxed shadow object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
        		<div class="body" style="margin-left: 20px;">
	        		<h4 class="title text-center">Payment Information</h4>
	        		<br>
                    <div class="row">
                        <div class="col-lg-10 col-lg-offset-1" style="padding-bottom:20px;">
                            <center><img src="/images/stripe.png"></center>
                        </div>
                        <div class="col-lg-10 col-lg-offset-1">
                            <?= $form->field($cardmdl, 'number')->textInput(['class' => 'form-control', 'placeholder'=>'XXXX XXXX XXXX XXXX']) ?>
                        </div>
                        <div class="col-lg-10 col-lg-offset-1">
                            <?= $form->field($cardmdl, 'expiremonth')->textInput(['class' => 'form-control', 'placeholder'=>'09']) ?>
                        </div>
                        <div class="col-lg-10 col-lg-offset-1">
                            <?= $form->field($cardmdl, 'expireyear')->textInput(['class' => 'form-control', 'placeholder'=>'2016',]) ?>
                        </div>
                        <div class="col-lg-10 col-lg-offset-1">
                            <?= $form->field($cardmdl, 'cvv')->textInput(['class' => 'form-control', 'placeholder'=>'123']) ?>
                        </div>
                        <div class="col-lg-10 col-lg-offset-1">
                            <?= $form->field($cardmdl, 'zipcode')->textInput(['class' => 'form-control']) ?>
                        </div>
                        <div class="col-lg-6 col-lg-offset-4">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-success width-100', 'name' => 'signup-button']) ?>
                        </div>
                    </div>
        		</div>
        	</div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>