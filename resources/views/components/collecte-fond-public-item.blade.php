<section data-bs-version="5.1" class="testimonials1 cid-sPUKs1Rkty" id="testimonials01-2r">
    <div class="container-fluid">
        <div class="row justify-content-end">
            <div class="col-12 col-md-5 col-lg-3 m-auto image-wrapper">
                <a href="{{ route('programme.show', compact('programme')) }}">
                    <img src="{{ isset($programme->image) ? asset('uploads/programmes/images/' . $programme->image) : asset('assets/images/fulllogo_nobuffer.png') }}"
                        alt="{{ $programme->nom }}">
                </a>
            </div>
            <div class="counter-container m-auto col-12 col-md-7 col-lg-9">
                <div class="card">
                    <h2 class="mbr-section-title align-left mbr-fonts-style mb-3 display-5"><strong>
                            <a href="{{ route('programme.show', compact('programme')) }}">{{ $programme->nom }}</a>
                        </strong></h2>
                    {{-- <p class="mbr-text align-left mbr-fonts-style mb-3 display-7">
                        {!! $programme->description !!}
                    </p> --}}
                    <h3 class="mbr-section-subtitle align-left mbr-fonts-style mb-3 display-7">Date limite :
                        <strong>{{ date_format(new DateTime($programme->dateCloture), 'd/m/Y') }}</strong></h3>
                </div>
            </div>
        </div>
    </div>
</section>
<x-separator />
