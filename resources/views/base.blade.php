<!DOCTYPE html>
<html lang="fr" ng-app="Subs">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="twitter:card" content="summary_large_image" />
    @hasSection('social-sharing')
        @yield('social-sharing')
    @else
        <meta name="twitter:image:src" content="{{ asset('assets/images/fulllogo_nobuffer.png') }}">
        <meta property="og:image" content="{{ asset('assets/images/fulllogo_nobuffer.png') }}">
    @endif
    <meta name="twitter:title" content="@yield('title')">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/images/subs-logo-121x141.png') }}" type="image/x-icon">
    <meta name="description" content="@yield('description')">


    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/web/assets/mobirise-icons2/mobirise2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/Material-Design-Icons/css/material.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icon54-v3/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icon54/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/Material-Design-Icons/css/material.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/assets/mobirise-icons/mobirise-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-reboot.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/chatbutton/floating-wpp.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dropdown/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/socicon/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables/vanilla-dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/simditor/site/assets/styles/simditor.css') }}">
    <link rel="preload"
        href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap">
    </noscript>
    <link rel="preload" as="style" href="{{ asset('assets/mobirise/css/mbr-additional.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/mobirise/css/mbr-additional.css') }}" type="text/css">
    <meta name="theme-color" content="#F2DEDD">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <script src="{{ asset('sw-connect.js') }}"></script>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-startup-image"
        media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="{{ asset('assets/images/apple-launch-640x1136.png') }}">
    <link rel="apple-touch-startup-image"
        media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="{{ asset('assets/images/apple-launch-750x1334.png') }}">
    <link rel="apple-touch-startup-image"
        media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
        href="{{ asset('assets/images/apple-launch-1242x2208.png') }}">
    <link rel="apple-touch-startup-image"
        media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
        href="{{ asset('assets/images/apple-launch-1125x2436.png') }}">
    <link rel="apple-touch-startup-image"
        media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="{{ asset('assets/images/apple-launch-1536x2048.png') }}">
    <link rel="apple-touch-startup-image"
        media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="{{ asset('assets/images/apple-launch-1668x2224.png') }}">
    <link rel="apple-touch-startup-image"
        media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="{{ asset('assets/images/apple-launch-2048x2732.png') }}">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <meta name="keywords" content="Inscription,formation,séminaire,conférence,participation,Bambogroup,Subs">
    <style>
        .nowrap {
            white-space: nowrap;
        }

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    @notify_css
    <script>
        function notifyMe(title, options) {
            // Vérifions si le navigateur prend en charge les notifications
            if (!('Notification' in window)) {
                console.log('Ce navigateur ne prend pas en charge la notification de bureau')
            }

            // Vérifions si les autorisations de notification ont déjà été accordées
            else if (Notification.permission === 'granted') {
                toastr.info(options.body, title, {
                    tapToDismiss: true,
                    timeOut: 0
                });
                // Si tout va bien, créons une notification
                const notification = new Notification(title, options);
            }

            // Sinon, nous devons demander la permission à l'utilisateur
            else if (Notification.permission !== 'denied') {
                Notification.requestPermission().then((permission) => {
                    // Si l'utilisateur accepte, créons une notification
                    if (permission === 'granted') {
                        toastr.info(options.body, title, {
                            tapToDismiss: true,
                            timeOut: 0
                        });
                        const notification = new Notification(title, options);
                    }
                })
            }

            // Enfin, si l'utilisateur a refusé les notifications, et que vous
            // voulez être respectueux, il n'est plus nécessaire de les déranger.
        }
    </script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;

        var pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
            cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}'
        });

        var generalChannel = pusher.subscribe('general');
        generalChannel.bind('general-event', function(data) {
            const options = {
                body: data.message,
                icon: '{{ asset('assets/images/mbr-121x129.png') }}',
                badge: '{{ asset('assets/images/mbr-121x129.png') }}'
            };
            notifyMe(title, options);
        }, {
            name: 'Pusher'
        });

        @auth
            var userChannel = pusher.subscribe('user-{{ auth()->id() }}');
            userChannel.bind('user-event', function(data) {
            const options = {
            body: data.message,
            icon: '{{ asset('assets/images/mbr-121x129.png') }}',
            badge: '{{ asset('assets/images/mbr-121x129.png') }}'
            };
            notifyMe(data.title, options);
            }, { name: 'Pusher2' });
        @endauth
    </script>
    <!-- Analytics -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=G-3CLXFYMR2H"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-3CLXFYMR2H');
    </script>
    <!-- /Analytics -->
    {!! Adsense::javascript() !!}
</head>

<body>
    <section data-bs-version="5.1" class="extMenu12 menu popup-btn-cards cid-sPMLiMsHDQ" once="menu" id="extMenu13-2c">
        <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
            <div class="mbr-overlay" style="opacity: 0.9;"></div>

            <a class="full-link" href="#">
                <div class="menu-top card-wrapper mbr-fonts-style mbr-white display-7">La plateforme de collecte de&nbsp;
                    souscriptions</div>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <div class="left-menu">
                    <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link link text-primary display-4" href="{{ route('mes.programmes') }}"
                                    aria-expanded="false">
                                    Mes programmes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link text-primary display-4"
                                    href="{{ route('mes.souscriptions') }}">
                                    Mes souscriptions
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link link text-primary display-4"
                                    href="{{ route('login') }}?ret={{ request()->fullUrl() }}" aria-expanded="false">
                                    Se connecter
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
                <div class="brand-container">
                    <div class="navbar-brand">
                        <span class="navbar-logo">
                            <a href="{{ route('home') }}">
                                <img src="assets/images/fulllogo-nobuffer-612x123.png" alt="" style="height: 3.8rem;">
                            </a>
                        </span>
                    </div>
                </div>
                <div class="right-menu">
                    <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link link dropdown-toggle text-secondary display-4" href="#"
                                    data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                    aria-expanded="false">
                                    Mon compte
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdown-undefined">
                                    <a class="dropdown-item text-primary display-4"
                                        href="{{ route('programme.pre.publish') }}" aria-expanded="false">
                                        Démarrer nouveau programme
                                    </a>
                                    <a class="dropdown-item text-primary display-4"
                                        href="{{ route('achatsms.create') }}" aria-expanded="false">
                                        Acheter pack SMS
                                    </a>
                                    <a class="dropdown-item text-primary display-4" href="{{ route('profile') }}">Mon
                                        profil<br>
                                    </a>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button class="dropdown-item text-primary display-4">
                                            Se déconnecter
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endauth
                        <li class="nav-item">
                            <a class="nav-link link text-primary display-4" href="{{ route('apropos') }}">A
                                propos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-primary display-4" href="{{ route('contact') }}">
                                Contacts
                            </a>
                        </li>
                        @auth
                            @if (auth()->user()->type == 'admin')
                                <li class="nav-item dropdown">
                                    <a class="nav-link link dropdown-toggle text-primary display-4" href="#"
                                        data-toggle="dropdown-submenu" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside" aria-expanded="false">
                                        Admin
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdown-undefined">
                                        <a class="dropdown-item text-primary display-4"
                                            href="{{ route('admin.programme.index') }}" aria-expanded="false">
                                            Programmes
                                        </a>
                                        <a class="dropdown-item text-primary display-4"
                                            href="{{ route('admin.appelfond.index') }}">Appels de fonds<br>
                                        </a>
                                        <a class="dropdown-item text-primary display-4"
                                            href="{{ route('admin.user.index') }}">Utilisateurs<br>
                                        </a>
                                    </div>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse"
                data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
        </nav>
    </section>
    @yield("body")
    <section data-bs-version="5.1" class="footer7 cid-sOaHY68q1p" once="footers" id="footer7-1">
        <div class="container">
            <div class="media-container-row align-center mbr-white">
                <div class="col-12">
                    <p class="mbr-text mb-0 mbr-fonts-style display-7">
                        © Copyright {{ date_format(new DateTime(), 'Y') }} <a href="https://bambogroup.net"
                            class="text-white" target="_blank"><strong>Bambo GROUP</strong></a> - Tous droits
                        réservés
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/typed/typed.js') }}"></script>
    <script src="{{ asset('assets/smoothscroll/smooth-scroll.js') }}"></script>
    <script src="{{ asset('assets/ytplayer/index.js') }}"></script>
    <script src="{{ asset('assets/chatbutton/floating-wpp.js') }}"></script>
    <script src="{{ asset('assets/mbr-tabs/mbr-tabs.js') }}"></script>
    <script src="{{ asset('assets/popup-plugin/script.js') }}"></script>
    <script src="{{ asset('assets/popup-overlay-plugin/script.js') }}"></script>
    <script src="{{ asset('assets/chatbutton/script.js') }}"></script>
    <script src="{{ asset('assets/dropdown/js/navbar-dropdown.js') }}"></script>
    <script src="{{ asset('assets/touchswipe/jquery.touch-swipe.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/vanilla-dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/sociallikes/social-likes.js') }}"></script>
    <script src="{{ asset('assets/theme/js/script.js') }}"></script>
    <script src="{{ asset('bower_components/simditor/site/assets/scripts/module.js') }}"></script>
    <script src="{{ asset('bower_components/simditor/site/assets/scripts/hotkeys.js') }}"></script>
    {{-- <script src="{{ asset('bower_components/simditor/site/assets/scripts/uploader.js') }}"></script> --}}
    <script src="{{ asset('bower_components/simditor/site/assets/scripts/simditor.js') }}"></script>
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>
    <script src="{{ asset('assets/mbr-flip-card/mbr-flip-card.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(() => {
            if ($('#wysiwyg').length) {
                var editor = new Simditor({
                    textarea: $('#wysiwyg')
                    //optional options
                });
            }
            if ($('#editor').length) {
                var editor2 = new Simditor({
                    textarea: $('#editor')
                    //optional options
                });
            }
        });
    </script>
    @yield('inline-script')
    @notify_js
    @notify_render

    <script src="{{ asset('angular/app.js') }}"></script>
    <script src="{{ asset('angular/service.js') }}"></script>

    <div id="chatbutton-wa" data-phone="+221778224129" data-showpopup="true"
        data-headertitle="👋 Echangeons sur WhatsApp!" data-popupmessage="Salut !👋

Ecris un message ici. Il te dirigera vers ton téléphone ! 🔥

Bambogroup Team" data-placeholder="Ecrire ici..." data-position="left" data-headercolor="#fe525b"
        data-backgroundcolor="#e5ddd5" data-autoopentimeout="0" data-size="65px">
        <div class="floating-wpp-button" style="width: 65px; height: 65px;">
            <div class="floating-wpp-button-image">
                <!--?xml version="1.0" encoding="UTF-8" standalone="no"?--><svg xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" style="isolation:isolate" viewBox="0 0 800 800"
                    width="65" height="65">
                    <defs>
                        <clipPath id="_clipPath_A3g8G5hPEGG2L0B6hFCxamU4cc8rfqzQ">
                            <rect width="800" height="800"></rect>
                        </clipPath>
                    </defs>
                    <g clip-path="url(#_clipPath_A3g8G5hPEGG2L0B6hFCxamU4cc8rfqzQ)">
                        <g>
                            <path
                                d=" M 787.59 800 L 12.41 800 C 5.556 800 0 793.332 0 785.108 L 0 14.892 C 0 6.667 5.556 0 12.41 0 L 787.59 0 C 794.444 0 800 6.667 800 14.892 L 800 785.108 C 800 793.332 794.444 800 787.59 800 Z "
                                fill="rgb(37,211,102)"></path>
                        </g>
                        <g>
                            <path
                                d=" M 508.558 450.429 C 502.67 447.483 473.723 433.24 468.325 431.273 C 462.929 429.308 459.003 428.328 455.078 434.22 C 451.153 440.114 439.869 453.377 436.434 457.307 C 433 461.236 429.565 461.729 423.677 458.78 C 417.79 455.834 398.818 449.617 376.328 429.556 C 358.825 413.943 347.008 394.663 343.574 388.768 C 340.139 382.873 343.207 379.687 346.155 376.752 C 348.804 374.113 352.044 369.874 354.987 366.436 C 357.931 362.999 358.912 360.541 360.875 356.614 C 362.837 352.683 361.857 349.246 360.383 346.299 C 358.912 343.352 347.136 314.369 342.231 302.579 C 337.451 291.099 332.597 292.654 328.983 292.472 C 325.552 292.301 321.622 292.265 317.698 292.265 C 313.773 292.265 307.394 293.739 301.996 299.632 C 296.6 305.527 281.389 319.772 281.389 348.752 C 281.389 377.735 302.487 405.731 305.431 409.661 C 308.376 413.592 346.949 473.062 406.015 498.566 C 420.062 504.634 431.03 508.256 439.581 510.969 C 453.685 515.451 466.521 514.818 476.666 513.302 C 487.978 511.613 511.502 499.06 516.409 485.307 C 521.315 471.55 521.315 459.762 519.842 457.307 C 518.371 454.851 514.446 453.377 508.558 450.429 Z  M 401.126 597.117 L 401.047 597.117 C 365.902 597.104 331.431 587.661 301.36 569.817 L 294.208 565.572 L 220.08 585.017 L 239.866 512.743 L 235.21 505.332 C 215.604 474.149 205.248 438.108 205.264 401.1 C 205.307 293.113 293.17 205.257 401.204 205.257 C 453.518 205.275 502.693 225.674 539.673 262.696 C 576.651 299.716 597.004 348.925 596.983 401.258 C 596.939 509.254 509.078 597.117 401.126 597.117 Z  M 567.816 234.565 C 523.327 190.024 464.161 165.484 401.124 165.458 C 271.24 165.458 165.529 271.161 165.477 401.085 C 165.46 442.617 176.311 483.154 196.932 518.892 L 163.502 641 L 288.421 608.232 C 322.839 627.005 361.591 636.901 401.03 636.913 L 401.126 636.913 L 401.127 636.913 C 530.998 636.913 636.717 531.2 636.77 401.274 C 636.794 338.309 612.306 279.105 567.816 234.565"
                                fill-rule="evenodd" fill="rgb(255,255,255)"></path>
                        </g>
                    </g>
                </svg>
            </div>
        </div>
    </div>
    <script>
        "use strict";
        if ("loading" in HTMLImageElement.prototype) {
            document.querySelectorAll('img[loading="lazy"],iframe[loading="lazy"]').forEach(e => {
                e.src = e.dataset.src, e.style.paddingTop = 100 * e.getAttribute("data-aspectratio") + "%", e.style
                    .height = 0, e.onload = function() {
                        e.removeAttribute("style")
                    }
            })
        } else {
            const e = document.createElement("script");
            e.src = "https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.1.2/lazysizes.min.js') }}", document.body
                .appendChild(e)
        }
    </script>

</body>

</html>
