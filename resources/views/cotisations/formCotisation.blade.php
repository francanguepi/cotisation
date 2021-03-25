@csrf
<div class="form-group row">
    <label for="nom" class="col-md-4 col-form-label text-md-right">Nom</label>
    <div class="col-md-6">
        <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autocomplete="nom" autofocus>
        
        @error('nom')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
    <div class="col-md-6">
        <select name="type" id="type" class="form-control @error('type') is-invalid @enderror"  value="{{ old('type') }}" required autocomplete="statut" autofocus>
            <option value="journaliere">journalière</option>
            <option value="hebdommadaire">hebdommadaire</option>
            <option value="mensuelle">mensuelle</option>
        </select>
        @error('type')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="date_debut" class="col-md-4 col-form-label text-md-right">Date de début</label>
    <div class="col-md-6">
        <input id="date_debut" type="date" class="form-control @error('date_debut') is-invalid @enderror" name="date_debut" value="{{ old('date_debut') }}" required autofocus>

        @error('date_debut')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="heure_debut" class="col-md-4 col-form-label text-md-right">Heure de début</label>
    <div class="col-md-6">
        <input id="heure_debut" type="time" class="form-control @error('heure_debut') is-invalid @enderror" name="heure_debut" value="{{ old('date_debut') }}" required autofocus>

        @error('heure_debut')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="montant" class="col-md-4 col-form-label text-md-right">Montant</label>
    <div class="col-md-6">
        <input id="montant" type="text" class="form-control @error('tel') is-invalid @enderror" name="montant" value="{{ old('montant') }}" required autocomplete="tel" autofocus>

        @error('montant')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="penalite" class="col-md-4 col-form-label text-md-right">Pénalité</label>
    <div class="col-md-6">
        <input id="penalite" type="text" class="form-control @error('tel') is-invalid @enderror" name="penalite" value="{{ old('penalite') }}" required autocomplete="tel" autofocus>

        @error('penalite')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>




