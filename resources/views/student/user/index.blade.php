@extends('student.base')

@section('title', 'Bonjour, '.$user->name)

@section('content')

    <h1>@yield('title')</h1>
        <div class="row justify-content-between mt-5">
            <div class="col-md-4 mb-5">
                <span class="fs-4 fw-semibold">Dernières notes :</span>
                <hr>
                <table class="table table-hover table-sm">
                    {{-- Afficher les 4 dernières notes s'il y en a --}}
                @forelse ($marks as $mark)
                    <tr>
                        <td class="fw-semibold">
                            {{ $mark->subject->name }}
                            <br>
                            <span class="fs-6 fw-light">le {{ $mark->created_at->format('d-m-Y') }}</span>
                        </td>
                            <td><span class="badge bg-success">{{ $mark->mark }}</span></td>
                    </tr>
                @empty
                    <tr>
                        <td class="fw-semibold">Aucune note</td>
                    </tr>
                @endforelse
                </table>
                <a href="{{ route('student.show')}}">Voir plus</a>
            </div>
            <div class="col-md-6">
                <span class="fs-4 fw-semibold">Travail à faire :</span>
                {{-- Afficher les devoirs --}}
                @forelse ($homeworks as $homework)
                    <div class="card card-text-bg-light mt-3 mb-2" style="width: 18rem;">
                        <div class="card-header text-bg-success fw-semibold fs-5">{{ $homework->title }}</div>
                        <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-body-secondary fw-normal">Le {{ $homework->created_at->format('d/m') }}</h6>
                        <p class="card-text fw-semibold">{{ $homework->content }}</p>
                        </div>
                    </div>
                @empty
                    <div class="card mb-2" style="width: 18rem;">
                        <div class="card-body">
                        <h5 class="card-title fw-bold">Aucun devoir</h5>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

@endsection
