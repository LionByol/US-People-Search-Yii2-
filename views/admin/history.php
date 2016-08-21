<?php
use yii\helpers\Url;
use app\models\JSONObject;

$this->title = 'History:Dashboard - Hero Searches';

?>

<h1 class="title text-center" style="font-weight: bold;">Search History</h1>
<h3 class="title text-center" style="margin-bottom: 40px;margin-top: 20px;">* <?= count($historymdls) ?> Recent Hero Searches History List *</h3>

<div class="row" style="margin-bottom: 40px;">
    <div class="col-md-8 col-md-offset-2">
        <div class="row">
        <?php
            foreach ($historymdls as $value) 
            {
                ?>
                <div class="col-md-6">
                    <div class="social-feed-box">
                        <div class="pull-right social-action">
                            <button class="btn-white" onclick="window.location='<?= Url::to(['search/deletehistory', 'id'=>$value->id]) ?>'" title="Remove this search">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>
                        <div class="social-avatar">
                            <div class="pull-left" style="font-size: 20px;padding-right: 10px;">
                                <?php
                                    if($value->kind==1)
                                        echo '<i class="fa fa-user"></i>';
                                    else if($value->kind==2)
                                        echo '<i class="fa fa-phone"></i>';
                                    else if($value->kind==3)
                                        echo '<i class="fa fa-home"></i>';
                                ?>
                            </div>
                            <div class="media-body">
                                <a href="<?php
                                    switch($value->kind)
                                    {
                                        case 1:
                                            echo Url::to(['search/peoplehistory', 'id'=>$value->id]);
                                            break;
                                        case 2:
                                            echo Url::to(['search/phonehistory', 'id'=>$value->id]);
                                            break;
                                        case 3:
                                            echo Url::to(['search/addresshistory', 'id'=>$value->id]);
                                            break;
                                    }
                                ?>">
                                    <?php
                                    if($value->query2 != null && $value->query2 != '')
                                    {
                                        echo $value->query1.', '.$value->query2;
                                    }
                                    else
                                    {
                                        echo $value->query1;
                                    }
                                    ?>
                                </a>
                                <small class="text-muted"><?= $value->search_date ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        ?>
        </div>
    </div>
</div>

                        