@extends('admin.base')

@section('title', 'Modifier un utilisateur')

@section('content')

    <h1>@yield('title')</h1>
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary btn-sm my-3 text-end">Retour</a>

    <ul class="list-unstyled">
        <li>Nom : {{ $user->name }}</li>
        <li>Email : {{ $user->email }}</li>
        <li>Role : {{ $user->role }}</li>
    </ul>
    <form class="vstack gap-2" action="{{ route('admin.user.update', ['user'=>$user]) }}" method="post">

        @csrf
        @method($user->exists ? 'put' : 'post')
        <label for="classe">Classe</label>
        <select class="form-control" id="classroom_id" name="classroom_id" >
        <option value="">Selectionner une classe</option>
            @foreach ($classrooms as $classroom)
                <option @selected(old('classroom_id', $user->classroom_id ) == $classroom->id) value="{{ $classroom->id }}">{{ $classroom->name }}</option>
            @endforeach
        </select>
        @error('classroom_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        <label for="role">Role</label>
        <select class="form-control" id="role" name="role" >
            {{-- <option value="">Selectionner un rôle</option> --}}
            <option @selected(old('role', $user->role ) == 'user') value="user">Utilisateur</option>
            <option @selected(old('role', $user->role ) == 'student') value="student">Élève</option>
            <option @selected(old('role', $user->role ) == 'admin') value="admin">Administrateur</option>
        </select>
        @error('role')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        {{-- @include('shared.select', ['name' => 'classe_id', 'label' => 'Classe', 'value' => $user->classes()->pluck('id'), "classes" => $classes]) --}}

        <div>
            <button class="btn btn-primary">Modifier</button>
        </div>

    </form>

@endsection
