@extends('admin.base')

@section('title', $homework->exists? 'Editer un devoir' : 'Créer un devoir')

@section('content')

    <h1>@yield('title')</h1>
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary btn-sm my-3 text-end">Retour</a>
    <form class="vstack gap-2" action="{{ route($homework->exists ? 'admin.homework.update' : 'admin.homework.store', ['homework' => $homework]) }}" method='post'>

        @csrf
        @method($homework->exists ? 'put' : 'post' )

        <label for="classe">Classe</label>
        <select class="form-control" id="classroom_id" name="classroom_id" >
        <option value="">Selectionner une classe</option>
            @foreach ($classrooms as $classroom)
                <option @selected(old('classroom_id', $homework->classroom_id ) == $classroom->id) value="{{ $classroom->id }}">{{ $classroom->name }}</option>
            @endforeach
        </select>
        @error('classroom_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        @include('shared.input', ['label'=> "Titre", 'name' => 'title', 'value' => $homework->title])
        @include('shared.input', ['type' => 'textarea', 'label'=> "Contenu", 'name' => 'content', 'value' => $homework->content])

        <div>
            <button class="btn btn-primary">
                @if($homework->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>

    </form>

@endsection
