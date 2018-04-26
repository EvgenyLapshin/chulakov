<?php
/**
 * @var SiteController $this
 * @var Page $model
 */

$socialList = $model->getBlocks(3);

$startDate = new DateTime($model->startDate);
$currentDate = new DateTime(date('Y-m-d'));
$interval = $startDate->diff($currentDate);
$countDays = $interval->format('%a');
?>

<!DOCTYPE html>
<html lang="ru-ru" class="no-js">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?= app()->getBaseUrl(true); ?>"/>

    <title><?= app()->name; ?></title>

    <!-- Open Graph -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?= $this->metaTitle ?>"/>
    <meta property="og:description" content="<?= $this->metaDescription ?>"/>
    <meta property="og:image" content="<?= $this->metaImage ?>"/>
    <meta property="og:url" content="<?= $this->metaUrl ?>"/>

    <meta name="title" content="<?= $this->metaTitle ?>"/>
    <meta name="description" content="<?= $this->metaDescription ?>"/>
    <meta name="keywords" content="<?= $this->metaKeywords ?>"/>

    <link rel="image_src" href="<?= $this->metaImage ?>"/> <!-- Для ВКонтакте-->

    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="img/favicon.png">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="img/favicon-retina-ipad.png">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="img/favicon-retina-iphone.png">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="img/favicon-standard-ipad.png">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="img/favicon-standard-iphone.png">

    <!-- ============== Resources style ============== -->
    <link rel="stylesheet" href="/client_side/coming_soon/css/style-map-variant.css"/>

    <!-- Modernizr runs quickly on page load to detect features -->
    <script src="/client_side/coming_soon/js/modernizr.custom.js"></script>

    <!-- * Libraries jQuery, Easing and Bootstrap - Be careful to not remove them * -->
    <script src="/client_side/coming_soon/js/jquery.min.js"></script>
    <script src="/client_side/coming_soon/js/jquery.easings.min.js"></script>
    <script src="/client_side/coming_soon/js/bootstrap.min.js"></script>
</head>

<body>

<?php if ($model->backgroundType == 'video') { ?>
    <!-- YouTube link -->
    <a id="bgndVideo" class="player" data-property="{videoURL:'<?= $model->backgroundVideo; ?>',containment:'body',autoPlay:true, mute:true, startAt:0, stopAt:0, opacity:1}"></a>

    <!-- YouTube plugin -->
    <script src="/client_side/coming_soon/js/jquery.mb.YTPlayer.js"></script>

    <!-- OPEN - Player control -->
    <nav id="player-nav">
        <ul>

            <li data-toggle="tooltip" data-placement="top" data-title="Старт" data-trigger="hover">
                <a onclick="$('#bgndVideo').playYTP()"><i class="fa fa-play"></i></a>
            </li>

            <li data-toggle="tooltip" data-placement="top" data-title="Пауза" data-trigger="hover">
                <a onclick="$('#bgndVideo').pauseYTP()"><i class="fa fa-pause"></i></a>
            </li>

            <li class="full-play" data-toggle="tooltip" data-placement="top" data-title="Fullscreen" data-trigger="hover">
                <a class="expand-player"><i class="fa fa-expand"></i></a>
            </li>

            <li class="comp-play display-none" data-toggle="tooltip" data-placement="top" data-title="Reduce" data-trigger="hover">
                <a class="compress-player"><i class="fa fa-compress"></i></a>
            </li>

        </ul>
    </nav> <!-- CLOSE - Player control -->

<?php } else { ?>

    <!-- Static image -->
    <div class="static-image" data-src="<?= $model->getFileUrl('backgroundImage', 'basic'); ?>"></div>

    <!-- Static-image plugin -->
    <script src="/client_side/coming_soon/js/jquery.static-image.js"></script>

<?php } ?>

<!-- Page preloader -->
<div id="loading">
    <div id="preloader">
        <span></span>
        <span></span>
    </div>
</div>

<!-- Overlay and Star effect -->
<div class="global-overlay">
    <div class="overlay skew-part light-overlay">

        <div id='stars'></div>
        <div id='stars2'></div>
        <div id='stars3'></div>

    </div>
</div>

<!-- START - Home/Left Part -->
<section id="left-side">

    <!-- Your logo -->
    <img src="<?= $model->getFileUrl('logo', 'basic'); ?>" alt="" class="brand-logo"/>

    <div class="content">

        <h1 class="text-intro opacity-0"><?= $model->title; ?>
            <div id="getting-started"></div>
        </h1>

        <h2 class="text-intro opacity-0"><?= $model->description; ?></h2>

        <nav>
            <ul>
                <li>
                    <a href="#" id="open-more-info" data-target="right-side" class="light-btn text-intro opacity-0">Подробнее</a>
                </li>
                <li>
                    <a data-dialog="somedialog" class="action-btn trigger text-intro opacity-0">Напомнить!</a>
                </li>
            </ul>
        </nav>

    </div>

    <?php if ($socialList) { ?>
        <!-- Social icons -->
        <div class="social-icons">
            <?php foreach ($socialList as $social) { ?>
                <a href="<?= $social->link; ?>"><i class="fa fa-<?= $social->type; ?>"></i></a>
            <?php } ?>
        </div>
    <?php } ?>

</section>
<!-- END - Home/Left Part -->

<!-- START - More Informations/Right Part -->
<section id="right-side" class="hide-right">

    <!-- MAP -->
    <div class="map-container opacity-0 animated-middle">
        <div id="map"></div>
    </div>

    <div class="content">

        <h3><?= $model->titleForm; ?></h3>

        <?= $model->descriptionForm; ?>

        <!-- START - Contact Form -->
        <form id="contact-form" name="contact-form" method="POST" data-name="Contact Form" action="/site/feedback">
            <input type="hidden" name="firstName">
            <div class="row">

                <!-- Full name -->
                <div class="col-xs-12 col-sm-6 col-lg-6">
                    <div class="form-group">
                        <input type="text" id="name" class="form form-control" placeholder="Ваше имя" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ваше имя'" name="name" data-name="Name" required>
                    </div>
                </div>

                <!-- E-mail -->
                <div class="col-xs-12 col-sm-6 col-lg-6">
                    <div class="form-group">
                        <input type="email" id="email" class="form form-control" placeholder="Ваш email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ваш email'" name="email" data-name="Email Address" required>
                    </div>
                </div>

                <!-- Subject -->
                <div class="col-xs-12 col-sm-12 col-lg-12">
                    <div class="form-group">
                        <input type="text" id="subject" class="form form-control" placeholder="Тема вопроса" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Тема вопроса'" name="subject" data-name="Subject">
                    </div>
                </div>

                <!-- Message -->
                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                    <div class="form-group">
                        <textarea id="text-area" class="form textarea form-control" placeholder="Сообщение" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Сообщение'" name="message" data-name="Text Area" required></textarea>
                    </div>
                </div>

            </div>

            <!-- Button submit -->
            <button type="submit" id="valid-form" class="btn btn-color">Отправить сообщение</button>

        </form>
        <!-- END - Contact Form -->

        <!-- Answer for the contact form is displayed in the next div, do not remove it. -->
        <div id="block-answer">

            <div id="answer"></div>

        </div>

        <div class="info-contact row">

            <div class="col-xs-12 col-sm-4 col-lg-4 item-map">
                <div class="contact-item"><i class="icon ion-ios-telephone"></i>
                    <p><?= $model->phone; ?></p>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-lg-4 item-map">
                <div class="contact-item"><i class="icon ion-ios-location"></i>
                    <p><?= nl2br($model->address); ?></p>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-lg-4 item-map">
                <div class="contact-item"><i class="icon ion-ios-email"></i>
                    <p><a href="mailto:<?= $model->email; ?>"><?= $model->email; ?></a></p>
                </div>
            </div>

        </div>

    </div>
    <!-- /. Content -->

    <footer>

        <p>©2016 - <?= app()->name; ?></p>

    </footer>

</section>
<!-- START - More Informations/Right Part -->

<!-- Button Cross to close the More Informations/Right Part -->
<button id="close-more-info" class="hide-close"><i class="icon ion-ios-close-outline"></i></button>

<!-- START - Newsletter Popup -->
<div id="somedialog" class="dialog">

    <div class="dialog__overlay"></div>

    <div class="dialog__content">

        <div class="dialog-inner">

            <h4><?= $model->titleSubscribe; ?></h4>

            <?= $model->descriptionSubscribe; ?>

            <!-- Newsletter Form -->
            <div id="subscribe">

                <form action="/site/subscribe" id="notifyMe" method="POST">
                    <input type="hidden" name="firstName">

                    <div class="form-group">

                        <div class="controls">

                            <!-- Field -->
                            <input type="text" id="mail-sub" name="email" placeholder="Введите свой email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Введите свой email'" class="form-control email srequiredField"/>

                            <!-- Spinner top left during the submission -->
                            <i class="fa fa-spinner opacity-0"></i>

                            <!-- Button -->
                            <button class="btn btn-lg submit">Подписаться</button>

                            <div class="clear"></div>

                        </div>

                    </div>

                </form>

                <!-- Answer for the newsletter form is displayed in the next div, do not remove it. -->
                <div class="block-message">

                    <div class="message">

                        <p class="notify-valid"></p>

                    </div>

                </div>

            </div>
            <!-- /. Newsletter Form -->

        </div>
        <!-- /. dialog-inner -->

        <!-- Button Cross to close the Newsletter Popup -->
        <button class="close-newsletter" data-dialog-close><i class="icon ion-close-round"></i></button>

    </div>
    <!-- /. dialog__content -->

</div>
<!-- END - Newsletter Popup -->

<!-- Root element of PhotoSwipe, the gallery. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
    It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides.
        PhotoSwipe keeps only 3 of them in the DOM to save memory.
        Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!-- Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>
<!-- /. Root element of PhotoSwipe. Must have class pswp. -->

<!-- ///////////////////\\\\\\\\\\\\\\\\\\\ -->
<!-- ********** Resources jQuery ********** -->
<!-- \\\\\\\\\\\\\\\\\\\/////////////////// -->

<!-- PhotoSwipe Core JS file -->
<script src="/client_side/coming_soon/js/velocity.min.js"></script>

<!-- PhotoSwipe UI JS file -->
<script src="/client_side/coming_soon/js/velocity.ui.min.js"></script>

<!-- Newsletter plugin -->
<script src="/client_side/coming_soon/js/notifyMe.js"></script>

<!-- Contact form plugin -->
<script src="/client_side/coming_soon/js/contact-me.js"></script>

<!-- *** Yandex Maps API *** -->
<script>
    var mapData = {
        points: [
            //['40.70820, -74.00487', '<i class="fa fa-coffee"></i> Текст всплывашки, если надо'],
            ['<?= $model->yandexMap; ?>', '<strong><?= app()->name; ?></strong><br><?= nl2br($model->address); ?><br><i class="fa fa-phone"></i>&ensp;<?= $model->phone; ?><br><i class="fa fa-envelope"></i>&ensp;<?= $model->email; ?>']
        ]
    }
</script>
<script src="/client_side/coming_soon/js/map.yandex.js"></script>
<script type="text/javascript" src="//api-maps.yandex.ru/2.1/?load=package.full&lang=ru_RU&onload=mapInit"></script>

<!-- Scroll plugin -->
<script src="/client_side/coming_soon/js/jquery.mousewheel.js"></script>

<!-- Custom Scrollbar plugin -->
<script src="/client_side/coming_soon/js/jquery.mCustomScrollbar.js"></script>

<!-- Popup Newsletter Form -->
<script src="/client_side/coming_soon/js/classie.js"></script>
<script src="/client_side/coming_soon/js/dialogFx.js"></script>

<!-- PhotoSwipe Core JS file -->
<script src="/client_side/coming_soon/js/photoswipe.js"></script>

<!-- PhotoSwipe UI JS file -->
<script src="/client_side/coming_soon/js/photoswipe-ui-default.js"></script>

<!-- Countdown plugin -->
<script src="/client_side/coming_soon/js/jquery.countdown.js"></script>

<script>
    $("#getting-started").countdown("<?= $model->startDate; ?>").on('update.countdown', function (event) {
        $(this).html(event.strftime('%D ' + '<?= HText::pluralForm($countDays, 'день', 'дня', 'дней'); ?>' + ' %Hч %Mм %Sс'));
    });
</script>

<!-- Main JS File -->
<script src="/client_side/coming_soon/js/custom.js"></script>

<!-- Main JS File -->
<script src="/client_side/coming_soon/js/main.js"></script>

<!--[if lt IE 10]>
<script type="text/javascript" src="/client_side/coming_soon/js/placeholder.js"></script><![endif]-->


</body>

</html>
