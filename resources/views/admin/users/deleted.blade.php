@extends('admin.base')

@section('title','Utilisateurs supprimés')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        {{-- <a href="{{ route('admin.user.create')}}" class="btn btn-primary btn-sm">Ajouter un élève</a> --}}
    </div>
    <div class="d-flex justify-content-start mt-1 mb-4">
        <div class="">
            <form action="" method="get" class="container d-flex gap-2">
                <input type="text" placeholder="Utilisateur..." class="form-control" name="name">
                <button class="btn btn-success btn-sm">Chercher</button>
            </form>
        </div>
    </div>
    <div class="table-responsive-sm ">
        <table class="table table-striped table-hover with-larasort">
            <thead class="table-info ">
                <tr>
                    <th class="text-success">@sortableLink('name','Nom')</th>
                    <th>@sortableLink('email','Email')</th>
                    <th>@sortableLink('classroom_id','Classe')</th>
                    <th>@sortableLink('role','Role')</th>
                    <th>@sortableLink('created_at','Crée le')</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- Pour chaque utilisateur afficher ses informations dans une ligne de ma table --}}
                @foreach ($users as $user)
                    <tr @class(['table-danger' => $user->deleted_at])>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="fw-semibold">
                            {{-- Si l'utilisateur a une classe l'afficher , sinon afficher "aucune classe" --}}
                            @if ($user->classroom)
                            <a href="{{ route('admin.classroom.show',['classroom' => $user->classroom?->id]) }}" class="badge bg-primary text-decoration-none link-light">
                                {{ $user->classroom?->name }}
                            </a>
                            @else
                            <span>Aucune classe</span>
                            @endif
                        </td>
                        <td class="text-capitalize">
                            {{-- Afficher un badge différent selon le rôle --}}
                            @switch($user->role)
                                @case('admin')
                                    <a href="{{ route('admin.user.edit', $user) }}">
                                        <span class="badge bg-danger">Admin </span>
                                    </a>
                                    @break
                                @case('student')
                                    <a href="{{ route('admin.user.edit', $user) }}">
                                        <span class="badge bg-success">Élève</span>
                                    </a>
                                    @break
                                @default
                                    <a href="{{ route('admin.user.edit', $user) }}">
                                        <span class="badge bg-secondary">Utilisateur</span>
                                    </a>

                            @endswitch
                        </td>
                        <td>{{ $user->created_at->format('d-m-Y')}}</td>
                        <td>
                            <div class="d-flex gap-2 w-100 justify-content-end">
                                <div class="btn-group">
                                    <div class="dropdown" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                                        <img src="{{ url("/images/more-horizontal.svg")}}" alt="">
                                    </div>
                                    <ul class="dropdown-menu">
                                    <li>
                                        @if ($user->classroom?->exists && !$user->deleted_at)
                                            <a href="{{ route('admin.user.show', $user) }}" class="dropdown-item d-flex gap-2 text-center">
                                                <img src="{{ url("/images/eye.svg")}}" alt="logo en forme d'oeil">
                                                <span class="fw-semibold">
                                                    Profil & notes
                                                </span>
                                            </a>
                                        @endif
                                    </li>
                                    <li>
                                        @if ($user->deleted_at)
                                            <a href="{{ route('admin.user.restore', $user) }}" class="dropdown-item d-flex gap-2 text-center">
                                                <img src="{{ url("/images/refresh-ccw.svg")}}" alt="logo d'édition">
                                                <span class='fw-semibold'>
                                                    Restaurer
                                                </span>
                                            </a>
                                        @else
                                            <a href="{{ route('admin.user.edit', $user) }}" class="dropdown-item d-flex gap-2 text-center">
                                                <img src="{{ url("/images/edit.svg")}}" alt="logo d'édition">
                                                <span class='fw-semibold'>
                                                    Modifier
                                                </span>
                                            </a>
                                        @endif
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        @if ($user->deleted_at)
                                            <form action="{{route('admin.user.forcedelete', $user)}}" method="post">
                                                @csrf
                                                @method("delete")
                                                <button class="dropdown-item d-flex gap-2 text-center">
                                                    <img src="{{ url("/images/trash-2.svg")}}" alt="logo de suppression">
                                                    <span class="fw-semibold text-danger">
                                                        Supprimer
                                                    </span>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{route('admin.user.destroy', $user)}}" method="post">
                                                @csrf
                                                @method("delete")
                                                <button class="dropdown-item d-flex gap-2 text-center">
                                                    <img src="{{ url("/images/trash-2.svg")}}" alt="logo de suppression">
                                                    <span class="fw-semibold">
                                                        Supprimer
                                                    </span>
                                                </button>
                                            </form>
                                        @endif

                                    </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- Pagination --}}
    {{ $users->links() }}

@endsection('content')
