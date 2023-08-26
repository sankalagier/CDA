@extends('admin.base')

@section('title', 'Détails d\'utilisateur ')

@section('content')
    <h1>@yield('title')</h1>

    <p><span class='fw-semibold'> Nom </span>: {{ $user->name }}</p>
    <p><span class='fw-semibold'> Email </span>: {{ $user->email }}</p>
    <p><span class='fw-semibold'> Classe </span>: {{ $user->classroom?->name}}</p>
    {{-- Revenir sur la page précedente --}}
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary btn-sm my-3 text-end">Retour</a>
    <a href="{{ route('admin.mark.create', ['user' => $user]) }}" class="btn btn-primary btn-sm">Ajouter une note</a>
    <table class='table table-striped'>
        <thead class='with-larasort'>
            {{-- Tête de tableau avec sortablelink afin d'ordonner par ordre croissant / décroissant --}}
            <tr>
                <th>@sortableLink('subject_id','Matière')</th>
                <th>@sortableLink('term','Trimestre')</th>
                <th>@sortableLink('mark','Note')</th>
                <th>@sortableLink('created_at','Ajoutée le')</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- Afficher chaque note dans un tableau --}}
            @foreach ($marks as $mark)
                <tr>
                    <td>{{ $mark->subject->name}}</td>
                    <td>{{ $mark->term}}</td>
                    <td>{{ $mark->mark}}</td>
                    <td>{{ $mark->created_at->format('d-m-Y')}}</td>
                    <td>
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <div class="btn-group">
                                <div class="dropdown" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                                    <img src="{{ url("/images/more-horizontal.svg")}}" alt="">
                                </div>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('admin.mark.edit', ['mark' => $mark->id, 'user' => $user->id]) }}" class="dropdown-item d-flex gap-2 text-center">
                                            <img src="{{ url("/images/edit.svg")}}" alt="logo d'édition">
                                            <span class='fw-semibold'>
                                                Modifier
                                            </span>
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.mark.destroy', $mark->id)}}" method="post">
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
@endsection
