@extends('admin.base')


@section('title', 'Classe de '.$classroom->name)

@section('content')
    <h1>@yield('title')</h1>
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary btn-sm my-3 text-end">Retour</a>


        {{-- <a href="{{ route('admin.mark.create', ['user' => $user]) }}" class="btn btn-primary">Ajouter une note</a> --}}
        <div class="row">
            <div class="col-md-8">
                <table class="table table-light table-striped">
                    <thead class="table-success with-larasort">
                        <tr>
                            <th>@sortableLink('name','Nom')</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <div class="d-flex gap-2 w-100 justify-content-end">
                                        <div class="btn-group">
                                            <div class="dropdown" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                                                <img src="{{ url("/images/more-horizontal.svg")}}" alt="">
                                            </div>
                                            <ul class="dropdown-menu">
                                            <li>
                                                @if ($user->classroom?->exists)
                                                    <a href="{{ route('admin.user.show', $user) }}" class="dropdown-item d-flex gap-2 text-center">
                                                        <img src="{{ url("/images/eye.svg")}}" alt="logo en forme d'oeil">
                                                        <span class="fw-semibold">
                                                            Profil & notes
                                                        </span>
                                                    </a>
                                                @endif
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.user.edit', $user) }}" class="dropdown-item d-flex gap-2 text-center">
                                                    <img src="{{ url("/images/edit.svg")}}" alt="logo d'édition">
                                                    <span class='fw-semibold'>
                                                        Modifier
                                                    </span>
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.user.edit', $user) }}" method="post">
                                                    @csrf
                                                    @method("delete")
                                                    <button class="dropdown-item d-flex gap-2 text-center">
                                                        <img src="{{ url("/images/trash-2.svg")}}" alt="logo de suppression">
                                                        <span class="fw-semibold">
                                                            Supprimer
                                                        </span>
                                                    </button>
                                                </form>
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
            <div class="col-md-4">
                <div class="row">
                    <div class="d-flex gap-4 mb-3 align-items-center">
                        <h3>Devoirs</h3>
                        <a href="{{ route('admin.homework.create')}}" class="btn btn-success btn-sm">Ajouter un devoir</a>
                    </div>
                </div>
                @forelse ($classroom->homeworks as $homework)
                <div class="card mb-2" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title fw-bold">{{ $homework->title }}</h5>
                      <hr>
                      {{-- <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6> --}}
                      <p class="card-text">{{ $homework->content }}</p>
                      <a href="{{ route('admin.homework.edit', ['homework'=> $homework->id]) }}" class="card-link">Modifier</a>
                    </div>
                  </div>
                @empty
                <div class="card mb-2" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title fw-bold">Aucun devoir</h5>
                    </div>
                  </div>
                @endforelse
            </div>
        </div>
            @forelse ($classroom->users as $user)

            @empty
                <h2>Aucun élève dans cette classe</h2>
            @endforelse


        {{-- <a href="{{ route('admin.mark.edit', ['mark' => $mark->id, 'user' => $user->id]) }}" class="btn btn-primary">Editer</a> --}}


@endsection
