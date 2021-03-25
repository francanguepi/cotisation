@extends('layouts.app')

@section('content')

    <div class="mt-5">
        <div class="mt-5 card shadow p-3 mb-5 bg-white rounded" >
            <header class="card-header">
            <h3 class="card-header-title">Détails sur l'adhérent(e) <strong>{{$membre->nom}}</strong> <strong>{{$membre->prenom}}</strong></h4>
            </header>
            <div class="card-body">
                <div class="container">
                    <div>
                    <p>Date de naissance : <strong> {{ $membre->dateNaissance }} </strong></p>
                    <p>Télephone : <strong> {{ $membre->tel }} </strong></p>
                    <p>CNI N° <strong> {{ $membre->num_cni }} </strong></p>
                    </div>
                    <hr>
                    <h4>cotisations :</h4>
                    <span><i class="fa fa-exclamation-triangle" aria-hidden="true" style = "color: #38c172;"></i>{{ $message }}</span>
                    @foreach($cotisations as $cotisation)
                        <p>{{ $cotisation->nom}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection