<?php
namespace app\controllers;

use app\models\Card;
use app\models\GData;
use app\models\Payhistory;
use app\models\User;
use app\models\SearchHistory;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class AdminController extends Controller
{
    public $enableCsrfValidation = false;
    public $layout = "admin";

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'personsearch', 'phonesearch', 'addresssearch', 'courtsearch', 'history', 'account', 'changepersonal', 'changepayment', 'changepassword',
                            'deletepayhistory'
                ],
                'rules' => [
                    [
                        'actions' => ['index', 'personsearch', 'phonesearch', 'addresssearch', 'courtsearch', 'history', 'account', 'changepersonal', 'changepayment',
                            'changepassword', 'deletepayhistory' ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPersonsearch()
    {
        return $this->render('personsearch');
    }

    public function actionPhonesearch($error='')
    {
        if($error == '')
            return $this->render('phonesearch');
        else
            return $this->render('phonesearch', ['error'=>'Please input valid phonenumber']);
    }

    public function actionAddresssearch()
    {
        return $this->render('addresssearch');
    }

    public function actionCourtsearch()
    {
        return $this->render('courtsearch');
    }

    public function actionHistory()
    {
        $hmdls = SearchHistory::find()->where(['userid' => Yii::$app->user->identity->id])->orderBy(['search_date' => SORT_DESC])->all();
        return $this->render('history', [
            'historymdls' => $hmdls,
        ]);
    }

    public function actionAccount()
    {
        if(!Yii::$app->request->post())
        {            
            $usermdl = User::findByEmail(Yii::$app->user->identity->email);
            $cardmdl = Card::find()->where(['userid' => $usermdl->id])->one();

            //get history models
            $historyQuery = Payhistory::find()->where(['userid' => Yii::$app->user->id])->orderBy(['datepaid' => SORT_DESC]);
            $historymdls = new ActiveDataProvider([
                'query' => $historyQuery,
                'pagination' =>['pageSize' => 5],
            ]);

            //get subscription
            $lastpaymdl = Payhistory::find()->where(['userid'=>Yii::$app->user->identity->id, 'kind'=>1])->orderBy(['datepaid'=>SORT_DESC])->one();

            return $this->render('account', [
                'usermdl' => $usermdl,
                'cardmdl' => $cardmdl,
                'historymdls' => $historymdls,
                'lastpaymdl' => $lastpaymdl,
            ]);
        }
    }

    public function actionChangepersonal()
    {
        $usermdl = Yii::$app->user->identity;
        $mdl = new User();
        $mdl->load(Yii::$app->request->post());
        if($usermdl->name != '' && $usermdl->name!=$mdl->name)
        {
            $usermdl->name = $mdl->name;
            $usermdl->update(false);
        }
        return $this->redirect(['admin/account']);
    }

    public function actionChangepassword()
    {
        $usermdl = User::findByEmail(Yii::$app->user->identity->email);
        $pwd = $_POST['newpassword'];
        $usermdl->password = md5($pwd);
        $usermdl->update(false);
        return $this->redirect(['admin/account']);
    }

    public function actionChangepayment()
    {
        $cardmdl = Card::find()->where(['userid' => Yii::$app->user->identity->id])->one();
        $tmpmdl = new Card();
        if($tmpmdl->load(Yii::$app->request->post()))
        {
            $cardmdl->name = $tmpmdl->name;
            $cardmdl->number = $tmpmdl->number;
            $cardmdl->expireyear = $tmpmdl->expireyear;
            $cardmdl->expiremonth = $tmpmdl->expiremonth;
            $cardmdl->cvv = $tmpmdl->cvv;
            $cardmdl->zipcode = $tmpmdl->zipcode;
            $cardmdl->update(false);
        }
        return $this->redirect(['admin/account']);
    }

    public function actionDeletepayhistory($id)
    {
        $payhistorymdl = Payhistory::findOne($id);
        $payhistorymdl->delete(false);
        return $this->redirect(['admin/account']);
    }
}