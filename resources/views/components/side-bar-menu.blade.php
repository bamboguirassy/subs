<ul class="sidebar-nav">
    <li class="nav-item">
        <a class="nav-link link text-primary display-4" href="{{ route('programme.pre.publish') }}">Publier un
            programme</a>
    </li>
    @guest
        <li class="nav-item">
            <a class="nav-link link text-primary display-4" href="{{ route('login') }}">Se connecter</a>
        </li>
    @endguest
    @auth
        <li class="nav-item">
            <a class="nav-link link text-primary display-4" href="{{ route('profile') }}" aria-expanded="false">
                Mon profil
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link link text-primary display-4" href="{{ route('mes.souscriptions') }}" aria-expanded="false">
                Mes souscriptions
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link link text-primary display-4" href="{{ route('mes.programmes') }}" aria-expanded="false">
                Mes programmes
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link link text-primary display-4" href="{{ route('user.appelfond.list') }}"
                aria-expanded="false">
                Mes appels de fond
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link link text-primary display-4" href="{{ route('achatsms.create') }}" aria-expanded="false">
                Acheter des SMS ({{ Auth::user()->nombreSms }} SMS)
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
