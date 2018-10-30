<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.name', 'Rawat Inap') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Data Penyakit</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/diseases">Data Penyakit</a>
                    <a class="dropdown-item" href="/diseases/create">Entry Data Penyakit</a>
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/classifications">Data Klasifikasi</a>
                    <a class="dropdown-item" href="/classifications/create">Entry Data Klasifikasi</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Data Pasien</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/patients">Data Pasien</a>
                    <a class="dropdown-item" href="/patients/create">Entry Data Pasien</a>
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/recaps/dataKesakitan">Data Kesakitan</a>
                    <a class="dropdown-item" href="/recaps/topTen">Data 10 Besar Penyakit</a>
                </div>
            </li>
        </ul>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            <li class="nav-item">
                @if (Route::has('register'))
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
            </li>
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>
</nav>