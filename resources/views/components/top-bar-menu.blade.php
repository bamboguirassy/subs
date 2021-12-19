<div class="menu-top card-wrapper mbr-fonts-style mbr-white display-7">
    <div class="bottom-nav justify-content-center">
        <a data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
            <span class="mbr-iconfont mobi-mbri mbri-menu"></span>
        </a>
        @auth
            <a title="Mes souscriptions" href="{{ route('mes.souscriptions') }}"
                @if (\Request::route()->getName() == 'mes.souscriptions') class="active" @endif>
                <span class="mbr-iconfont mobi-mbri mbri-bookmark"></span>
            </a>
            <a title="Mes appels de fond" href="{{ route('user.appelfond.list') }}"
                @if (\Request::route()->getName() == 'user.appelfond.list') class="active" @endif>
                <span class="mbr-iconfont icon54-v1-money-bag"></span>
            </a>
            <a title="Mon profil" href="{{ route('profile') }}" @if (\Request::route()->getName() == 'profile') class="active" @endif>
                <span class="mbr-iconfont mobi-mbri mbri-user"></span>
            </a>
            <a title="Mes programmes" href="{{ route('mes.programmes') }}" @if (\Request::route()->getName() == 'mes.programmes') class="active" @endif>
                <span class="mbr-iconfont mobi-mbri mbri-bulleted-list"></span>
            </a>
        @else
            <a title="Se connecter" href="{{ route('login') }}" @if (\Request::route()->getName() == 'login') class="active" @endif>
                <span class="mbr-iconfont mobi-mbri mbri-user"></span>
            </a>
        @endauth
        <a title="Accueil" href="{{ route('home') }}" @if (\Request::route()->getName() == 'home') class="active" @endif>
            <span class="mbr-iconfont mobi-mbri mbri-home"></span>
        </a>
    </div>
</div>
