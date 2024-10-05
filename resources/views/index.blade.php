<!DOCTYPE html>
    <head>
        <title>Tiago Perrelli - @yield('title')</title>
        @vite('resources/sass/app.scss')
    </head>
    <body>
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Forecast</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </header>
        <div class="container-fluid">
            <div class="row">
                <main id="app"></main>
            </div>
        </div>

        @vite('resources/js/app.js') 
    </body>
</html>