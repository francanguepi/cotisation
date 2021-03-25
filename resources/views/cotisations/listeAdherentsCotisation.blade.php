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
                    <div class="row container">
                        <h3 class="mr-auto">Liste des adhérents à la cotisation " <strong style = "color : #38c172;">{{ $cotisations->nom }}</strong> "</h3>
                        <div class="card-tools" >
                            <div class="form-group ml-auto"> 
                                <select name="nom_cotisation" id="nom_cotisation" class="form-control @error('nom_cotisation') is-invalid @enderror" onchange="window.location.href = this.value"  required autocomplete="nom_cotisation" autofocus>
                                    <option value="" disabled selected>Toutes Cotisations</option>    
                                    @foreach($listeCotisations as $listeCotisation)                   
                                            <option value="{{ url('cotisations/'.$listeCotisation->id.'') }}">{{ $listeCotisation->nom }}</option>                                    
                                    @endforeach
                                </select>
                                @error('nom_cotisation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class ="card-body table-responsive p-0">
                    <table id = "datatable" class="table">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Téléphone</th>
                                <th>email</th>
                                <th>Numéro de CNI</th>
                                <!-- <th>Quatier</th>
                                <th>Date de naissance</th> -->
                                <th>Enregistrement des cotisations</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($membres as $membre)
                                <tr>
                                    <td>{{ $membre->id }}</td>
                                    <td>{{ $membre->nom }}</td>
                                    <td>{{ $membre->prenom }}</td>
                                    <td>{{ $membre->tel }}</td>
                                    <td>{{ $membre->email }}</td>
                                    <td>{{ $membre->num_cni }}</td>
                                    <td>  
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-money-bill fa-lg"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="0000.00" name="montantCotisation" required>
                                            <a href=""  class="btn btn-success" data-toggle="modal" data-target="#seanceCotisationModal" 
                                            data-id ="{{ $membre->id }}" data-cotisation_id = "{{ $cotisations->id }}"
                                            data-montant = "{{ $cotisations->montant }}"><i class="far fa-save fa-lg"></i></a>

                                        </div>  
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </div>

    @include('cotisations.seanceCotisation')

    <script type="text/javascript">
        
        $("#seanceCotisationModal").on("show.bs.modal", function(event) {
            var bouton = $(event.relatedTarget);
            var montant = bouton.data('montant');
            var idCotisation = bouton.data('cotisation_id');
            var id = bouton.data('id');

            var modal = $(this);

            modal.find('.modal-body #montant_cotise').val(montant);
            modal.find('.modal-body #cotisation_id').val(idCotisation);
            modal.find('.modal-body #membre_id').val(id);
        });
            
        
    </script>

    @endsection