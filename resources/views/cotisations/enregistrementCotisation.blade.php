@extends('layouts.app')

@section('content')

    <div class = "row mt-5">
        @if (session('status'))
            <div class = "row alert alert-danger" role = "alert" style = "margin-left : 15px;">
                {{ session('status')}}
            </div>
        @endif
        <div class ="col-md-12">
            <div class ="card shadow p-3 mb-5 bg-white rounded">
                <div class ="card-header">
                    <div class="row">
                        <h3 class="mr-auto">Cotisations des adhérents à " <strong style = "color : #38c172;">{{ $cotisation->nom }}</strong> "</h3>
                        <div class="card-tools" >
                            <form action="{{ url('cotisations/cotisation/afficherSeanceCotisation') }}" class = "ml-auto" method="POST">
                                @csrf
                                <div class="form-row"> 
                                    <div class=" col-auto">
                                        <input type="hidden"  id = "cotisation_id" name = "cotisation_id" class ="form-control mb-2" value ="{{ $cotisation->id }}" name = "cotisation_id">
                                    </div>
                                    <div class="col-auto">
                                        <input id="dateCotisation" name = "dateCotisation" type="date" class="form-control mb-4 @error('dateCotisation') is-invalid @enderror" name="dateCotisation" value="{{ old('dateCotisation') }}" required autofocus>
                                        @error('dateCotisation')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-success mb-2"><i class="fas fa-search"></i></button>
                                    </div>
                                    
                                </div>
                            </form>
                            
                        </div>
                    </div>
                    
                </div>
                <div class ="card-body table-responsive p-0">
                    <table id = "datatable" class="table">
                        <thead>
                            <tr>
                                <th>Nom et Prenoms</th>
                                <th>{{date('d-m-Y', strtotime($dateCotisation))}}</th>
                                <th>Pénalité</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($seancesCotisations as $seanceCotisation)
                <tr>
                    <td>
                        {{  app('App\Http\Controllers\MembresController')->getMember($seanceCotisation->membre_id)->nom }}
                        {{ app('App\Http\Controllers\MembresController')->getMember($seanceCotisation->membre_id)->prenom }}
                    </td>
                    <td><strong>{{ $seanceCotisation->montant_cotise }}</strong></td>
                    <td><strong>
                        @if ($seanceCotisation->penalite == 1)
                            oui
                        @else
                            non
                        @endif
                    </strong></td>

                </tr>
            @endforeach
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </div>
    <h5 class = "mt-5" style = "color : #38c172;">Liste des adhérents n'ayant pas cotisé</h5>
    <div>
        @if(count($adherentsNonCotises) > 0)
            <ul>
                @foreach ($adherentsNonCotises as $adherentNonCotise)
                    <li> 
                        {{ app('App\Http\Controllers\MembresController')->getMember($adherentNonCotise)->nom }}
                        {{ app('App\Http\Controllers\MembresController')->getMember($adherentNonCotise)->prenom }}
                    </li>
                @endforeach 
            </ul>
        @else
            <p>Tout les ahérents ont déjà cotisé pour cette séance</p>
        @endif  
    </div>
@endsection
