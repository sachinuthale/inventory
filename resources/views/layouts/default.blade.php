<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.head')
</head>
<body>
    <div id="app">
        @if(Auth::user())
            @include('includes.header')
        @else
        <header>
            @include('includes.header')
        </header>
        @endif
        <main role="main">
            @yield('content')
        </main>
        <footer class="footer">
            @include('includes.footer')
        </footer>
    </div>
    <script src="{{ url('js/app.js') }}"></script>
</body>
</html>
