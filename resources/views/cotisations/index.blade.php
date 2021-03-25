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
                        <div class ="col-md-4"><h3>Liste des cotisations </h3></div>
                        <div class ="col-md-6"></div>
                        <div class="card-tools col-md-2" >
                            <button href="{{ url('cotisations/create') }}" class="btn btn-success" data-toggle="modal" 
                                data-target="#createCotisationModal"> Ajouter <i class="fas fa-user-plus fa-fw"></i> 
                            </button>
                        </div>
                    </div>
                </div>
                <div class ="card-body table-responsive p-0">
                    <table class="table is-hoverable">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Montant</th>
                                <th>Pénalité</th>
                                <th>Membres</th>
                                <th>Actions</th>
                                <th>Calendrier</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cotisations as $cotisation)
                                <tr>
                                    <td>{{ $cotisation->id }}</td>
                                    <td><strong>{{ $cotisation->nom }}</strong></td>
                                    <td><strong>{{ $cotisation->type }}</strong></td>
                                    <td><strong>{{ $cotisation->date_debut }}</strong></td>
                                    <td><strong>{{ $cotisation->heure_debut }}</strong></td>
                                    <td><strong>{{ $cotisation->montant }}</strong></td>
                                    <td><strong>{{ $cotisation->penalite }}</strong></td>
                                    <td><strong>{{ $cotisation->membres_inscrits }}</strong></td>

                                    <td>
                                        <a class="btn btn-primary" data-toggle="modal" 
                                        data-target="#registerMemberModal" data-id = "{{ $cotisation->id }}" data-membres_inscrits = "{{ $cotisation->membres_inscrits }}" data-nom ="{{ $cotisation->nom }}"><i class="fas fa-user-edit fa-lg"></i></a>
                                        <form action="{{ url('cotisations/'.$cotisation->id.'') }}" method="POST" style = "display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-user-times fa-lg"></i></button>
                                        </form>
                                        <a href="{{ url('cotisations/'.$cotisation->id.'') }}"  class="btn btn-info"><i class="fa fa-info-circle fa-lg" aria-hidden="true" style = "color : white"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{ url('cotisations/'.$cotisation->id.'/calendrier') }}"><img src="{{ asset('images/icons_calendrier.png' )}}" width="40"></a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class = "row mt-3 justify-content-center pagination">
        {{ $cotisations->links() }}
        
    </div>

    
    @include('cotisations.create')
    @include('cotisations.inscriptionMembre')
    
    <script type="text/javascript">
        $("#registerMemberModal").on("show.bs.modal", function(event) {
            var bouton = $(event.relatedTarget);
            var membres_inscrits = bouton.data('membres_inscrits');
            var id = bouton.data('id');
            var nom = bouton.data('nom');

            var modal = $(this);

            modal.find('.modal-body #membres_inscrits').val(membres_inscrits);
            modal.find('.modal-body #id').val(id);

        });
    </script>

@endsection