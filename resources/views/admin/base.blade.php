<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>@yield('title') | Administration </title>
    @vite(['resources/css/sidebar.css', 'public/vendor/larasort/css/larasort.css',])

</head>
<body>
    @php
        $route = request()->route()->getName();
    @endphp
    <div class="row">
        <div class="col-md-2 mt-5 me-5">
            <div class="flex-shrink-0 p-3 rounded-start rounded-4 sidebar-admin shadow" style="width: 280px;">
                <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
                  <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
                  <span class="fs-5 fw-semibold">Tableau de bord</span>
                </a>
                <ul class="list-unstyled ps-0">
                  <li class="mb-1">
                        <li class="d-flex gap-5 text-center"><a href="{{ route('admin.user.index') }}" class="btn fw-semibold d-inline-flex align-items-center rounded border-0 collapsed gap-2">
                            <img src="{{ url("/images/list.svg")}}" alt="logo de suppression">
                            <span class="fw-semibold">
                                Tous les utilisateurs
                            </span>
                        </a></li>
                  </li>
                                                        {{-- Classes --}}
                  <li class="mb-1">
                    <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed gap-2" data-bs-toggle="collapse" data-bs-target="#classroom-collapse" aria-expanded="false">
                        <img src="{{ url("/images/users.svg")}}" alt="logo de suppression">
                        <span class="fw-semibold">
                            Classes
                        </span>
                    </button>
                    <div class="collapse" id="classroom-collapse">
                      <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{ route('admin.classroom.index') }}" class="link-dark d-inline-flex text-decoration-none rounded">Voir les classes</a></li>
                        <li><a href="{{ route('admin.classroom.create') }}" class="link-dark d-inline-flex text-decoration-none rounded">Ajouter une classe</a></li>
                      </ul>
                    </div>
                  </li>
                                                        {{-- Devoirs --}}
                  <li class="mb-1">
                    <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed gap-2" data-bs-toggle="collapse" data-bs-target="#homework-collapse" aria-expanded="false">
                        <img src="{{ url("/images/file-text.svg")}}" alt="logo de suppression">
                        <span class="fw-semibold">
                            Devoirs
                        </span>
                    </button>
                    <div class="collapse" id="homework-collapse">
                      <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{ route('admin.homework.index') }}" class="link-dark d-inline-flex text-decoration-none rounded">Voir les devoirs</a></li>
                        <li><a href="{{ route('admin.homework.create') }}" class="link-dark d-inline-flex text-decoration-none rounded">Ajouter un devoir</a></li>
                      </ul>
                    </div>
                  </li>
                                                      {{-- Matières --}}
                  <li class="mb-1">
                    <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed gap-2" data-bs-toggle="collapse" data-bs-target="#subject-collapse" aria-expanded="false">
                        <img src="{{ url("/images/feather.svg")}}" alt="logo de suppression">
                        <span class="fw-semibold">
                            Matières
                        </span>
                    </button>
                    <div class="collapse" id="subject-collapse">
                      <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{ route('admin.subject.index') }}" class="link-dark d-inline-flex text-decoration-none rounded">Voir les matières</a></li>
                        <li><a href="{{ route('admin.subject.create') }}" class="link-dark d-inline-flex text-decoration-none rounded">Ajouter une matière</a></li>
                      </ul>
                    </div>
                  </li>
                    <li class="mb-1">
                        <li class="d-flex gap-5 text-center"><a href="{{ route('admin.user.bin') }}" class="btn fw-semibold d-inline-flex align-items-center rounded border-0 collapsed gap-2">
                            <img src="{{ url("/images/trash-2.svg")}}" alt="logo de suppression">
                            <span class="fw-semibold">
                                Corbeille
                            </span>
                        </a></li>
                    </li>
                  <li class="border-top my-3"></li>
                                                      {{-- Actions Profil --}}
                  <li class="mb-1">
                    <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-capitalize" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                    {{-- Nom d'utilisateur connecté --}}
                      {{ Auth::user()->name }}
                    </button>
                    <div class="collapse" id="account-collapse">
                      <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{ route('profile.edit') }}" class="link-dark d-inline-flex text-decoration-none rounded">Profil</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                @csrf
                                <a href="{{ route('logout') }}" class="link-dark d-inline-flex text-decoration-none rounded">Se déconnecter</a>
                            </form>
                        </li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </div>
        </div>
        <div class="col-md-9">
            <div class="container rounded-4 px-4 py-3 mt-5 shadow">
                {{-- Alerte s'affichant après certaines actions --}}
                @include('shared.flash')

                {{-- Contenu de la page --}}
                @yield('content')
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
