<div class="modal fade" id="registerMemberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header card-header">
                    <h2 class="modal-title">Inscrire un membre</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('cotisations/'.$cotisation->id.'') }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                            <label for="membre" class="col-md-4 col-form-label text-md-right">Selectionner un membre</label>

                            <div class="col-md-6">
                            <select name="membre" id="membre" class="form-control @error('membre') is-invalid @enderror"  value="{{ old('membre') }}" required autocomplete="membre" autofocus>
                                @foreach($noms as $nom)                   
                                    <option value="{{ $nom->id }}"> <span>{{ $nom->nom }}</span> <span> </span> <span>{{ $nom->prenom}}</span></option>                                    
                                @endforeach
                            </select>
                            @error('membre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        
                        <input type="hidden" id = "id" name = "id">
                        <div class="form-group row mb-0 modal-footer">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Inscrire</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

                