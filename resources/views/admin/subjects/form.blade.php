@extends('admin.base')

@section('title', $subject->exists? 'Editer une matière' : 'Créer une matière')

@section('content')

    <h1>@yield('title')</h1>
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary btn-sm my-3 text-end">Retour</a>
    <form class="vstack gap-2" action="{{ route($subject->exists ? 'admin.subject.update' : 'admin.subject.store', ['subject' => $subject]) }}" method='post'>

        @csrf
        @method($subject->exists ? 'put' : 'post' )

        @include('shared.input', ['label'=> "Nom", 'name' => 'name', 'value' => $subject->name])

        <div>
            <button class="btn btn-primary">
                @if($subject->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>

    </form>

@endsection
