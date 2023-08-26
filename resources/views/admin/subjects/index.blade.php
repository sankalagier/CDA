@extends('admin.base')

@section('title','Toutes les matières')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a href="{{ route('admin.subject.create')}}" class="btn btn-primary btn-sm">Ajouter une matière</a>
    </div>

    <table class="table table-primary table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)
                <tr>
                    <td class="fw-semibold">{{ $subject->name }}</td>
                    <td>
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <div class="btn-group">
                                <div class="dropdown" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                                    <img src="{{ url("/images/more-horizontal.svg")}}" alt="">
                                </div>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('admin.subject.edit', $subject) }}" class="dropdown-item d-flex gap-2 text-center">
                                            <img src="{{ url("/images/edit.svg")}}" alt="logo d'édition">
                                            <span class='fw-semibold'>
                                                Modifier
                                            </span>
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.subject.destroy', $subject)}}" method="post">
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

    {{ $subjects->links() }}

@endsection('content')
