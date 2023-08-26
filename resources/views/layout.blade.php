<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    @vite(['resources/css/home.css'])

    <title>@yield('title') | La Note Parfaite </title>
    
</head>
<body>
    @php
        $route = request()->route()->getName();
    @endphp
    <nav class="navbar navbar-expand-lg bg-light shadow">
        <div class="container-fluid">
          <a class="navbar-brand" href="/"><img src="{{ url("/images/logo-ombre.png") }}" alt="logo du site" class="img-responsive"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav gap-2">
                <li class="nav-item fw-semibold">
                    <a @class(['nav-link', 'active' => str_contains($route,'index')]) href="{{ route('index') }}">Accueil</a>
                </li>
                @if (Auth::user()?->role === 'student')
                    <li class="nav-item fw-semibold">
                        <a @class(['nav-link', 'active' => str_contains($route,'student')]) href="{{ route('student.show') }}">Voir mes notes</a>
                    </li>
                @endif
                <li class="nav-item fw-semibold">
                    <a @class(['nav-link', 'active' => str_contains($route,'contact')]) href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>
            <div class="ms-auto">
                <ul class="navbar-nav gap-2">
                    @guest
                    <li class="nav-item">
                      <a class="nav-link btn btn-success text-light" aria-current="page" href="{{ route('login') }}">Se connecter</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link btn btn-outline-success text-success" aria-current="page" href="{{ route('register') }}">S'inscrire</a>
                    </li>
                    @endguest
                    @auth
                    <li class="nav-item dropdown me-5">
                        <a class="nav-link dropdown-toggle fw-semibold text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                            <img src="{{ url("/images/chevron-down.svg")}}" alt="chevron vers le bas">
                        </a>
                        <ul class="dropdown-menu ">
                          <li class="">

                            <a class="dropdown-item d-inline-flex align-items-center justify-content-start gap-2" href="{{ route('profile.edit') }}">
                                <img src="{{ url("/images/settings.svg")}}" alt="logo de suppression">
                                <span class="fw-semibold">Voir profil</span>
                            </a>
                          </li>
                          <li><hr class="dropdown-divider"></li>
                          <li>
                            <form method="POST" action="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                @csrf
                                <a class="dropdown-item text-danger d-inline-flex align-items-center justify-content-start gap-2" href="{{ route('logout') }}">
                                    <img src="{{ url("/images/log-out.svg")}}" alt="logo de déconnection">
                                    Se déconnecter
                                </a>
                            </form>
                          </li>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
          </div>
        </div>
    </nav>
        @include('shared.flash')

        @yield('content')
    <div>
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
          <p class="col-md-4 mb-0 text-muted">&copy; {{ now()->year }} - La Note Parfaite </p>

          <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
          </a>

          <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="/" class="nav-link px-2 text-muted">Accueil</a></li>
            <li class="nav-item"><a href="{{route('contact')}}" class="nav-link px-2 text-muted">Nous contacter</a></li>
            <li class="nav-item"><a href="{{ route('mentions-legales') }}" class="nav-link px-2 text-muted">Mentions légales</a></li>
          </ul>
        </footer>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
