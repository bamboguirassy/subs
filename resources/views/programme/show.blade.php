@extends("base")

@section('title', $programme->nom)

@section('social-sharing')
    <meta name="twitter:image:src" content="{{ asset('uploads/programmes/images/' . $programme->image) }}">
    <meta property="og:image" content="{{ asset('uploads/programmes/images/' . $programme->image) }}">
@endsection

@section('description', $programme->description)

@section('body')
    <section data-bs-version="5.1" class="header14 cid-sObVJU3AUD" id="header14-u">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-4 image-wrapper">
                    <img src="{{ asset('uploads/programmes/images/' . $programme->image) }}">
                </div>
                <div class="col-12 col-md">
                    <div class="text-wrapper">
                        <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2">
                            <strong>{{ $programme->nom }}</strong>
                        </h1>
                        <p class="mbr-text mbr-fonts-style display-7"></p>
                        <p><strong>
                                {{ $programme->modeDeroulement }}&nbsp; &nbsp; -&nbsp; &nbsp; {{ $programme->duree }}
                                heures&nbsp;&nbsp;&nbsp;&nbsp; -
                                &nbsp;&nbsp;&nbsp;&nbsp;{{ $programme->nombreSeance }} séances&nbsp;</strong></p>
                        <p></p>
                        <div class="mbr-section-btn mt-3">
                            @if (((auth()->user() && auth()->id()!=$programme->user_id) || !auth()->user()) &&
                            !$programme->current_user_souscription)
                            <a class="btn btn-success display-4"
                                href="{{ route('souscription.new', compact('programme')) }}">
                                <span class="mbrib-edit mbr-iconfont mbr-iconfont-btn"></span>Souscrire
                            </a>
                            @endif
                            @auth
                                @if (auth()->id() == $programme->user_id)
                                    <form method="post" action="{{ route('programme.destroy', compact('programme')) }}"
                                        class="btn">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-secondary display-4" href="#">
                                            <span class="mobi-mbri mobi-mbri-trash mbr-iconfont mbr-iconfont-btn"></span>
                                            Supprimer
                                        </button>
                                    </form>
                                    <a class="btn btn-danger display-4" href="#table01-x">
                                        <span class="mbrib-users mbr-iconfont mbr-iconfont-btn"></span>Participants</a>
                                    <a class="btn btn-warning display-4" href="{{ route('programme.edit', compact('programme')) }}"><span
                                            class="mobi-mbri mobi-mbri-edit-2 mbr-iconfont mbr-iconfont-btn"></span>Modifier</a>
                                @else
                                    @if ($programme->current_user_souscription && $programme->active)
                                        <a class="btn btn-danger display-4" href="">
                                            <span class="mobi-mbri mobi-mbri-close mbr-iconfont mbr-iconfont-btn"></span>Annuler
                                            ma
                                            souscription</a>
                                    @endif
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-responsable-programme :user="$programme->user" />

    {{-- tab section --}}
    <section data-bs-version="5.1" class="tabs list1 cid-sODO1Mi024" id="list1-1r">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item first mbr-fonts-style"><a class="nav-link mbr-fonts-style show active display-7"
                                role="tab" data-toggle="tab" data-bs-toggle="tab" href="#list1-1r_tab0"
                                aria-selected="true">Description</a></li>
                        @auth
                            @if ($programme->user_id == auth()->id())
                                <li class="nav-item"><a class="nav-link mbr-fonts-style active display-7" role="tab"
                                        data-toggle="tab" data-bs-toggle="tab" href="#list1-1r_tab1"
                                        aria-selected="true">Participants</a></li>
                                {{-- <li class="nav-item"><a class="nav-link mbr-fonts-style display-7" role="tab"
                                        data-toggle="tab" data-bs-toggle="tab" href="#list1-1r_tab3"
                                        aria-selected="false">Séances</a></li>
                                <li class="nav-item"><a class="nav-link mbr-fonts-style active display-7" role="tab"
                                        data-toggle="tab" data-bs-toggle="tab" href="#list1-1r_tab4"
                                        aria-selected="true">Certification</a></li> --}}
                            @elseif($programme->current_user_souscription)
                                <li class="nav-item"><a class="nav-link mbr-fonts-style display-7" role="tab"
                                        data-toggle="tab" data-bs-toggle="tab" href="#list1-1r_tab2" aria-selected="false">Ma
                                        souscription</a></li>
                            @endif
                        @endauth
                    </ul>
                    <div class="tab-content p-5">
                        <div id="tab1" class="tab-pane in active" role="tabpanel">
                            <div class="row">
                                <div class="col-md-3 logo-container d-flex justify-content-center align-items-center">
                                    <div class="d-flex flex-wrap">
                                        <div class="mb-md-0 mb-3">
                                            <img src="{{ asset('uploads/programmes/images/' . $programme->image) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <x-programme-description :description="$programme->description" />
                                </div>
                            </div>
                        </div>
                        @auth
                            @if ($programme->user_id == auth()->id())
                                <div id="tab2" class="tab-pane" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <x-participant-list :souscriptions="$programme->souscriptions" />
                                        </div>
                                    </div>
                                </div>
                                {{-- <div id="tab3" class="tab-pane" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-3 logo-container d-flex justify-content-center align-items-center">
                                            <div class="d-flex flex-wrap">
                                                <div class="mb-md-0 mb-3">
                                                    <img src="assets/images/logo3.png">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <p class="mbr-text mbr-fonts-style display-7">
                                                Aliquip ut amet adipisicing excepteur commodo officia mollit reprehenderit ex
                                                proident qui consequat amet sint. Quis amet officia consequat irure. Velit
                                                pariatur
                                                esse ad Lorem amet non reprehenderit commodo cupidatat ut duis. Sunt qui et qui
                                                ad
                                                id esse qui non deserunt anim dolor.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab4" class="tab-pane" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-3 logo-container d-flex justify-content-center align-items-center">
                                            <div class="d-flex flex-wrap">
                                                <div class="mb-md-0 mb-3">
                                                    <img src="assets/images/logo4.png">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <p class="mbr-text mbr-fonts-style display-7">
                                                Consequat cillum laborum tempor minim culpa minim. Ipsum incididunt ex officia
                                                aute
                                                exercitation officia deserunt voluptate. Proident aliqua commodo qui nulla.</p>
                                        </div>
                                    </div>
                                </div> --}}
                            @elseif($programme->current_user_souscription)
                                <div id="tab5" class="tab-pane" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <x-souscription-details :souscription="$programme->current_user_souscription"/>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end tab section --}}

    <x-separator />

    <x-social-sharing />

    <x-separator />

@endsection
