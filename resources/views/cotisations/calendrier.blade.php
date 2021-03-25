@extends('layouts.app')

@section('content')

    <div class = "row mt-5">
        <div class ="col-md-12">
            <div class ="card shadow p-3 mb-5 bg-white rounded">
                <div class ="card-header">
                    <div class="row">

                        <h3 class="mr-auto" style = "margin-left: 20px;">Calendrier de reception de la cotisation " <strong style = "color : #38c172;    ">{{ $cotisation->nom }}</strong> "</h3>
                        <div class="card-tools" >
                            <form action="{{ url('cotisations/reorganiserCotisation/calendrier/updateCalendrier')}}" class = "ml-auto" method="POST">
                                @csrf
                                <input type="hidden"  id = "cotisation_id" name = "cotisation_id" class ="form-control mb-2" value ="{{ $cotisation->id }}" name = "cotisation_id">
                                <button type="submit" class="btn btn-success mb-2" style = "margin-right: 20px;">actualiser</button>
                            </form>   
                        </div>
                    </div>
                    
                </div>
                <div class ="card-body table-responsive p-0">
                    <table id = "datatable" class="table">
                        <thead>
                            <tr>
                                <!-- <th>N°</th> -->
                                <th>Nom et Prenoms</th>
                                <th>Date de reception</th>
                                <th>montant à recevoir</th>
                                <th>Recu</th>
                                <th>Calendrier</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($calendrierReception as $ordreReception)
                            <tr>
                                <td>{{ app('App\Http\Controllers\MembresController')->getMember($ordreReception->membre_id)->nom  }}
                                {{ app('App\Http\Controllers\MembresController')->getMember($ordreReception->membre_id)->prenom  }}</td>
                                <td><strong>{{ $ordreReception->jour_reception }}</strong></td>
                                <td><strong>{{ $ordreReception->montant_reçu }}</strong></td>
                                <td>
                                    <strong>
                                    @if ($ordreReception->recu == 1)
                                        oui
                                    @else
                                        non
                                    @endif
                                    </strong>
                                </td>
                                <td>
                                    <strong>
                                    @if ($ordreReception->calendrier == 1)
                                        oui
                                    @else
                                        non
                                    @endif
                                    </strong>
                                </td>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </div>
    @endsection