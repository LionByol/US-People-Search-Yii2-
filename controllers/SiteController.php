<?php
namespace app\controllers;

use app\models\Card;
use app\models\Payhistory;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Token;


class SiteController extends Controller
{
    public $layout = "main";
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'indexrecord'],
                'rules' => [
                    [
                        'actions' => ['logout', 'indexrecord'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionIndexphone()
    {
        return $this->render('indexphone');
    }

    public function actionIndexaddress()
    {
        return $this->render('indexaddress');
    }

    public function actionIndexrecord()
    {
        return $this->render('indexrecord');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $model = new LoginForm();
        $model->load(Yii::$app->request->post());
        
        //check 1 month after pay for people search
        if($model)
        {
            $usermdl = User::findByEmail($model->email);
            if($usermdl)
            {
                $payhistorys = Payhistory::find()->where(['userid' => $usermdl->id])->andWhere(['kind' => 1])->orderBy(['datepaid' => SORT_DESC])->all();
                if(count($payhistorys)>0)
                {
                    $lastPaid = $payhistorys[0]->datepaid;
                    $lastPaid=date_create($lastPaid);
                    $lastPaid = date_format($lastPaid,"Y/m/d");
                    $currentDate = date("Y/m/d");
                    $diff = abs(strtotime($lastPaid) - strtotime($currentDate));
                    $years = floor($diff / (365*60*60*24));
                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24))+30*$months+365*$years;
                    if($days>=30)
                    {
                        return $this->redirect(['site/paypeoplesearch', 'lastpay'=>$lastPaid]);
                    }
                }
            }
        }
        if ($model&& $model->login()) {
            return $this->redirect(['admin/index']);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionPaypeoplesearch($lastpay = '')
    {
        $usermdl = new User();
        $cardmdl = new Card();
        if(Yii::$app->request->post())
        {
            $usermdl->load(Yii::$app->request->post());
            $cardmdl->load(Yii::$app->request->post());
            $usermdl = User::findByEmail($usermdl->email);

            //save user's card
            $cardmdl->userid = $usermdl->id;
            $isExistCard = Card::find()->where(['userid' => $cardmdl->userid])->andWhere(['number'=>$cardmdl->number])->exists();
            if(!$isExistCard)
            {                
                $cardmdl->save(false);
            }
            else
            {
                $tmpcard = Card::find()->where(['userid' => $cardmdl->userid])->andWhere(['number'=>$cardmdl->number])->one();
                $tmpcard->name = $cardmdl->name;
                $tmpcard->expireyear = $cardmdl->expireyear;
                $tmpcard->expiremonth = $cardmdl->expiremonth;
                $tmpcard->cvv = $cardmdl->cvv;
                $tmpcard->zipcode = $cardmdl->zipcode;
                $tmpcard->update(false);
            }

            //pay month salary and record history
            $amount = 29.95;
            if($this->stripePay($amount, $cardmdl->number, $cardmdl->expiremonth, $cardmdl->expireyear, $cardmdl->cvv, "Buy Account with $29.95 by ".$usermdl->email))
            {
                $payhistory = new Payhistory();
                $payhistory->kind = 1;
                $payhistory->cost = $amount;
                $payhistory->userid = $usermdl->id;
                $payhistory->datepaid = date("Y/m/d");
                $payhistory->save(false);
            }
            else
            {
                return $this->render('signup', [
                    'usermdl' => $usermdl,
                    'cardmdl' => $cardmdl,
                ]);
            }

            return $this->redirect(['site/login']);
        }
        else
        {
            return $this->render('paypeoplesearch', [
                'usermdl' => $usermdl,
                'cardmdl' => $cardmdl,
                'lastpay' => $lastpay,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        Yii::$app->mailer->compose()
            ->setFrom($email)
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject("Contact Message from $name")
            ->setHtmlBody("$message <br><br>$name")
            ->send();

        $headers = "From: ".$email."\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        mail(Yii::$app->params['adminEmail'], "Contact from $name", '<html><body><table class="page" bgcolor="#373737" align="center" width="800" style="color:#efefef;height:800px;"><tr><td style="width: 100px;height:100px;"><img src="http://herosearches.dev999.com/images/logo-notext.png"></td><td><center><h1 style="margin-top: 5px;margin-bottom: 5px;font-size: 42px;">Hero Searches</h1></center></td></tr><tr><td colspan="2" style="background-color:#efefef;padding:40px;vertical-align:top;"><p style="margin-top: 3px;margin-bottom: 3px;line-height: 30px;color: #2d292a;font-size: 18px;">'.$message.'<br>'.$name.'</p></td></tr><tr><td colspan="2" style="text-align:center;height:80px;vertical-align:middle;font-size:30px;">Hero Searches</td></tr></table></body></html>', $headers);
        
        echo 'success';
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $usermdl = new User();
        $cardmdl = new Card();
        if(Yii::$app->request->post())
        {
            //save user information
            $usermdl->load(Yii::$app->request->post());
            $cardmdl->load(Yii::$app->request->post());
            $pwd = $usermdl->password;
            $usermdl->password = md5($pwd);
            if(!$usermdl->save())
            {
                $usermdl->password = $pwd;
                return $this->render('signup', [
                    'usermdl' => $usermdl,
                    'cardmdl' => $cardmdl,
                ]);
            }
            $usermdl->password = $pwd;

            //save user's card
            $cardmdl->userid = $usermdl->id;
            $cardmdl->save(false);

            //signup payment
            if($usermdl->active_account == 1)
            {
                $amount = 29.95;

                if($this->stripePay($amount, $cardmdl->number, $cardmdl->expiremonth, $cardmdl->expireyear, $cardmdl->cvv, "Buy Account with $29.95 by ".$usermdl->email))
                {
                    $payhistory = new Payhistory();
                    $payhistory->kind = 1;
                    $payhistory->cost = $amount;
                    $payhistory->userid = $usermdl->id;
                    $payhistory->datepaid = date("Y/m/d");
                    $payhistory->save(false);
                }
                else
                {
                    return $this->render('signup', [
                        'usermdl' => $usermdl,
                        'cardmdl' => $cardmdl,
                    ]);
                }
            }

            //phone reverse
            if($usermdl->active_phone == 1)
            {
                $amount = 4.95;

                if($this->stripePay($amount, $cardmdl->number, $cardmdl->expiremonth, $cardmdl->expireyear, $cardmdl->cvv, "Buy Reverse Phone Account with $4.95 by ".$usermdl->email))
                {
                    $payhistory = new Payhistory();
                    $payhistory->kind = 2;
                    $payhistory->cost = $amount;
                    $payhistory->userid = $usermdl->id;
                    $payhistory->datepaid = date("Y/m/d");
                    $payhistory->save(false);
                }
                else
                {
                    return $this->render('signup', [
                        'usermdl' => $usermdl,
                        'cardmdl' => $cardmdl,
                    ]);
                }
            }
            $loginForm = new LoginForm();
            $loginForm->email = $usermdl->email;
            $loginForm->password = $usermdl->password;
            return $this->redirect(['site/login']);
        }
        else
        {
            return $this->render('signup', [
                'usermdl' => $usermdl,
                'cardmdl' => $cardmdl,
            ]);
        }
    }

    //stripe payment method
    public function stripePay($amount, $number, $exp_mon, $exp_year, $cvc, $description)
    {
        $currency = 'usd';  //'eur'

        Stripe::setApiKey(Yii::$app->params['StripeAPIKey']);
        $token = Token::create([
            "card" => [
                "number" => $number,
                "exp_month" => $exp_mon,
                "exp_year" => $exp_year,
                "cvc" => $cvc,
            ],
        ]);
        try
        {
            Charge::create([
                "amount" => (int)($amount) * 100,
                "currency" => $currency,
                "source" => $token,
                "description" => $description,
            ]);
            return true;
        } catch(\Stripe\Error\Card $e) {
            return false;
        }
    }

    public function actionForgotpwd()
    {
        if(Yii::$app->request->post())
        {
            $email = $_POST['email'];
            $link = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http'.'://'.$_SERVER['SERVER_NAME'].Url::to(['site/confirm']).'?e='.sha1($email);
            Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo($email)
                ->setSubject('Forget Password')
                ->setHtmlBody('<b>Hello, You should verify with your email.</b><br>Please click this link.<br><a href="'.$link.'">Click HERE.</a><br>Hero Searches Support')
                ->send();

            $headers = "From: ".Yii::$app->params['adminEmail']."\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            mail($email, 'Forget Password', '<html><body><table class="page" bgcolor="#373737" align="center" width="800" style="color:#efefef;height:800px;"><tr><td style="width: 100px;height:100px;"><img src="http://herosearches.dev999.com/images/logo-notext.png"></td><td><center><h1 style="margin-top: 5px;margin-bottom: 5px;font-size: 42px;">Hero Searches</h1></center></td></tr><tr><td colspan="2" style="background-color:#efefef;padding:40px;vertical-align:top;"><p style="margin-top: 3px;margin-bottom: 3px;line-height: 30px;color: #2d292a;font-size: 18px;">Hello, You should verify with your email.<br>To reset password, Please click <a href="'.$link.'">HERE</a>.<br>Hero Searches Support</p></td></tr><tr><td colspan="2" style="text-align:center;height:80px;vertical-align:middle;font-size:30px;">Hero Searches</td></tr></table></body></html>', $headers);
            return $this->render('sentemail');
        }
        else
            return $this->render('forgotpwd');
    }

    public function actionConfirm($e)
    {
        $usrmdls = User::find()->all();
        $isexist = false;
        $userid = 0;
        foreach($usrmdls as $mdl)
        {
            if($e == sha1($mdl->getAttribute('email')))
            {
                $isexist = true;
                $userid = $mdl->getAttribute('id');
                break;
            }
        }
        if($isexist)
        {
            $model = User::findOne(['id' => $userid]);
            $model->setAttribute('password', '');
            return $this->render('resetpwd', ['model' => $model]);
        }
        else
        {
            return $this->redirect(['index']);
        }
    }

    public function actionResetpwd()
    {
         if(Yii::$app->request->isPost)
        {
            $model = User::find()->where(['email'=>$_POST['User']['email']])->one();
            $model->password = md5($_POST['User']['password']);
            $model->update(false);
        }
        return $this->redirect(['site/login']);
    }
}
