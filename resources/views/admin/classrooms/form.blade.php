@extends('admin.base')

@section('title', $classroom->exists? 'Editer une classe' : 'Créer une classe')

@section('content')

    <h1>@yield('title')</h1>
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary btn-sm my-3 text-end">Retour</a>
    <form class="vstack gap-2" action="{{ route($classroom->exists ? 'admin.classroom.update' : 'admin.classroom.store', ['classroom' => $classroom]) }}" method='post'>

        @csrf
        @method($classroom->exists ? 'put' : 'post' )

        @include('shared.input', ['label'=> "Nom", 'name' => 'name', 'value' => $classroom->name])

        <div>
            <button class="btn btn-primary">
                @if($classroom->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>

    </form>

@endsection
