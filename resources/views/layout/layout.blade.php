<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <title>{{ $page_title }}</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- alpine js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>


<body>
    <div class="container">
        <x-flash-message />
        <header
            class="d-flex flex-wrap align-items-center justify-content-center
                justify-content-md-between py-3 mb-4 border-bottom">
            <a href="/"
                class="d-flex align-items-center col-md-3 mb-2 mb-md-0
                text-primary text-strong text-decoration-none fs-1">
                <strong>WELS</strong>
            </a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                @role('admin')
                    <p class="link-dark px-2">WELCOME ADMIN</p>
                @else
                    <li><a href="/" class="nav-link px-2 link-dark">Home</a></li>
                    <li><a href="/electronics/create" class="nav-link px-2 link-dark">Post Electronic</a></li>
                @endrole
            </ul>

            @auth
                <div class="col-md-3 text-center dropdown">
                    <button class="btn btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="/dashboard" class="dropdown-item">Dashboard</a></li>
                        <li>
                            <form method="POST" action="/logout">
                                @csrf
                                <button type="submit" class="dropdown-item">Log out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <div class="col-md-3 text-end">
                    <a href="/login" class="btn btn-outline-primary me-2">Login</a>
                    <a href="/register" class="btn btn-primary">Sign-up</a>
                </div>
            @endauth
        </header>

        <main>

            @yield('content')

        </main>

        <footer>
            <footer class="text-center py-3 my-4 border-top">
                <div class="col-12  align-items-center">
                    <p class="mb-3 mb-md-0 text-muted text-center">© <span id="year"></span> <span
                            class="text-primary">WELS</span></p>
                </div>
            </footer>
        </footer>
    </div>
</body>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>

<script type="text/javascript">
    document.getElementById("year").innerHTML = new Date().getFullYear();
</script>

</html>
