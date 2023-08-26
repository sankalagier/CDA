@extends('student.base')

@section('title', 'Mes notes')

@php
    // On vérifie si on récupère le trimestre choisi dans la requete, si oui on l'associe à actual_term, sinon actual_term est nulle
    if(isset($input['term'])){
        $actual_term = $input['term'];
    }else {
        $actual_term = null;
    };
@endphp

@section('content')

    <h1 class="mb-4">@yield('title')</h1>
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary btn-sm my-3 text-end">Retour</a>
    <div class="ms-auto w-25 mb-2">
        <form action="" method="get" class="container d-flex gap-2 justify-content-end">
            {{-- Afficher les trois trimestres, celui choisi devient l'option selectionnée --}}
            <select name="term" id="term" class="form-control">
                <option @selected(old('term', '1') == $actual_term) value="1">Trimestre 1</option>
                <option @selected(old('term', '2') == $actual_term) value="2">Trimestre 2</option>
                <option @selected(old('term', '3') == $actual_term) value="3">Trimestre 3</option>
            </select>
            <button class="btn btn-success btn-sm">Choisir</button>
        </form>
    </div>

    <div class="table-responsive-sm">
        <table class="table table-striped">
            <thead>
                <th>Matière</th>
                <th>Notes</th>
                <th>Moyenne</th>
                <th>Moyenne - classe</th>
            </thead>
            <tbody>
                {{-- Afficher chaque matières --}}
                @foreach ($subjects as $subject)
                    <tr>
                        <th>{{ $subject->name }}</th>
                        <td>
                            {{-- Afficher chaque note appartenant a chaque matières --}}
                        @foreach ($user_marks as $mark)
                            @if ($mark->subject->name === $subject->name)
                                    <span class="fw-semibold">{{ round($mark->mark, 2) }}</span>,
                            @endif
                        @endforeach
                        </td>
                        {{-- Afficher la moyenne de chaque matière si il y a des notes --}}
                        <td class="fw-semibold">
                            @if (!$user->marks->where('subject_id',$subject->id)->where('term',$actual_term??1)->avg('mark') == "")
                                {{ round($user->marks->where('subject_id',$subject->id)->where('term',$actual_term??1)->avg('mark'), 2) }}
                            @endif
                        </td>
                        {{-- Afficher la moyenne de la classe pour chaque matières si il y a des notes --}}
                        <td class="fw-semibold">
                            @if (!$marks->where('classroom_id',$user->classroom_id)->where('subject_id',$subject->id)->where('term',$actual_term??1)->avg('mark') == "")
                                {{ round($marks->where('classroom_id',$user->classroom_id)->where('subject_id',$subject->id)->where('term',$actual_term??1)->avg('mark'), 2) }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                {{-- Afficher la moyenne générale individuelle et celle de la classe --}}
                <tr>
                    <th colspan="2">Moyenne générale :</th>
                    <td class="fw-semibold"><span class="badge bg-primary bg-opacity-75">{{ round($user->marks->where('term',$actual_term??1)->avg('mark'), 2) }}</span></td>
                    <td class="fw-semibold"><span class="badge bg-success bg-opacity-75">{{ round($marks->where('classroom_id',$user->classroom_id)->where('term',$actual_term??1)->avg('mark'), 2) }}</span></td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
