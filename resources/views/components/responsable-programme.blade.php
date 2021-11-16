<section data-bs-version="5.1" class="people1 cid-sOcl1Sl4ki" id="people1-1e">
    <div class="mbr-overlay" style="opacity: 0.6; background-color: #2ca9d7;">
    </div>
    <div class="container">
        <h3 class="mbr-fonts-style heading display-2"><strong>Responsable du programme</strong></h3>
        <div class="user-card">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="user_image ">
                        <img alt="photo {{ $user->name }}"
                            src="{{ asset('uploads/users/photos/' . $user->photo) }}">
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-9">
                    <div class="description">
                        <div class="user_text">
                            <p class="mbr-fonts-style small display-4">
                                {!! $user->presentation !!}
                            </p>
                        </div>
                        <div class="user_name mbr-fonts-style display-7">
                            <strong>{{ $user->name }}</strong>
                        </div>
                        <div class="user_desk mbr-fonts-style display-4">
                            <span>{{ $user->profession }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
