<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css' rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700' rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic'
        rel="stylesheet">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css' rel="stylesheet">
    <link href='http://localcmspractice.com/frontend/css/styles.css' rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <?php
        $locale = app()->getLocale();
        $url =\URL::current();

        $menulang = ($locale=='en')?'':'_'.$locale;
        $headermenu = \App\Modules\Menu\Models\Menu::where('title', 'main'.$menulang)->first();
        $headermenuar = (!empty($headermenu))?json_decode($headermenu->content,true):[];
        ?>

        @foreach ($headermenuar as $mk => $mv)
            <?php
            $menuactive = '';
            if (isset($mv['children'])) {
                $menuchildrenar = collect($mv['children'])
                    ->pluck('href')
                    ->toArray();
                if (in_array($url, $menuchildrenar)) {
                    $menuactive = 'active';
                }
            } elseif ($mv['href'] == $url) {
                $menuactive = 'active';
            }
            ?>
            <li class="nav-item @if (isset($mv['children'])) dropdown megaMenu @endif {{ $menuactive }}">
                <a class="nav-link @if (isset($mv['children'])) dropdown-toggle @endif" href="{{ $mv['href'] }}"
                    id="navbarDropdown{{ $mk }}"
                    @if (isset($mv['children'])) role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @endif
                    target="{{ $mv['target'] }}">{{ $mv['text'] }}</a>
                @if (isset($mv['children']))
                    <i class="icon-right-arrow mobDwnIcon d-lg-none"></i>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $mk }}">
                        @foreach ($mv['children'] as $ck => $cv)
                            <?php
                            $activeclass = '';
                            if ($url == $cv['href']) {
                                $activeclass = 'active';
                                $breadcrumbdata = [$mv['text'] => $mv['href'], $cv['text'] => $cv['href']];
                            }
                            ?>
                            <a class="dropdown-item {{ $activeclass }}" href="{{ $cv['href'] }}"
                                target="{{ $mv['target'] }}">{{ $cv['text'] }}</a>
                        @endforeach
                    </div>
                @endif
            </li>
        @endforeach


        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
