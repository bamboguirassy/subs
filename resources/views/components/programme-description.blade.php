<section data-bs-version="5.1" class="content5 cid-sObXMGv5hX" id="content5-v">
    <div class="row justify-content-center">
        <div class="col-12">
            <h4 class="mbr-section-subtitle mbr-fonts-style mb-4 display-5">
                Description du programme</h4>
            <p class="mbr-text mbr-fonts-style display-7">
                {!! $programme->description !!}
            </p>
            @if (!$programme->current_user_souscription)
                <a class="btn btn-success display-4" href="{{ route('souscription.new', compact('programme')) }}">
                    <span class="mbrib-edit mbr-iconfont mbr-iconfont-btn"></span>Participer
                </a>
            @endif
        </div>
    </div>
</section>
