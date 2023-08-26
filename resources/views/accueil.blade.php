@extends('layout')

@section('title','Accueil')

@section('content')
    <div class="container col-xxl-8 px-4 py-5 mt-3 rounded-5 shadow">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        @guest
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="{{ url("/images/landing.png")}}" class="d-block mx-lg-auto img-fluid rounded-4" alt="Deux personnes debout dans une pièce à coté d'une personne assise" width="700" height="500" loading="lazy">
        </div>

            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-4">Bienvenue sur <br><span class="fst-italic text-success"> La Note Parfaite</span> ! </h1>
                <p class="lead mb-4">Ici, vous avez à votre disposition un suivi de votre scolarité ! En passant des <span class="fw-semibold">notes</span>, à la <span class="fw-semibold">moyenne générale</span>, aux <span class="fw-semibold">devoirs</span>, vous serez constamment <span class="fw-semibold">à jour</span> ! </p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="{{ route('login') }}" class="btn btn-success btn-lg d-flex justify-content-center align-items-center px-4 mb-2 me-md-2">Se connecter</a>
                <p>Vous n'avez pas de compte? <br>
                    <a href="{{ route('register') }}">S'inscrire</a>
                </p>
                </div>
            </div>
        @endguest
        @auth
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="{{ url("/images/landing3.png")}}" class="d-block mx-lg-auto img-fluid rounded-4" alt="Personne assise dans une pièce devant un ordinateur portable sur une table" width="700" height="500" loading="lazy">
        </div>
        <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-4">Patience ! </h1>
                <p class="lead mb-4">Votre inscription est <span class="fw-semibold">en cours</span> , vous n'avez pas encore été <span class="fw-semibold">reconnu</span> en tant qu'<span class="fw-semibold">élève</span>. L'identification se fait <span class="fw-semibold">manuellement</span>, cela peut prendre un <span class="fw-semibold">moment</span>, merci de votre compréhension ! </p>
                <div class="d-flex justify-content-center mt-5">
                    <div class="spinner-grow text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        @endauth
        </div>
    </div>
@endsection
