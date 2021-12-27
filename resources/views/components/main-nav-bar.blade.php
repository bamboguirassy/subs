<div class="collapse navbar-collapse d-sm-none d-lg-block" id="navbarSupportedContent">

    <div class="left-menu">
        <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
            @auth
                @if (auth()->user()->type == 'admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link link dropdown-toggle text-primary display-4" href="#"
                            data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            aria-expanded="false">
                            Admin
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-undefined">
                            <a class="dropdown-item text-primary display-4" href="{{ route('admin.programme.index') }}"
                                aria-expanded="false">
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
                <li class="nav-item">
                    <a class="nav-link link text-primary display-4" href="{{ route('apropos') }}">A
                        propos</a>
                </li>
            </ul>
        </div>
        <div class="brand-container">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/fulllogo-nobuffer-612x123.png') }}" alt=""
                            style="height: 2.5rem;">
                    </a>
                </span>
            </div>
        </div>
        <div class="right-menu">
            <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                <li class="nav-item">
                    <a class="nav-link link text-primary display-4" href="{{ route('contact') }}">
                        Contacts
                    </a>
                </li>
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link link dropdown-toggle text-primary display-4" href="#" data-toggle="dropdown-submenu"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            Mon compte
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-undefined">
                            <a class="dropdown-item text-primary display-4" href="{{ route('achatsms.create') }}"
                                aria-expanded="false">
                                Acheter pack SMS
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
            @endauth
        </ul>
    </div>
</div>
