
                <div class="modal fade" id="editMemberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header card-header">
                                <h2 class="modal-title">Modifier le membre</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id ="editForm" method="POST" action="{{ url('membres/'.$membre->id.'') }}">
                                    @method('PATCH')
                                    @include('layouts.formMembreEdit')

                                    <div class="form-group row mb-0 modal-footer">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">Modifier</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
                