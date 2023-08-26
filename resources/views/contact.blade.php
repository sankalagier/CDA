@extends('layout')

@section('title','Nous Contacter')

@section('content')
    <div class="container col-xxl-8 px-4 py-5 mt-3 rounded-5 shadow">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
            <img src="{{ url("/images/contact.png")}}" class="d-block mx-lg-auto img-fluid rounded-4" alt="Personne assise dans une pièce devant un ordinateur portable sur une table" width="700" height="500" loading="lazy">
            </div>
            @guest
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold lh-1 mb-4">Nous contacter </h1>
                    <p class="lead mb-4">Un message à nous <span class="fw-semibold">transmettre</span> ? Envoyez le ci <span class="fw-semibold">dessous</span>, nous vous répondrons <span class="fw-semibold">dès que possible !</span> </p>
                    <div>
                        <form action="{{ route('contact.send') }}" method="post" class="vstack gap-3">
                            @csrf
                            <div class="row">
                                @include('shared.input',['class'=> 'col', 'name' => 'name', 'label' => 'Nom & Prénom'])
                                @include('shared.input',['type'=> 'email', 'class'=> 'col', 'name' => 'email', 'label' => 'Email'])
                            </div>
                            @include('shared.input',['type'=> 'textarea', 'class'=> 'col', 'name' => 'message', 'label' => 'Votre message'])
                            <div>
                                <button class="btn btn-success">Nous contacter</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endguest
            @auth
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold lh-1 mb-4">Nous contacter </h1>
                    <p class="lead mb-4">Un message à nous <span class="fw-semibold">transmettre</span> ? Envoyez le ci-<span class="fw-semibold">dessous</span>, nous vous répondrons <span class="fw-semibold">dès que possible !</span> </p>
                    <div>
                        <form action="{{ route('contact.send') }}" method="post" class="vstack gap-3">
                            @csrf
                            <div class="row">
                                @include('shared.input',['class'=> 'col', 'name' => 'name', 'label' => 'Nom & Prénom', 'attribute'=> 'hidden', 'value'=> Auth::user()->name])
                                @include('shared.input',['type'=> 'email', 'class'=> 'col', 'name' => 'email', 'label' => 'Email', 'attribute'=> 'hidden','value'=> Auth::user()->email])
                            </div>
                            @include('shared.input',['type'=> 'textarea', 'class'=> 'col', 'name' => 'message', 'label' => 'Votre message'])
                            <div>
                                <button class="btn btn-success">Nous contacter</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endauth

        </div>
    </div>
@endsection
