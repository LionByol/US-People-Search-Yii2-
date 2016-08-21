<?php
namespace app\controllers;

use app\models\Card;
use app\models\GData;
use app\models\User;
use app\models\SearchHistory;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SearchController extends Controller
{
    public $enableCsrfValidation = false;
    public $layout = "admin";

     public function behaviors()
     {
         return [
             'access' => [
                 'class' => AccessControl::className(),
                 'only' => ['streetaddress', 'phonenumber', 'peoplename', 'person', 'deletehistory', 'peoplehistory', 'phonehistory', 'addresshistory'],
                 'rules' => [
                     [
                         'actions' => ['streetaddress', 'phonenumber', 'peoplename', 'person', 'deletehistory', 'peoplehistory', 'phonehistory', 'addresshistory'],
                         'allow' => true,
                         'roles' => ['@'],
                     ],
                 ],
             ],
         ];
     }

    public function actionPeoplehistory($id)
    {
        $sHis = SearchHistory::findOne($id);
        return $this->render('persons', [
            'data' => $sHis->result,
            'query_name' => $sHis->query1,
            'query_address' => $sHis->query2,
            'history_id' =>$id,
        ]);
    }
    public function actionPhonehistory($id)
    {
        $sHis = SearchHistory::findOne($id);

        return $this->render('phone', [
            'data' => $sHis->result,
            'query_number' => $sHis->query1,
            'history_id' =>$id,
        ]);
    }
    public function actionAddresshistory($id)
    {
        
    }

    public function actionDeletehistory($id)
    {
        $sHis = SearchHistory::findOne($id);
        $sHis->delete(false);
        return $this->redirect(['admin/history']);
    }
     
    public function actionPerson($historyid=1, $id=1)
    {
        $resultHistory = SearchHistory::findOne($historyid);
        return $this->render('person', [
            'data' => $resultHistory->result,
            'id' => $id,
        ]);
    }

    public function actionStreetaddress()
    {
        $API = Yii::$app->params['searchapi'];
        $street = strtolower($_POST['street']);
        $address = strtolower($_POST['address']);   

        $query = "https://proapi.whitepages.com/2.2/location.json?";

        //analyze address
        $state_shortcode = '';
        $state_name = '';
        $city = '';
        $postalcode = '';
        $street_line1 = '';
        if($address != '')
        {
            if($address != '')      //address is not null
            {
                $address = explode(',', $address);
                foreach ($address as $value1)
                {
                    $addr = trim($value1);
                    foreach (GData::$states as $key=>$value)
                    {
                        if($addr == $key)
                        {
                            $state_shortcode = $key;
                            $state_name = $value;
                            break;
                        }
                        else if($addr == $value)
                        {
                            $state_shortcode = $key;
                            $state_name= $value;
                            break;
                        }
                    }
                    if($state_shortcode != '')
                        break;
                }
                
                if($state_name != '')
                {
                    foreach ($address as $addr)
                    {
                        foreach(GData::$cities[$state_name] as $val)
                        {
                            if($addr == $val)
                            {
                                $city = $val;
                                break;
                            }
                        }
                        if($city != '')
                            break;
                    }
                }
                else
                {
                    foreach ($address as $addr)
                    {
                        foreach (GData::$cities as $value) {
                            foreach ($value as $val) {
                                if($addr == $val)
                                {
                                    $city = $val;
                                    break;
                                }
                            }
                            if($city != '')
                                break;
                        }
                        if($city != '')
                            break;
                    }   
                }

                //get zip or postal code
                $addarr = [];
                foreach ($address as $value1)
                {
                    $addarr[] = trim($value1);
                }
                if (($key = array_search($city, $addarr)) !== false)
                {
                    unset($addarr[$key]);
                }
                if(($key = array_search($state_shortcode, $addarr)) !== false)
                {
                    unset($addarr[$key]);
                }
                if(($key = array_search($state_name, $addarr)) !== false)
                {
                    unset($addarr[$key]);
                }
                if(count($addarr)>=1)
                {
                    $addarr = array_values($addarr);
                    $postalcode = $addarr[0];
                }
                
                if($postalcode != '')
                {
                    $query .= "&postal_code=$postalcode";
                }
                
                //get city
                if($city != '')
                {
                    $city = str_replace(" ", "+", $city);
                    $query .= "&city=$city";
                }
            }
        }

        //analyze street information
        $strt = explode(',', $street);
        if(count($strt)>=2)
        {
            if($state_shortcode == '')               //state code is ''? -> get state code
            {
                foreach($strt as $value)
                {
                    $tmp = trim($value);
                    foreach (GData::$states as $key=>$value1)
                    {
                        if($key == $tmp)
                        {
                            $state_shortcode = $key;
                            $state_name = $value1;
                            break;
                        }
                    }
                    if($state_shortcode != '')
                        break;
                }
            }
        }

        //get street line 1
        foreach ($strt as $value)
        {
            $strt[] = trim($value);
        }
        if(($key = array_search($state_shortcode, $strt)) !== false)
        {
            unset($strt[$key]);
        }
        if(count($strt)>=1)
        {
            $strt = array_values($strt);
            $street_line1 = str_replace(' ', '+', $strt[0]);
        }

        //get state
        if($state_shortcode != '')
        {
            $state_shortcode = str_replace(" ", "+", $state_shortcode);
            $query .= "&state_code=$state_shortcode";
        }
        //get street line 1
        if($street_line1 != '')
        {
            $query .= "&street_line_1=$street_line1";
        }
        echo $query;
    }

    public function actionPhonenumber()
    {
        $API = Yii::$app->params['searchapi'];
        $phonenumber = $_POST['phonenumber'];
        $phonenumber = str_replace('-', '', $phonenumber);
		$phonenumber = str_replace(' ', '', $phonenumber);
        $query = "https://proapi.whitepages.com/2.2/phone.json?phone_number=$phonenumber&api_key=$API";
        $result = $this->httpGet($query);

        $phonedata = json_decode($result, true);
        if($phonedata['results'][0]['is_valid'] == false)
        {
            echo 'no';
            return $this->redirect(['admin/phonesearch', 'error' => 'true']);
        }
        else
        {
            //search history
            $searchHistory = SearchHistory::find()->where(['query1'=>$phonenumber])->andWhere(['query2'=>''])->andWhere(['userid'=>Yii::$app->user->identity->id])->one();
            if($searchHistory == null)
            {
                $searchHistory = new SearchHistory();
                $searchHistory->result = $result;
                $searchHistory->kind = 2;
                $searchHistory->search_date = date("Y-m-d H:i:s");
                $searchHistory->userid = Yii::$app->user->identity->id;
                $searchHistory->query1 = $phonenumber;
                $searchHistory->query2 = '';
                $searchHistory->save(false);
            }
            else
            {
                $searchHistory->search_date = date("Y-m-d H:i:s");
                $searchHistory->update(false);
            }

            return $this->render('phone', [
                'data' => $result,
                'query_number' => $phonenumber,
                'history_id' =>$searchHistory->id,
            ]);
        }
    }

    public function actionPeoplename()
    {
        $API = Yii::$app->params['searchapi'];
        $name = $_POST['name'];
        $address = strtolower($_POST['address']);
        $query_name = $name;
        $query_address = $address;

        //interpret address
        $name = str_replace(" ", "+", $name);       //search people name
        $query = "https://proapi.whitepages.com/2.2/person.json?name=$name";

        $state_shortcode = '';
        $state_name = '';
        $city = '';
        $postalcode = '';
        if($address != '')      //address is not null
        {
            $address = explode(',', $address);
            foreach ($address as $value1)
            {
                $addr = trim($value1);
                foreach (GData::$states as $key=>$value)
                {
                    if($addr == $key)
                    {
                        $state_shortcode = $key;
                        $state_name = $value;
                        break;
                    }
                    else if($addr == $value)
                    {
                        $state_shortcode = $key;
                        $state_name= $value;
                        break;
                    }
                }
                if($state_shortcode != '')
                    break;
            }
            
            if($state_name != '')
            {
                foreach ($address as $addr)
                {
                    foreach(GData::$cities[$state_name] as $val)
                    {
                        if($addr == $val)
                        {
                            $city = $val;
                            break;
                        }
                    }
                    if($city != '')
                        break;
                }
            }
            else
            {
                foreach ($address as $addr)
                {
                    foreach (GData::$cities as $value) {
                        foreach ($value as $val) {
                            if($addr == $val)
                            {
                                $city = $val;
                                break;
                            }
                        }
                        if($city != '')
                            break;
                    }
                    if($city != '')
                        break;
                }   
            }

            //get zip or postal code
            $addarr = [];
            foreach ($address as $value1)
            {
                $addarr[] = trim($value1);
            }
            if (($key = array_search($city, $addarr)) !== false)
            {
                unset($addarr[$key]);
            }
            if(($key = array_search($state_shortcode, $addarr)) !== false)
            {
                unset($addarr[$key]);
            }
            if(($key = array_search($state_name, $addarr)) !== false)
            {
                unset($addarr[$key]);
            }
            if(count($addarr)>=1)
            {
                $addarr = array_values($addarr);
                $postalcode = $addarr[0];
            }
            
            if($postalcode != '')
            {
                $query .= "&postal_code=$postalcode";
            }
            
            //get city
            if($city != '')
            {
                $city = str_replace(" ", "+", $city);
                $query .= "&city=$city";
            }
            //get state
            if($state_shortcode != '')
            {
                $state_shortcode = str_replace(" ", "+", $state_shortcode);
                $query .= "&state_code=$state_shortcode";
            }
        }

        $query .= "&api_key=$API";
        $result = $this->httpGet($query);

        //search history
        $searchHistory = SearchHistory::find()->where(['query1'=>$query_name])->andWhere(['query2'=>$query_address])->andWhere(['userid'=>Yii::$app->user->identity->id])->one();
        if($searchHistory == null)
        {
            $searchHistory = new SearchHistory();
            $searchHistory->result = $result;
            $searchHistory->kind = 1;
            $searchHistory->search_date = date("Y-m-d H:i:s");
            $searchHistory->userid = Yii::$app->user->identity->id;
            $searchHistory->query1 = $query_name;
            $searchHistory->query2 = $query_address;
            $searchHistory->save(false);
        }
        else
        {
            $searchHistory->search_date = date("Y-m-d H:i:s");
            $searchHistory->update(false);
        }

        return $this->render('persons', [
            'data' => $result,
            'query_name' => $query_name,
            'query_address' => $query_address,
            'history_id' =>$searchHistory->id,
        ]);
    }

    function httpGet($url)
    {
        $ch = curl_init();  
     
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    //  curl_setopt($ch,CURLOPT_HEADER, false);
    
        $output=curl_exec($ch);
     
        curl_close($ch);
        return $output;
    }
}
