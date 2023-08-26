<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    @vite(['resources/css/student.css'])
    <title>@yield('title') | Administration </title>

</head>
<body>
    <nav class="navbar navbar-expand-lg bg-success navbar-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ route('student.index') }}"><img src="{{ url("/images/logo-ombre.png") }}" alt="logo du site" class="img-responsive"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse d-flex justify-content-between gap-3" id="navbarNavDropdown">
                <div class="vr me-4 bg-light">

                </div>
                @php
                    $route = request()->route()->getName();
                @endphp
                <ul class="navbar-nav gap-3">
                <li class="nav-item">
                    <a @class(['nav-link', 'active' => str_contains($route,'student.index')]) href="{{ route('student.index') }}">Accueil</a>
                </li>
                <li class="nav-item">
                    <a @class(['nav-link', 'active' => str_contains($route,'student.show')]) href="{{ route('student.show') }}">Voir mes notes</a>
                </li>
                <li class="nav-item">
                    <a @class(['nav-link', 'active' => str_contains($route,'contact')]) href="{{ route('contact') }}">Contact</a>
                </li>
                </ul>
                <div class="ms-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown me-5">
                            <a class="nav-link dropdown-toggle fw-semibold text-light " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $user->name }}
                                <img src="{{ url("/images/chevron-down-white.svg")}}" alt="chevron vers le bas">
                            </a>
                            <ul class="dropdown-menu ">
                              <li class="">

                                <a class="dropdown-item d-inline-flex align-items-center justify-content-start gap-2" href="{{ route('profile.edit') }}">
                                    <img src="{{ url("/images/settings.svg")}}" alt="logo de suppression">
                                    <span class="fw-semibold">Profil</span>
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
                    </ul>
                </div>
          </div>
        </div>
    </nav>
    <div class="container mt-5 rounded-3 py-5 shadow">
        @include('shared.flash')

        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
