<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link rel="shortcut icon" href="/images/logo-notext.png">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:700,400,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>

    <link href="/css/bootstrap/css/bootstrap.css" rel="stylesheet">

    <link href="/fonts/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/fonts/fontello/css/fontello.css" rel="stylesheet">

    <link href="/plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="/plugins/rs-plugin/css/settings.css" rel="stylesheet">
    <link href="/css/animations.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
    <link href="/plugins/hover/hover-min.css" rel="stylesheet">          
    <link href="/plugins/morphext/morphext.css" rel="stylesheet">
    
    <link href="/css/style.css" rel="stylesheet" >
    <link href="/css/skins/gold.css" rel="stylesheet">

    <link href="/css/custom.css" rel="stylesheet">
    <?php $this->head() ?>
</head>
<body class="no-trans front-page">
<?php $this->beginBody() ?>

<div class="page-wrapper">
        
    <div class="header-container">        
        <div class="header-top dark ">
            <div class="container">
                <div class="row">
                    <div class="col-xs-2 col-sm-5">
                        <div class="header-top-first clearfix">
                            <ul class="social-links circle small clearfix hidden-xs">
                                <li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                                <li class="skype"><a target="_blank" href="http://www.skype.com"><i class="fa fa-skype"></i></a></li>
                                <li class="linkedin"><a target="_blank" href="http://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
                                <li class="googleplus"><a target="_blank" href="http://plus.google.com"><i class="fa fa-google-plus"></i></a></li>
                                <li class="youtube"><a target="_blank" href="http://www.youtube.com"><i class="fa fa-youtube-play"></i></a></li>
                                <li class="flickr"><a target="_blank" href="http://www.flickr.com"><i class="fa fa-flickr"></i></a></li>
                                <li class="facebook"><a target="_blank" href="http://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                                <li class="pinterest"><a target="_blank" href="http://www.pinterest.com"><i class="fa fa-pinterest"></i></a></li>
                            </ul>
                            <div class="social-links hidden-lg hidden-md hidden-sm circle small">
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-alt"></i></button>
                                    <ul class="dropdown-menu dropdown-animation">
                                        <li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                                        <li class="skype"><a target="_blank" href="http://www.skype.com"><i class="fa fa-skype"></i></a></li>
                                        <li class="linkedin"><a target="_blank" href="http://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
                                        <li class="googleplus"><a target="_blank" href="http://plus.google.com"><i class="fa fa-google-plus"></i></a></li>
                                        <li class="youtube"><a target="_blank" href="http://www.youtube.com"><i class="fa fa-youtube-play"></i></a></li>
                                        <li class="flickr"><a target="_blank" href="http://www.flickr.com"><i class="fa fa-flickr"></i></a></li>
                                        <li class="facebook"><a target="_blank" href="http://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                                        <li class="pinterest"><a target="_blank" href="http://www.pinterest.com"><i class="fa fa-pinterest"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-10 col-sm-7">
                        <div id="header-top-second"  class="clearfix text-right">
                            <ul class="list-inline">
                                <li><i class="fa fa-phone pr-5 pl-10"></i>+12 123 123 123</li>
                                <li><i class="fa fa-envelope-o pr-5 pl-10"></i> <a class="header-top-second-email" href="mailto:patrickhinchy@ilfmobileapps.com">patrickhinchy@ilfmobileapps.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <header class="header fixed clearfix">            
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="header-left clearfix">
                            <div id="logo" class="logo">
                                <a href="<?= Yii::$app->homeUrl ?>"><img id="logo_img" src="/images/logo.png" alt="Hero Searches"></a>
                            </div>
                            <div class="site-slogan">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="header-right clearfix">
                        <div class="main-navigation  animated with-dropdown-buttons">
                            <nav class="navbar navbar-default" role="navigation">
                                <div class="container-fluid">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>                                        
                                    </div>
                                    <div class="collapse navbar-collapse" id="navbar-collapse-1">
                                        <?php
                                            $req = Yii::$app->requestedAction->controller->id.'/'.Yii::$app->requestedAction->id;
                                        ?>
                                        <ul class="nav navbar-nav ">                  
                                            <li class="<?php if($req == 'site/index' || $req=='') echo 'active';?> mega-menu">
                                                <a href="<?= Url::to(['site/index']) ?>">People</a>
                                            </li>
                                            <li class="<?php if($req == 'site/indexphone') echo 'active';?> mega-menu">
                                                <a href="<?= Url::to(['site/indexphone']) ?>">Reverse Phone</a>
                                            </li>
                                            <li class="<?php if($req == 'site/indexaddress') echo 'active';?> mega-menu">
                                                <a href="<?= Url::to(['site/indexaddress']) ?>">Reverse Address</a>
                                            </li>
                                            <li class="<?php if($req == 'site/indexrecord') echo 'active';?> mega-menu">
                                                <a href="<?= Url::to(['site/indexrecord']) ?>">Court Records</a>
                                            </li>
                                            <?php 
                                                if(!Yii::$app->user->isGuest)
                                                {
                                                    ?>
                                                        <li class=" mega-menu" id="menu1-1">
                                                            <a href="<?= Url::to(['admin/index']) ?>">Dashboard</a>
                                                        </li>
                                                        <li class=" mega-menu" id="menu1-1">
                                                            <a href="<?= Url::to(['admin/account']) ?>">Account Settings</a>
                                                        </li>
                                                        <li class=" mega-menu" id="menu1-1">
                                                            <a href="<?= Url::to(['site/logout']) ?>">Sign out</a>
                                                        </li>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                        <li class=" mega-menu" id="menu1-1">
                                                            <a href="<?= Url::to(['site/login']) ?>">Sign in</a>
                                                        </li>
                                                    <?php
                                                }
                                            ?>
                                        </ul>
                                        <div class="header-dropdown-buttons first-menu1">
                                            <?php
                                            if(Yii::$app->user->isGuest) {
                                                ?>
                                                <a href="<?= Url::to(['site/login']) ?>"
                                                   class="btn btn-sm hidden-xs btn-default">Sign in <i
                                                        class="fa fa-user pl-5"></i></a>
                                                <a href="<?= Url::to(['site/login']) ?>"
                                                   class="btn btn-lg visible-xs btn-block btn-default">Sign in <i
                                                        class="fa fa-user pl-5"></i></a>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>

                                                <div class="btn-group">
                                                    <a href=<?= Url::to(['admin/index']) ?> class="btn btn-default first-menu2" style="border-radius:4px 0px 0px 4px;width:auto; padding-left: 10px;padding-right: 10px;"><?= Yii::$app->user->identity->name ?></a>
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="border-radius:0px 4px 4px 0px;">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu" style="padding:10px 0 10px 0;">
                                                        <li><a href="<?= Url::to(['admin/index']) ?>"><i class="fa fa-cog pr-20"></i> Dashboard</a></li>
                                                        <li><a href="#"><i class="fa fa-user pr-20"></i> Account Settings</a></li>
                                                        <li><a href="#"><i class="fa fa-envelope pr-20"></i> Billing Information</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="<?= Url::to(['site/logout']) ?>"><i class="fa fa-sign-out pr-20"></i> Sign Out</a></li>
                                                    </ul>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <?= $content ?>

    <footer id="footer" class="clearfix">

        <!-- .footer start -->
        <!-- ================ -->
        <div class="dark-bg">
            <div class="container">
                <div class="footer-inner">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="footer-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="logo-footer" style="width: 120px; height: 80px;"><img id="logo-footer" src="/images/logo-notext.png" alt="Hero Searches"></div>
                                        <p>Hero Searches is designed to help you find and connect with others. Hero Searches is not a consumer reporting agency as defined by the Fair Credit Reporting Act. This means that you cannot use information presented in this website for evaluating a person's eligibility for employment, credit, insurance, housing, and other FCRA governed purposes.  You can learn more by accessing our Terms of Service and Privacy Policy.</p>
                                        <ul class="social-links circle animated-effect-1">
                                            <li class="facebook"><a target="_blank" href="http://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                                            <li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                                            <li class="googleplus"><a target="_blank" href="http://plus.google.com"><i class="fa fa-google-plus"></i></a></li>
                                            <li class="linkedin"><a target="_blank" href="http://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
                                            <li class="xing"><a target="_blank" href="http://www.xing.com"><i class="fa fa-xing"></i></a></li>
                                            <li class="skype"><a target="_blank" href="http://www.skype.com"><i class="fa fa-skype"></i></a></li>
                                            <li class="youtube"><a target="_blank" href="https://www.youtube.com"><i class="fa fa-youtube"></i></a></li>
                                        </ul>
                                        <ul class="list-icons">
                                            <li><i class="fa fa-map-marker pr-10 text-default" style="color:#569bc7"></i> One infinity loop, 54100</li>
                                            <li><i class="fa fa-phone pr-10 text-default" style="color:#569bc7"></i> +00 1234567890</li>
                                            <li><a href="mailto:patrickhinchy@ilfmobileapps.com"><i class="fa fa-envelope-o pr-10" style="color:#569bc7"></i>patrickhinchy@ilfmobileapps.com</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h3 class="title">My Account</h3>
                                                <div class="separator-2"></div>
                                                <nav>
                                                    <ul class="nav" style="cursor:pointer;">
                                                        <li><a class="footer-menu" href="<?= Url::to(['admin/index']) ?>">Dashboard</a></li>
                                                        <li><a class="footer-menu" href="<?= Url::to(['admin/account']) ?>">Account Settings</a></li>
                                                        <li><a class="footer-menu" href="<?= Url::to(['admin/history']) ?>">Search History</a></li>
                                                    </ul>
                                                </nav>
                                            </div>
                                            <div class="col-lg-6">
                                                <h3 class="title">Support</h3>
                                                <div class="separator-2"></div>
                                                <nav>
                                                    <ul class="nav" style="cursor:pointer;">
                                                        <li><a class="footer-menu" href="<?= Url::to(['site/privacy']) ?>">Privacy</a></li>
                                                        <li><a class="footer-menu" href="<?= Url::to(['site/termservice']) ?>">Terms of Service</a></li>
                                                        <li><a class="footer-menu" href="<?= Url::to(['site/aboutus']) ?>">About Us</a></li>
                                                        <li><a class="footer-menu" href="<?= Url::to(['site/findus']) ?>">Find Us</a></li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div id="map-canvas" style="height:200px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="footer-content">
                                <h3 class="title">Contact Us</h3>
                                <div class="separator-2"></div>
                                <br>
                                <div class="alert alert-success hidden" id="MessageSent2">
                                    We have received your message, we will contact you very soon.
                                </div>
                                <div class="alert alert-danger hidden" id="MessageNotSent2">
                                    Oops! Something went wrong please refresh the page and try again.
                                </div>                              
                                <form role="form" id="footer-form" class="margin-clear">
                                    <div class="form-group has-feedback">
                                        <label class="sr-only" for="name2">Name</label>
                                        <input type="text" class="form-control" id="contact-name" placeholder="Name" name="contact-name">
                                        <i class="fa fa-user form-control-feedback"></i>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="sr-only" for="email2">Email address</label>
                                        <input type="email" class="form-control" id="contact-email" placeholder="Enter email" name="contact-email">
                                        <i class="fa fa-envelope form-control-feedback"></i>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="sr-only" for="message2">Message</label>
                                        <textarea class="form-control" rows="6" id="contact-message" placeholder="Message" name="contact-message"></textarea>
                                        <i class="fa fa-pencil form-control-feedback"></i>
                                    </div>
                                    <input type="button" value="Send" class="margin-clear btn btn-success" onclick="onContact()">
                                    <script>
                                        function validateEmail(email)
                                        {
                                            var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
                                            return re.test(email);
                                        }                       
                                        function onContact ()
                                        {
                                            var name = document.getElementById('contact-name');
                                            var email = document.getElementById('contact-email');
                                            var message = document.getElementById('contact-message');

                                            if(email.value == '')
                                            {
                                                alert("Email should not be blank.");
                                                return;
                                            }
                                            if(!validateEmail(email.value))
                                            {
                                                alert("Email should be valid.");
                                                return;
                                            }
                                            if(message.value.length<10)
                                            {
                                                alert("Please input over 10 letters on message box.");
                                                return;
                                            }

                                            var contact_loading = document.getElementById("contact-loading");
                                            contact_loading.style.display = 'block';
                                            var contact_result = document.getElementById("contact-result");
                                            var fd = new FormData();
                                            fd.append('name', name.value);
                                            fd.append('email', email.value);
                                            fd.append('message', message.value);
                                            $.ajax({
                                                url: '<?=\yii\helpers\BaseUrl::home()?>/site/contact',
                                                cache: false,
                                                type: 'POST',
                                                data: fd,
                                                processData: false,
                                                contentType: false,
                                                success: function (data) {
                                                    if(data == 'success')
                                                    {
                                                        contact_loading.style.display = 'none';
                                                        contact_result.style.display = 'block';
                                                        name.value = "";
                                                        email.value = "";
                                                        message.value = "";
                                                    }
                                                },
                                                error: function () {
                                                    console.log("ERROR in Internet.");
                                                }
                                            });
                                        }
                                    </script>
                                    <div class="text-center" id="contact-loading" style="display: none;"></div>
                                    <p class="text-center" id="contact-result" style="display: none;color:#4cae4c;">Thank you for your contacting us.</p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="subfooter">
            <div class="container">
                <div class="subfooter-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center copyright-text">Copyright © 2015 Hero Searches by Patrick Hinchy ILF. All Rights Reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>  
    </div>
    <script type="text/javascript" src="/plugins/jquery.min.js"></script>
    <script type="text/javascript" src="/css/bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="/plugins/modernizr.js"></script>
    <script type="text/javascript" src="/plugins/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="/plugins/isotope/isotope.pkgd.min.js"></script>    
    <script type="text/javascript" src="/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>    
    <script type="text/javascript" src="/plugins/waypoints/jquery.waypoints.min.js"></script>
    <script type="text/javascript" src="/plugins/jquery.countTo.js"></script>    
    <script type="text/javascript" src="/plugins/jquery.parallax-1.1.3.js"></script>
    <script type="text/javascript" src="/plugins/jquery.validate.js"></script>
    <script type="text/javascript" src="/plugins/morphext/morphext.min.js"></script>

    <!-- Google Maps javascript  -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;key=AIzaSyAN3vuFKrAfduy0Li72bKpER-TwksBk-3k"></script>
    <script type="text/javascript" src="/js/google.map.config.js"></script>

    <script src="/plugins/vide/jquery.vide.js"></script>
    <script type="text/javascript" src="/plugins/owl-carousel/owl.carousel.js"></script>    
    <script type="text/javascript" src="/plugins/pace/pace.min.js"></script>
    <script type="text/javascript" src="/plugins/jquery.browser.js"></script>
    <script type="text/javascript" src="/plugins/SmoothScroll.js"></script>

    <script type="text/javascript" src="/js/template.js"></script>

    <script type="text/javascript" src="/js/custom.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
