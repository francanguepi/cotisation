@extends('layouts.app')

@section('content')

    <div class = "row mt-5">
        <div class ="col-md-12">
            <div class ="card shadow p-3 mb-5 bg-white rounded">
                <div class ="card-header">
                    <div class="row container">
                        <div class ="col-md-4"><h3>Liste des membres </h3></div>
                        <div class ="col-md-6"></div>
                        <div class="card-tools col-md-2" >
                            <!-- show members -->
                            <button href="{{ url('membres/create') }}" class="btn btn-success" data-toggle="modal" 
                            data-target="#createMemberModal"> Ajouter <i class="fas fa-user-plus fa-fw"></i> </button>
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
                                <th>Poste</th>
                                <!-- <th>Numéro de CNI</th> -->
                                <th>Quatier</th>
                                <th>Date de naissance</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($membres as $membre)
                                <tr>
                                    <td>{{ $membre->id }}</td>
                                    <td><strong>{{ $membre->nom }}</strong></td>
                                    <td><strong>{{ $membre->prenom }}</strong></td>
                                    <td><strong>{{ $membre->tel }}</strong></td>
                                    <td><strong>{{ $membre->poste }}</strong></td>
                                    <!-- <td><strong>{{ $membre->num_cni }}</strong></td> -->
                                    <td><strong>{{ $membre->quartier }}</strong></td>
                                    <td><strong>{{ $membre->dateNaissance }}</strong></td>
                                    <td>
                                        <!-- <a href = "{{ url('membres/'.$membre->id.'/edit') }}" class="btn btn-primary edit"  data-toggle="modal" data-id ="{{ $membre->id }}" data-target="#editMemberModal">editer</a> -->
                                        <a href = "{{ url('membres/'.$membre->id.'/edit') }}" class="btn btn-primary edit"  data-toggle="modal" data-target="#editMemberModal" data-id ="{{ $membre->id }}"
                                        data-nom = "{{ $membre->nom }}" data-prenom = "{{ $membre->prenom }}" data-tel = "{{ $membre->tel }}" data-email = "{{ $membre->email }}"
                                        data-num_cni = "{{ $membre->num_cni }}" data-quartier = "{{ $membre->quartier }}" data-dateNaissance = "{{ \Carbon\Carbon::parse($membre->dateNaissance)->format('d/m/Y') }}"><i class="fas fa-user-edit fa-lg"></i></a>

                                        <form action="{{ url('membres/'.$membre->id.'') }}" method="POST" style = "display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-user-times fa-lg"></i></button>
                                        </form>
                                        <a href="{{ url('membres/'.$membre->id.'') }}"  class="btn btn-info"><i class="fa fa-info-circle fa-lg" aria-hidden="true" style = "color : white"></i></a>


                                    </td>     
                                </tr>
                            @endforeach
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </div>
    <div class = "row mt-3 justify-content-center ">
        {{ $membres->links() }}
    </div>                                                        

    @include('membres.create')
    @include('membres.edit')

    <script type="text/javascript">
        
        $("#editMemberModal").on("show.bs.modal", function(event) {
            var bouton = $(event.relatedTarget);
            var nom = bouton.data('nom');
            var prenom = bouton.data('prenom');
            var tel = bouton.data('tel');
            var email = bouton.data('email');
            var quartier = bouton.data('quartier');
            var num_cni = bouton.data('num_cni');
            var id = bouton.data('id');

            
            var modal = $(this);

            modal.find('.modal-body #nom').val(nom);
            modal.find('.modal-body #prenom').val(prenom);
            modal.find('.modal-body #tel').val(tel);
            modal.find('.modal-body #email').val(email);
            modal.find('.modal-body #quartier').val(quartier);
            modal.find('.modal-body #num_cni').val(num_cni);
            modal.find('.modal-body #id').val(id);
        });
 
        
    </script>
@endsection