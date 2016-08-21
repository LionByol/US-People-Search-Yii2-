<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\Payhistory;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="/images/logo-notext.png">

    <link href="/backendtheme/css/bootstrap.min.css" rel="stylesheet">
    <link href="/backendtheme/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="/backendtheme/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="/backendtheme/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="/backendtheme/css/animate.css" rel="stylesheet">
    <link href="/backendtheme/css/style.css" rel="stylesheet">
    <link href="/backendtheme/css/custom.css" rel="stylesheet">

    <!-- Google Map -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;key=AIzaSyAN3vuFKrAfduy0Li72bKpER-TwksBk-3k"></script>

</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <a href="<?= Url::to(['site/index']) ?>"><img alt="hero searches" src="/images/logo-notext.png" /></a>
                             </span>
                            <a class="dropdown-toggle" href="<?= Url::to(['admin/index']) ?>">
                                <span class="clear">
                                    <span class="block m-t-xs"> 
                                        <strong class="font-bold"><?= Yii::$app->user->identity->name ?></strong>
                                    </span>
                                </span>
                            </a>
                            <a class="dropdown-toggle" href="<?= Url::to(['admin/index']) ?>">
                                <span class="clear">
                                    <span class="block m-t-xs"> 
                                        Last Paid:<strong class="font-bold">
                                            <?php
                                            $lastpaymdl1 = Payhistory::find()->where(['userid'=>Yii::$app->user->identity->id, 'kind'=>1])->orderBy(['datepaid'=>SORT_DESC])->one();
                                            echo $lastpaymdl1->datepaid;
                                            ?></strong>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="logo-element">
                            <a href="<?= Url::to(['site/index']) ?>"><img alt="hero searches" src="/images/logo-notext.png" style="width:100%;height:100%;" /></a>
                        </div>
                    </li>
                    <?php
                        $req = Yii::$app->requestedAction->controller->id.'/'.Yii::$app->requestedAction->id;
                    ?>
                    <li class="<?php if($req=='admin/index'){ ?>special_link<?php } ?>">
                        <a href="<?= Url::to(['admin/index']) ?>"><i class="fa fa-laptop"></i> <span class="nav-label">Home</span></a>
                    </li>
                    <li class="<?php if($req=='admin/personsearch'){ ?>special_link<?php } ?>">
                        <a href="<?= Url::to(['admin/personsearch']) ?>"><i class="fa fa-user"></i> <span class="nav-label">Person Search</span>  </a>
                    </li>
                    <li class="<?php if($req=='admin/phonesearch'){ ?>special_link<?php } ?>">
                        <a href="<?= Url::to(['admin/phonesearch']) ?>"><i class="fa fa-phone-square"></i> <span class="nav-label">Reverse Phone</span></a>
                    </li>
                    <li class="<?php if($req=='admin/addresssearch'){ ?>special_link<?php } ?>">
                        <a href="<?= Url::to(['admin/addresssearch']) ?>"><i class="fa fa-globe"></i> <span class="nav-label">Reverse Address</span></a>
                    </li>
                    <li class="<?php if($req=='admin/courtsearch'){ ?>special_link<?php } ?>">
                        <a href="<?= Url::to(['admin/courtsearch']) ?>"><i class="fa fa-bank"></i> <span class="nav-label">Court Search </span><span class="label label-info pull-right">62</span></a>
                    </li>
                    <li class="<?php if($req=='admin/history'){ ?>special_link<?php } ?>">
                        <a href="<?= Url::to(['admin/history']) ?>"><i class="fa fa-database"></i> <span class="nav-label">Search History</span></a>
                    </li>
                    <li class="<?php if($req=='admin/account'){ ?>special_link<?php } ?>">
                        <a href="<?= Url::to(['admin/account']) ?>"><i class="fa fa-gear"></i> <span class="nav-label">My Account</span></a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['site/index']) ?>"><i class="fa fa-arrow-circle-left"></i> <span class="nav-label">Close</span></a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['site/logout']) ?>"><i class="fa fa-sign-out"></i><span class="nav-label">Sign Out</span></a>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                </nav>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <?= $content ?>
            </div>
            <div class="footer">
                <div>
                    Copyright © 2015 Hero Searches by Patrick Hinchy ILF. All Rights Reserved
                    <a href="mailto:patrickhinchy@ilfmobileapps.com" style="color: #f3f3f4;float: right;"><i class="fa fa-envelope-o"></i>&nbsp; patrickhinchy@ilfmobileapps.com</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="/backendtheme/js/jquery-2.1.1.js"></script>
    <script src="/backendtheme/js/bootstrap.min.js"></script>
    <script src="/backendtheme/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/backendtheme/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="/backendtheme/js/plugins/flot/jquery.flot.js"></script>
    <script src="/backendtheme/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="/backendtheme/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="/backendtheme/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/backendtheme/js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="/backendtheme/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="/backendtheme/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/backendtheme/js/inspinia.js"></script>
    <script src="/backendtheme/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="/backendtheme/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="/backendtheme/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="/backendtheme/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="/backendtheme/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="/backendtheme/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="/backendtheme/js/plugins/toastr/toastr.min.js"></script>


    <script>
        $(document).ready(function() {

            var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
            ];
            var data2 = [
                [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
            ];
            $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: "#d5d5d5",
                            borderWidth: 1,
                            color: '#d5d5d5'
                        },
                        colors: ["#1ab394", "#1C84C6"],
                        xaxis:{
                        },
                        yaxis: {
                            ticks: 4
                        },
                        tooltip: false
                    }
            );

            var doughnutData = [
                {
                    value: 300,
                    color: "#a3e1d4",
                    highlight: "#1ab394",
                    label: "App"
                },
                {
                    value: 50,
                    color: "#dedede",
                    highlight: "#1ab394",
                    label: "Software"
                },
                {
                    value: 100,
                    color: "#A4CEE8",
                    highlight: "#1ab394",
                    label: "Laptop"
                }
            ];

            var doughnutOptions = {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 45, // This is 0 for Pie charts
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false
            };

            var polarData = [
                {
                    value: 300,
                    color: "#a3e1d4",
                    highlight: "#1ab394",
                    label: "App"
                },
                {
                    value: 140,
                    color: "#dedede",
                    highlight: "#1ab394",
                    label: "Software"
                },
                {
                    value: 200,
                    color: "#A4CEE8",
                    highlight: "#1ab394",
                    label: "Laptop"
                }
            ];

            var polarOptions = {
                scaleShowLabelBackdrop: true,
                scaleBackdropColor: "rgba(255,255,255,0.75)",
                scaleBeginAtZero: true,
                scaleBackdropPaddingY: 1,
                scaleBackdropPaddingX: 1,
                scaleShowLine: true,
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false
            };

        });
    </script>
</body>
</html>
