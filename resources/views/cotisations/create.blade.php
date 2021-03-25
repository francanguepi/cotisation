<div class="modal fade" id="createCotisationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header card-header">
                    <h2 class="modal-title">Ajouter une nouvelle cotisation</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('cotisations.store') }}">
                        @include('cotisations.formCotisation')
                        
                        <div class="form-group row mb-0 modal-footer">
                            <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




