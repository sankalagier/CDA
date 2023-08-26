@extends('admin.base')

@section('title','Tous les devoirs')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a href="{{ route('admin.homework.create')}}" class="btn btn-primary btn-sm">Ajouter un devoir</a>
    </div>

    <table class="table table-primary table-striped table-hover">
        <thead class="with-larasort">
            <tr>
                <th>@sortableLink('classroom_id','Classe')</th>
                <th>@sortableLink('title','Nom')</th>
                <th>@sortableLink('content','Contenu')</th>
                <th>@sortableLink('created_at','Ajouté le')</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($homeworks as $homework)
                <tr>
                    <td>
                        <a href="{{ route('admin.classroom.show',['classroom' => $homework->classroom?->id]) }}" class="badge bg-primary text-decoration-none link-light">
                            {{ $homework->classroom?->name }}
                        </a>
                    <td>{{ $homework->title }}</td>
                    <td>{{ $homework->content }}</td>
                    <td>{{ $homework->created_at->format('d-m-Y') }}</td>
                    <td>
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <div class="btn-group">
                                <div class="dropdown" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                                    <img src="{{ url("/images/more-horizontal.svg")}}" alt="">
                                </div>
                                <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('admin.classroom.show', $homework->classroom->id) }}" class="dropdown-item d-flex gap-2 text-center">
                                        <img src="{{ url("/images/eye.svg")}}" alt="logo en forme d'oeil">
                                        <span class="fw-semibold">
                                            Voir classe
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.homework.edit', $homework) }}" class="dropdown-item d-flex gap-2 text-center">
                                        <img src="{{ url("/images/edit.svg")}}" alt="logo d'édition">
                                        <span class='fw-semibold'>
                                            Modifier
                                        </span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('admin.homework.destroy', $homework)}}" method="post">
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

    {{ $homeworks->links() }}

@endsection('content')
