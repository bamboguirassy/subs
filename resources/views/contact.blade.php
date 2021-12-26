@extends("base")

@section('title',  config('app.name')." Contact")

@section('body')
    <section data-bs-version="5.1" class="cid-sPNHiIlGAI" id="header04-2m">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1380px" height="760px"
            viewBox="0 0  1380 760" preserveAspectRatio="xMidYMid meet">
            <rect id="svgEditorBackground" x="0" y="0" width="1380" height="760" style="fill: none; stroke: none;"></rect>
            <ellipse id="e1_ellipse" cx="411" cy="-89" style="fill:khaki;stroke:black;stroke-width:0px;" rx="842" ry="677"
                transform="matrix(1.10937 0 0 1.10937 -41.7954 -68.1567)"></ellipse>
        </svg>
        <div class="container align-center">
            <div class="row">
                <div class="col-md-12 col-lg-6 py-4 m-auto">
                    <h1 class="mbr-section-title mbr-regular pb-3 align-left mbr-fonts-style display-2">{{  config('app.name') }}</h1>

                    <p class="mbr-text mbr-light pb-3 align-left mbr-fonts-style display-5">
                        Installez plus facilement l'application sur tous vos appareils grace à la solution innovante des
                        applications Web Progressives.</p>
                </div>
                <div class="col-lg-6 col-md-12 align-center">
                    <img src="assets/images/mbr-1004x552.jpg" alt="">
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="contacts2 cid-sPNI1sXRHE" id="contacts2-2n">
        <div class="container">
            <div class="mbr-section-head">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                    <strong>Contacts</strong>
                </h3>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="card col-12 col-md-6">
                    <div class="card-wrapper">
                        <div class="image-wrapper">
                            <span class="mbr-iconfont mobi-mbri-phone mobi-mbri"></span>
                        </div>
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style mb-1 display-5">
                                <strong>Téléphone</strong>
                            </h6>
                            <p class="mbr-text mbr-fonts-style display-7"><a href="https://wa.me/221778224129"
                                    class="text-primary">+221778224129</a></p>
                        </div>
                    </div>
                </div>
                <div class="card col-12 col-md-6">
                    <div class="card-wrapper">
                        <div class="image-wrapper">
                            <span class="mbr-iconfont mobi-mbri-letter mobi-mbri"></span>
                        </div>
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style mb-1 display-5">
                                <strong>Email</strong>
                            </h6>
                            <p class="mbr-text mbr-fonts-style display-7"><a href="mailto:contact@bambogroup.net"
                                    class="text-primary">contact@bambogroup.net</a></p>
                        </div>
                    </div>
                </div>
                <div class="card col-12 col-md-6">
                    <div class="card-wrapper">
                        <div class="image-wrapper">
                            <span class="mbr-iconfont mobi-mbri-globe mobi-mbri"></span>
                        </div>
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style mb-1 display-5">
                                <strong>Adresse</strong>
                            </h6>
                            <p class="mbr-text mbr-fonts-style display-7">
                                Thiès, Sénégal</p>
                        </div>
                    </div>
                </div>
                <div class="card col-12 col-md-6">
                    <div class="card-wrapper">
                        <div class="image-wrapper">
                            <span class="mbr-iconfont mobi-mbri-bulleted-list mobi-mbri"></span>
                        </div>
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style mb-1 display-5">
                                <strong>Disponbilité</strong>
                            </h6>
                            <p class="mbr-text mbr-fonts-style display-7">
                                Toujours disponible</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr style="height: 50px;">
@endsection
