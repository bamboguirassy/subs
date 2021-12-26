<ul class="sidebar-nav">
    <li class="nav-item">
        <a class="nav-link link text-primary display-4" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
            aria-controls="offcanvasExample">Publier un
            programme</a>
    </li>
    @guest
        <li class="nav-item">
            <a class="nav-link link text-primary display-4" href="{{ route('login') }}">Se
                connecter</a>
        </li>
    @endguest
    @auth
        <li class="nav-item">
            <a class="nav-link link text-primary display-4" href="{{ route('profile') }}" aria-expanded="false">
                Mon profil
            </a>
        </li>
        @if (auth()->user()->is_admin)
            <li>
                <div style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 30px;"
                    class="text-primary px-1">Admin</div>
                <ul>
                    <li class="nav-item">
                        <a class="nav-link link text-primary display-4" href="{{ route('admin.programme.index') }}"
                            aria-expanded="false">
                            Programmes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link text-primary display-4" href="{{ route('admin.appelfond.index') }}">Appels
                            de
                            fonds<br>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link text-primary display-4"
                            href="{{ route('admin.user.index') }}">Utilisateurs<br>
                        </a>
                    </li>
                </ul>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link link text-primary display-4" data-bs-toggle="offcanvas"
                    data-bs-target="#userSouscriptionList" aria-controls="userSouscriptionList">
                    Mes souscriptions
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link text-primary display-4" data-bs-toggle="offcanvas"
                    data-bs-target="#userProgrammeList" aria-controls="userProgrammeList">
                    Mes programmes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link text-primary display-4" data-bs-toggle="offcanvas"
                    data-bs-target="#userAppelFondList" aria-controls="userAppelFondList">
                    Mes appels de fond
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link link text-primary display-4" href="{{ route('achatsms.create') }}"
                data-bs-toggle="offcanvas" data-bs-target="#hisroriqueAchatSms" aria-controls="hisroriqueAchatSms">
                Solde SMS ({{ Auth::user()->nombreSms }} SMS)
            </a>
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
        <li style="border: none;" class="nav-item mt-4">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="btn btn-primary">
                    Se déconnecter
                </button>
            </form>
        </li>
    @endauth
</ul>
