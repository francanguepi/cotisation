<div class="modal fade" id="seanceCotisationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header card-header">
                    <h2 class="modal-title">Séance du cotisation </h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('cotisations/seanceCotisation') }}">
                        @csrf
                        
                        <h3 class = "row alert alert-info" role = "alert">Voulez-vous valider cette cotisation ?</h3>
                        <input type="hidden" id = "membre_id" name = "membre_id">
                        <input type="hidden" id = "cotisation_id" name = "cotisation_id">
                        <input type="hidden" id = "montant_cotise" name = "montant_cotise">
                          
                        <div class="form-group row mb-0 modal-footer">
                            <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">Valider</button>
                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




