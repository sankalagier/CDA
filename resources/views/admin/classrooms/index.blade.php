@extends('admin.base')

@section('title','Toutes les classes')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a href="{{ route('admin.classroom.create')}}" class="btn btn-primary btn-sm">Ajouter une classe</a>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-info">
            <tr>
                <th>Nom</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classrooms as $classroom)
                <tr>
                    <td class="fw-semibold fs-5">
                        <a href="{{ route('admin.classroom.show',['classroom' => $classroom->id]) }}" class="badge bg-primary text-decoration-none link-light">{{ $classroom->name }}
                        </a>
                    </td>
                    <td>
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <div class="btn-group">
                                <div class="dropdown" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                                    <img src="{{ url("/images/more-horizontal.svg")}}" alt="">
                                </div>
                                <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('admin.classroom.show', $classroom) }}" class="dropdown-item d-flex gap-2 text-center">
                                        <img src="{{ url("/images/eye.svg")}}" alt="logo en forme d'oeil">
                                        <span class="fw-semibold">
                                            Voir classe
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.classroom.edit', $classroom) }}" class="dropdown-item d-flex gap-2 text-center">
                                        <img src="{{ url("/images/edit.svg")}}" alt="logo d'édition">
                                        <span class='fw-semibold'>
                                            Modifier
                                        </span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('admin.classroom.destroy', $classroom)}}" method="post">
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

    {{ $classrooms->links() }}

@endsection('content')
