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
    <link rel="shortcut icon" href="{{ asset('assets/images/icononly-128x102.png') }}" type="image/x-icon">
    <meta name="description" content="@yield('description')">


    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/web/assets/mobirise-icons2/mobirise2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/Material-Design-Icons/css/material.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icon54-v3/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icon54-v2/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icon54/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/Material-Design-Icons/css/material.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/assets/mobirise-icons/mobirise-icons.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-reboot.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/chatbutton/floating-wpp.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dropdown/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/socicon/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables/vanilla-dataTables.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('bower_components/simditor/site/assets/styles/mobile.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('bower_components/simditor/site/assets/styles/app.css') }}"> --}}
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
    <link rel="stylesheet" href="{{ asset('custom/css/custom.css') }}">
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
                icon: '{{ asset('assets/images/fulllogo_nobuffer.png') }}',
                badge: '{{ asset('assets/images/fulllogo_nobuffer.png') }}'
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
            icon: '{{ asset('assets/images/fulllogo_nobuffer.png') }}',
            badge: '{{ asset('assets/images/fulllogo_nobuffer.png') }}'
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
</head>

<body>
    <section data-bs-version="5.1" class="extMenu12 menu popup-btn-cards cid-sPMLiMsHDQ" once="menu" id="extMenu13-2c">
        <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg" style="min-height: 0px;">
            <div class="mbr-overlay" style="opacity: 1;"></div>
            <div class="full-link">
                <x-top-bar-menu />
            </div>
            <canvas id="canvasBar" style=" width: 100%; height: 7px; z-index: 9999;"></canvas>
            <x-main-nav-bar />
        </nav>
    </section>
    @yield("body")
    {{-- button d'ajout programme --}}
    <button type="button" class="btn btn-warning btn-lg px-3" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"
        style="border-radius: 50%; position: fixed; top: 50%; right: 10px;">
        <span class="icon54-v2-add-note mbr-iconfont mbr-iconfont-btn"></span>
    </button>
    {{-- canvas for programme new --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel"><a href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/fulllogo-nobuffer-612x123.png') }}" alt=""
                        style="height: 3rem; width: 95%">
                </a></h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div style="height: 10px; width: 100%; background-color: #BA265E;"></div>
        <div class="offcanvas-body">
            <x-programme-type-choice />
        </div>
    </div>
    {{-- end canvas menu - programme new --}}
    {{-- sidebar menu --}}
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel"><a href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/fulllogo-nobuffer-612x123.png') }}" alt=""
                        style="height: 3rem; width: 95%">
                </a></h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div style="height: 10px; width: 100%; background-color: #BA265E;"></div>
        <div class="offcanvas-body">
            <x-side-bar-menu />
        </div>
    </div>
    {{-- end sidebar menu --}}
    @auth
        {{-- canvas for historique achat SMS --}}
        <div class="offcanvas offcanvas-end" tabindex="-1" id="hisroriqueAchatSms"
            aria-labelledby="hisroriqueAchatSmsLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="hisroriqueAchatSmsLabel"><a href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/fulllogo-nobuffer-612x123.png') }}" alt=""
                            style="height: 3rem; width: 95%">
                    </a></h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div style="height: 10px; width: 100%; background-color: #BA265E;"></div>
            <h3 class="mbr-section-title mb-1 mbr-fonts-style display-4 text-primary text-center">
                Historique achat SMS
            </h3>
            <div class="offcanvas-body">
                <x-historique-achat-sms />
            </div>
        </div>
        {{-- end canvas menu - historique achat SMS --}}
        {{-- user pogramme list --}}
        <div class="offcanvas offcanvas-end" tabindex="-1" id="userProgrammeList" aria-labelledby="userProgrammeListLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="userProgrammeListLabel"><a href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/fulllogo-nobuffer-612x123.png') }}" alt=""
                            style="height: 3rem; width: 95%">
                    </a></h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div style="height: 10px; width: 100%; background-color: #BA265E;"></div>
            <div class="offcanvas-body">
                <h3 class="mbr-section-title mb-1 mbr-fonts-style display-4 text-primary">
                    Programmes que j'ai publiés...
                </h3>
                <hr>
                <div class="d-grid gap-2">
                    <a href="{{ route('achatsms.create') }}" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                    aria-controls="offcanvasExample">Démarrer un programme</a>
                </div>
                <hr>
                @forelse (auth()->user()->programmes as $programme)
                    <x-user-programme-item :programme="$programme" />
                @empty
                    <x-empty-message title="Programme vide" message="Vous n'avez publié aucun programme pour l'instant" />
                @endforelse
            </div>
        </div>
        {{-- end user pogramme list --}}
        {{-- user souscription list --}}
        <div class="offcanvas offcanvas-end" tabindex="-1" id="userSouscriptionList"
            aria-labelledby="userSouscriptionListLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="userSouscriptionListLabel"><a href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/fulllogo-nobuffer-612x123.png') }}" alt=""
                            style="height: 3rem; width: 95%">
                    </a></h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div style="height: 10px; width: 100%; background-color: #BA265E;"></div>
            <div class="offcanvas-body">
                <h3 class="mbr-section-title mb-1 mbr-fonts-style display-4 text-primary">
                    Programmes que auxquels je participe...
                </h3>
                @forelse (auth()->user()->main_subscribed_programs as $programme)
                    <x-user-programme-item :programme="$programme" />
                @empty
                    <x-empty-message title="Souscription vide"
                        message="Vous n'avez souscrit à aucun programme pour l'instant." />
                @endforelse
            </div>
        </div>
        {{-- user souscription list --}}
        {{-- user appel fond list --}}
        <div class="offcanvas offcanvas-end" tabindex="-1" id="userAppelFondList" aria-labelledby="userAppelFondListLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="userAppelFondListLabel"><a href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/fulllogo-nobuffer-612x123.png') }}" alt=""
                            style="height: 3rem; width: 95%">
                    </a></h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div style="height: 10px; width: 100%; background-color: #BA265E;"></div>
            <div class="offcanvas-body">
                <h3 class="mbr-section-title mb-1 mbr-fonts-style display-4 text-primary">
                    Mes appels de fonds
                </h3>
                @forelse (auth()->user()->appelFonds as $appelFond)
                    <x-user-appel-fond-item :appelFond="$appelFond" />
                @empty
                    <x-empty-message title="Appel de fond vide" message="Vous n'avez aucun appel de fond pour l'instant." />
                @endforelse
            </div>
        </div>
        {{-- user appel fond list --}}
    @endauth
    <section data-bs-version="5.1" class="footer7 cid-sOaHY68q1p pt-1" once="footers" id="footer7-1">
        <div class="container">
            <div class="media-container-row align-center mbr-white">
                <div class="col-12">
                    <p class="mbr-text mb-0 mt-0 mbr-fonts-style display-7">
                        © {{ date_format(new DateTime(), 'Y') }} - <a href="https://bambogroup.net"
                            class="text-white" target="_blank"><strong>Bambogroup</strong></a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('custom/reload-on-swipe.js') }}"></script>
    <script src="{{ asset('custom/jquery.loadBar.js') }}"></script>
    <script>
        document.onreadystatechange = function() {
            var state = document.readyState
            if (state == 'complete') {
                setTimeout(function() {
                    document.getElementById('canvasBar').style.visibility = "hidden";
                }, 500);
            }
        }
    </script>
    <script>
        $(() => {
            loadBar.trigger('show');
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
    @auth
        <script>
            $(function() {
                @foreach (auth()->user()->unreadNotifications as $notification)
                    setTimeout(() => {
                    toastr.info("{{ $notification->data['message'] }}", "{{ $notification->data['title'] }}", {
                    tapToDismiss: true,
                    timeOut: 0
                    });
                    }, Math.random()*5000);
                @endforeach
            })
        </script>
        @php
            auth()
                ->user()
                ->unreadNotifications->markAsRead();
        @endphp
    @endauth
    <x-whatsapp-form />
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
