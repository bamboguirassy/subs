<section data-bs-version="5.1" class="people1 cid-sOcl1Sl4ki" id="people1-1e">
    <div class="mbr-overlay" style="opacity: 0.6; background-color: rgb(254, 82, 91);">
    </div>
    <div class="container">
        <h3 class="mbr-fonts-style heading display-2"><strong>Responsable du programme</strong></h3>
        <div class="user-card">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="user_image ">
                        <img alt="photo {{ $user->name }}"
                            src="{{ $user->photo?asset('uploads/users/photos/' . $user->photo):'https://via.placeholder.com/100x100' }}">
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
                            <span>{{ $user->profession }}</span> <br>
                            <span>
                                <a class="text-white" href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                            </span><br>
                            <span>
                                <a class="text-white" href="tel:{{ $user->telephone }}">{{ $user->telephone }}</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
