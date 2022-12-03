<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;

AppAsset::register($this);

$baseUrl = Url::base() . '/academic';

$c = Yii::$app->controller->id;
$a = Yii::$app->controller->action->id;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php $this->registerCsrfMetaTags() ?>

    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="<?= $baseUrl ?>/fonts/icomoon/style.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/jquery-ui.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/aos.css">
    <link href="<?= $baseUrl ?>/css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/style.css">
    <style>
        .has-error .help-block {
            color: #c7254e;
        }

        .center {
            margin: auto;
            text-align: center;
            vertical-align: middle;
        }

        /*Floating CSS Start*/
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }

        @keyframes fade-in-up {
            0% {
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .stuck {
            position: fixed;
            bottom: 50px;
            right: 20px;
            transform: translateY(100%);
            width: 260px;
            height: 145px;
            animation: fade-in-up .25s ease forwards;
            z-index: 999;
        }

        /*Floating CSS End*/

        @keyframes example {
            0% {
                background-color: red;
            }

            25% {
                background-color: #ff7037;
            }

            50% {
                background-color: red;
            }

            100% {
                background-color: #ff7037;
            }
        }

        p.scrolldown {
            width: 200px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            border: 1px solid;
            background: #ff7037;
            position: fixed;
            right: 75px;
            color: #fff;
            -webkit-animation-name: example;
            /* Safari 4.0 - 8.0 */
            -webkit-animation-duration: 4s;
            /* Safari 4.0 - 8.0 */
            animation-name: example;
            animation-duration: 2s;
        }
    </style>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <?php $this->beginBody() ?>

    <div class="site-wrap">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>


        <div class="py-2 bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-9 d-none d-lg-block">
                        <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> Have a questions?</a>
                        <a href="#" class="small mr-3"><span class="icon-phone2 mr-2"></span> +60 13-702 4102</a>
                        <a href="#" class="small mr-3"><span class="icon-envelope-o mr-2"></span> info@rochat.id</a>
                    </div>
                    <div class="col-lg-3 text-right">
                        <?php if (Yii::$app->user->isGuest) : ?>

                            <a href="<?= Url::to(['site/login']) ?>" class="small mr-3"><span class="icon-unlock-alt"></span> Log In</a>
                            <a href="<?= Url::to(['site/register']) ?>" class="small btn btn-primary px-4 py-2 rounded-0"><span class="icon-users"></span> Register</a>
                        <?php else : ?>
                            <a href="<?= Url::to(['dashboard/index']) ?>" class="small btn btn-primary px-4 py-2 rounded-0"><span class="fa fa-hdd"></span> Dashboard</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

            <div class="container">
                <div class="d-flex align-items-center">
                    <div class="site-logo">
                        <a href="/" class="d-block">
                        <img src="<?= $baseUrl ?>/images/kkm_70.png" alt="Image" class="img-fluid">
                        </a>
                    </div>
                    <div class="mr-auto">
                        <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                                <li <?php if ($c == 'site' && $a == 'index') : ?> class="active" <?php endif; ?>>
                                    <a href="/" class="nav-link text-left">Home</a>
                                </li>

                                <!-- <li <?php if ($c == 'site' && $a == 'admissions') : ?> class="active" <?php endif; ?>>
                                    <a href="<?= Url::to(['site/admissions']) ?>" class="nav-link text-left">Admissions</a>
                                </li> -->

                                <!-- <li class="has-children">
                                    <a href="courses" class="nav-link text-left">Courses</a>
                                    <ul class="dropdown">
                                        <li><a href="<?= Url::to(['site/courses']) ?>">Free Courses</a></li>
                                        <li><a href="<?= Url::to(['site/courses']) ?>">Paid Courses</a></li>
                                    </ul>
                                </li> -->
                                <li <?php if ($c == 'site' && $a == 'about') : ?> class="active" <?php endif; ?>>
                                    <a href="<?= Url::to(['site/about']) ?>" class="nav-link text-left">About Us</a>
                                </li>
                                <li <?php if ($c == 'site' && $a == 'contact') : ?> class="active" <?php endif; ?>>
                                    <a href="<?= Url::to(['site/contact']) ?>" class="nav-link text-left">Contact</a>
                                </li>

                                <?php if (!Yii::$app->user->isGuest) : ?>
                                    <li>
                                        <a href="javascript:document.forms['logout-form'].submit();" class="nav-link text-left">Logout</a>
                                        <form method="post" name="logout-form" action="<?= Url::to(['site/logout']) ?>">
                                            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                                        </form>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            </ul>
                        </nav>

                    </div>
                    <!-- <div class="ml-auto">
                        <div class="social-wrap">
                            <a href="#"><span class="icon-facebook"></span></a>
                            <a href="#"><span class="icon-twitter"></span></a>
                            <a href="#"><span class="icon-linkedin"></span></a>

                            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a>
                        </div>
                    </div> -->

                </div>
            </div>

        </header>


        <?= $content ?>


        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <img src="<?= $baseUrl ?>/images/kkm_120.png" alt="Image" class="img-fluid">
                        </p>

                    </div>
                    <div class="col-lg-3">
                        <h3 class="footer-heading"><span>Our Supporter</span></h3>
                        <ul class="list-unstyled">
                            <li><a href="https://www.moh.gov.my/">KKM</a></li>
                            <li><a href="https://www.utm.my/">UTM</a></li>
                        </ul>
                    </div>
                    <!-- <div class="col-lg-3">
                        <h3 class="footer-heading"><span>Our SUppor</span></h3>
                        <ul class="list-unstyled">
                            <li><a href="#">UTM</a></li>
                        </ul>
                    </div> -->
                    <div class="col-lg-3">
                        <h3 class="footer-heading"><span>Contact</span></h3>
                        <ul class="list-unstyled">
                            <li><a href="#">Help Center</a></li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="copyright">
                            <p>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- .site-wrap -->

    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#51be78" />
        </svg></div>

    <script src="<?= $baseUrl ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= $baseUrl ?>/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="<?= $baseUrl ?>/js/jquery-ui.js"></script>
    <script src="<?= $baseUrl ?>/js/popper.min.js"></script>
    <script src="<?= $baseUrl ?>/js/bootstrap.min.js"></script>
    <script src="<?= $baseUrl ?>/js/owl.carousel.min.js"></script>
    <script src="<?= $baseUrl ?>/js/jquery.stellar.min.js"></script>
    <script src="<?= $baseUrl ?>/js/jquery.countdown.min.js"></script>
    <script src="<?= $baseUrl ?>/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= $baseUrl ?>/js/jquery.easing.1.3.js"></script>
    <script src="<?= $baseUrl ?>/js/aos.js"></script>
    <script src="<?= $baseUrl ?>/js/jquery.fancybox.min.js"></script>
    <script src="<?= $baseUrl ?>/js/jquery.sticky.js"></script>
    <script src="<?= $baseUrl ?>/js/jquery.mb.YTPlayer.min.js"></script>




    <script src="<?= $baseUrl ?>/js/main.js"></script>
    <script>
        /*Floating Code for Iframe Start*/
        if (jQuery('iframe[src*="https://www.youtube.com/embed/"],iframe[src*="https://player.vimeo.com/"],iframe[src*="https://player.vimeo.com/"]').length > 0) {
            /*Wrap (all code inside div) all vedio code inside div*/
            jQuery('iframe[src*="https://www.youtube.com/embed/"],iframe[src*="https://player.vimeo.com/"]').wrap("<div class='iframe-parent-class'></div>");
            /*main code of each (particular) vedio*/
            jQuery('iframe[src*="https://www.youtube.com/embed/"],iframe[src*="https://player.vimeo.com/"]').each(function(index) {

                /*Floating js Start*/
                var windows = jQuery(window);
                var iframeWrap = jQuery(this).parent();
                var iframe = jQuery(this);
                var iframeHeight = iframe.outerHeight();
                var iframeElement = iframe.get(0);
                windows.on('scroll', function() {
                    var windowScrollTop = windows.scrollTop();
                    var iframeBottom = iframeHeight + iframeWrap.offset().top;
                    //alert(iframeBottom);

                    if ((windowScrollTop > iframeBottom)) {
                        iframeWrap.height(iframeHeight);
                        iframe.addClass('stuck');
                        jQuery(".scrolldown").css({
                            "display": "none"
                        });
                    } else {
                        iframeWrap.height('auto');
                        iframe.removeClass('stuck');
                    }
                });
                /*Floating js End*/
            });
        }

        /*Floating Code for Iframe End*/
    </script>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>