@extends('admin.base')

@section('title', $mark->exists? 'Modifier une note' : 'Créer une note')

@section('content')

    <h1>@yield('title')</h1>
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary btn-sm my-3 text-end">Retour</a>
    @foreach ($users as $user)
        <form class="vstack gap-2" action="{{ route($mark->exists ? 'admin.mark.update' : 'admin.mark.store', ['mark' => $mark,'user' => $user->id]) }}" method='post'>
    @endforeach
            @csrf
            @method($mark->exists ? 'put' : 'post' )

    @foreach ($users as $user)
                <input type="number" name="user_id" id="user_id" value="{{ $user->id }}" hidden>
                <input type="number" name="classroom_id" id="classroom_id" value="{{ $user->classroom->id }}" hidden>
    @endforeach

            <label for="term">Trimestre</label>
            <select class="form-control" id="term" name="term" >
                <option value="">Selectionner un trimestre</option>
                <option @selected(old('term', $mark->term ) == '1') value="1">1</option>
                <option @selected(old('term', $mark->term ) == '2') value="2">2</option>
                <option @selected(old('term', $mark->term ) == '3') value="3">3</option>
            </select>
            @error('term')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <label for="term">Matière</label>
            <select class="form-control" id="subject_id" name="subject_id" >
                <option value="">Selectionner une matière</option>
                    @foreach ($subjects as $subject)
                        <option @selected(old('subject_id', $mark->subject_id ) == $subject->id) value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
                @error('subject_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            @include('shared.input', ['type' => 'number' ,'label'=> "Note", 'name' => 'mark', 'value' => $mark->mark])

            <div>
                <button class="btn btn-success">
                    @if($mark->exists)
                        Modifier
                    @else
                        Créer
                    @endif
                </button>
            </div>

        </form>
@endsection
