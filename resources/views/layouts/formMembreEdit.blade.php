@csrf
<div class="form-group row">
    <label for="nom" class="col-md-4 col-form-label text-md-right">Nom</label>
    <div class="col-md-6">
        <input id="nom" type="text" class="form-control @error('name') is-invalid @enderror" name="nom" value="{{$membre->nom }}" required autocomplete="nom" autofocus>
        @error('nom')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="prenom" class="col-md-4 col-form-label text-md-right">Prenom</label>
    <div class="col-md-6">
        <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{$membre->prenom }}"  required autocomplete="prenom" autofocus>
        @error('prenom')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="tel" class="col-md-4 col-form-label text-md-right">Téléphone</label>
    <div class="col-md-6">
        <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{$membre->tel }}" required autocomplete="tel" autofocus>

        @error('tel')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$membre->email }}" required autocomplete="email" autofocus>

        @error('email')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="num_cni" class="col-md-4 col-form-label text-md-right">Numéro CNI</label>

    <div class="col-md-6">
        <input id="num_cni" type="text" class="form-control @error('num_cni') is-invalid @enderror" name="num_cni" value="{{ $membre->num_cni }}" required autocomplete="num_cni" autofocus>

        @error('num_cni')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="quartier" class="col-md-4 col-form-label text-md-right">Quartier</label>

    <div class="col-md-6">
        <input id="quartier" type="text" class="form-control @error('quartier') is-invalid @enderror" name="quartier" value="{{ $membre->quartier}}" required autocomplete="num_cni" autofocus>

        @error('quartier')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
<label for="dateNaissance" class="col-md-4 col-form-label text-md-right">Date de naissance</label>

    <div class="col-md-6">
        <input id="dateNaissance" type="date" class="form-control @error('dateNaissance') is-invalid @enderror" name="dateNaissance" value="{{ $membre->dateNaissance }}" required autofocus>

        @error('dateNaissance')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<input type="hidden" id = "id" name = "id">
