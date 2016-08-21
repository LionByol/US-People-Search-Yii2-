<?php
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Account:Dashboard - Hero Searches';
?>
<h1 class="title text-center" style="font-weight: bold;">Account Settings</h1>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Personal Information</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <?php $form1 = ActiveForm::begin([
                        'id' => 'personal-form',
                        'options' => ['class' => 'form-horizontal'],
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-6 col-lg-offset-3\">{error}</div>",
                            'labelOptions' => ['class' => 'col-lg-3 control-label'],
                        ],
                        'action' => Url::to(['admin/changepersonal']),
                    ]); ?>

                    <?= $form1->field($usermdl, 'email')->textInput(['class' => 'form-control', 'disabled' => true,]) ?>

                    <?= $form1->field($usermdl, 'name')->textInput(['class' => 'form-control', 'required'=>true]) ?>

                    <div class="text-center"><?= Html::submitButton('Save', ['class' => 'btn btn-success width-100', 'name' => 'personal-save']) ?></div>
                    
                <?php ActiveForm::end(); ?>
            </div>
        </div>
	</div>
</div>

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Change Password</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <?php $form1 = ActiveForm::begin([
                        'id' => 'pwd-form',
                        'options' => ['class' => 'form-horizontal'],
                        'action' => Url::to(['admin/changepassword']),
                    ]); ?>

					<div class="form-group required">
	                    <label class="col-lg-3 control-label" for="current-pwd">Current Password</label>
	                    <div class="col-lg-6">
	                    	<input type="password" class="form-control" required="" id="current-pwd" name="currentpassword">
	                    </div>
	                    <div class="col-lg-6 col-lg-offset-3"></div>
                    </div>

                    <div class="form-group required">
	                    <label class="col-lg-3 control-label" for="new-password">New Password</label>
	                    <div class="col-lg-6">
	                    	<input type="password" class="form-control" required="" id="new-password" name="newpassword">
	                    </div>
	                    <div class="col-lg-6 col-lg-offset-3"></div>
                    </div>

                    <div class="form-group required">
	                    <label class="col-lg-3 control-label" for="confirm-pwd">Confirm Password</label>
	                    <div class="col-lg-6">
	                    	<input type="password" class="form-control" required="" id="confirm-pwd" name="crmpassword">
	                    </div>
	                    <div class="col-lg-6 col-lg-offset-3"></div>
                    </div>

                    <div class="text-center">
                    	<a class="btn btn-success with-100" name="password-change" onclick="onChangePwd()">Change</a>
                	</div>                    
                <?php ActiveForm::end(); ?>
                <script type="text/javascript">
                	function onChangePwd()
                	{
                		var curpwd = document.getElementById("current-pwd");
                		var newpwd = document.getElementById("new-password");
                		var conpwd = document.getElementById("confirm-pwd");
                		if(curpwd.value == '')
                		{
                			alert("Please input current password.");
                			return;
                		}
                		if(newpwd.value == '')
                		{
                			alert("Please input new password.");
                			return;
                		}
                		if(conpwd.value == '')
                		{
                			alert("Please input confirm password.");
                			return;
                		}

                		if(newpwd.value != conpwd.value)
                		{
                			alert("Please match new password and confirm password.");
                			return;
                		}
                		var frm = document.getElementById("pwd-form");
                		frm.submit();
                	}
                </script>
            </div>
        </div>
	</div>
</div>

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Payment Information</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <?php $form1 = ActiveForm::begin([
                        'id' => 'payment-form',
                        'options' => ['class' => 'form-horizontal'],
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-6 col-lg-offset-3\">{error}</div>",
                            'labelOptions' => ['class' => 'col-lg-3 control-label'],
                        ],
                        'action' => Url::to(['admin/changepayment']),
                    ]); ?>

                    <?= $form1->field($cardmdl, 'name')->textInput(['class' => 'form-control', 'required'=>true]) ?>

                    <?= $form1->field($cardmdl, 'number')->textInput(['class' => 'form-control', 'required'=>true]) ?>

                    <?= $form1->field($cardmdl, 'expireyear')->textInput(['class' => 'form-control', 'required'=>true]) ?>

                    <?= $form1->field($cardmdl, 'expiremonth')->textInput(['class' => 'form-control', 'required'=>true]) ?>

                    <?= $form1->field($cardmdl, 'cvv')->textInput(['class' => 'form-control', 'required'=>true]) ?>

                    <?= $form1->field($cardmdl, 'zipcode')->textInput(['class' => 'form-control', 'required'=>true]) ?>

                    <div class="text-center"><?= Html::submitButton('Save', ['class' => 'btn btn-success width-100', 'name' => 'payment-save']) ?></div>
                    
                <?php ActiveForm::end(); ?>
            </div>
        </div>
	</div>
</div>

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Billing History</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <?= GridView::widget([
                    'dataProvider' => $historymdls,
                    'columns' => [
                        [
                            'header' => 'No',
                            'class' => 'yii\grid\SerialColumn'
                        ],
                        [
                            'label' => 'Payment Type',
                            'value' => function($data){
                                if($data->kind==1)
                                    return 'Unlimited people name search';
                                else if($data->kind==2)
                                    return 'Unlimited phone search';
                                else if($data->kind==3)
                                    return 'Additional search fee';
                                return '';
                            },
                        ],
                        'cost',
                        'datepaid',
                        [
                            'header' => 'Action',
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{delete}',
                            'buttons' => [
                                'delete' => function ($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['deletepayhistory', 'id' => $model->id], [
                                        'title' => Yii::t('yii', 'Delete'),
                                        'data-confirm' => 'Are you sure you want to delete?',
                                        'data-method' => 'post',
                                        'data-pjax' => '0',
                                    ]);
                                },
                            ],
                        ],
                    ],
                    'options' => [
                        'style' => 'overflow-x:scroll;',
                    ]
                ]); ?>
            </div>
        </div>
	</div>
</div>

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Subscription</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-8" style="font-size: 18px;">
                        <strong></strong> Subscription Status:
                    </div>
                    <div class="col-md-4" style="font-size: 14px;padding-left: 20px;">
                        <?php
                        if(Yii::$app->user->identity->active_account) {
                            ?>
                            <span class="label label-info" style="font-size: 14px;">Active</span>
                            <?php
                        }else {
                            ?>
                            <span class="label label-warning" style="font-size: 14px;">Deactive</span>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8" style="font-size: 18px;">
                        Subscription Type:
                    </div>
                    <div class="col-md-4" style="font-size: 14px;padding-left: 20px;">
                        <?php
                        if($lastpaymdl->kind==1)
                            echo 'Unlimited people name search';
                        else if($lastpaymdl->kind==2)
                            echo 'Unlimited phone search';
                        else if($lastpaymdl->kind==3)
                            echo 'Additional search fee';
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8" style="font-size: 18px;">
                        Next Payment:
                    </div>
                    <div class="col-md-4" style="font-size: 14px;padding-left: 20px;">
                        $<?= $lastpaymdl->cost ?> on
                        <strong style="color: #1689ff;"><?php
                        $lastpaid = $lastpaymdl->datepaid;
                        $lastpaid=date_create($lastpaid);

                        $nextyear = (int)(date_format($lastpaid, "Y"));
                        $nextmon = (int)(date_format($lastpaid, "m"))+1;
                        $nextdate = (int)(date_format($lastpaid, "d"));
                        if($nextmon>12) {
                            $nextmon = 1;
                            $nextyear++;
                        }
                        $nextpaid = new DateTime();
                        $nextpaid->setDate($nextyear, $nextmon, $nextdate);
                        $nextpaid = $nextpaid->format('Y-m-d');
                        echo $nextpaid;
                        ?></strong>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>