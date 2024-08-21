<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        <link rel="icon" type="image/x-svg" href="/img/hdcevents_logo.svg" sizes="32x32" />
        {{-- GOOGLE FONTS  --}}
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap"
        rel="stylesheet" />
        {{-- CSS --}}
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
             rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
             crossorigin="anonymous">
        <link rel="stylesheet" href="/css/styles.css">

    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div id="navbar" class="collapse navbar-collapse">
                    <a href="/" class="navbar-brand">
                    <img src="/img/hdcevents_logo.svg" alt="HDC Events">
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Events</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Create Event</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Register</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        @yield('content')
        <footer>
            <p>HDC Events &copy; 2024</p>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous">
        </script>
        <script type="module" src="https://unpkg.com/ionicons@5.1.2/dist/ionicons/ionicons.esm.js"></script>
    </body>
</html>
