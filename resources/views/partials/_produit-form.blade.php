{{-- directive CSRF pour protéger les données du formulaire --}}
@csrf

{{-- désignation --}}
<div class="form-group">
  <label for="">Désignation :</label>
  <input type="text" name="designation" id="designation" class="form-control" placeholder="" aria-describedby="helpId" required value="{{ old('designation') ??$produit->designation }}">
  @error("designation")
    <small class="text-danger">{{  $message }}</small>
  @enderror 
</div>

{{-- prix --}}
<div class="form-group">
  <label for="prix">Prix :</label>
  <input type="number" name="prix" id="prix" class="form-control" placeholder="" aria-describedby="helpId" required value="{{ old('prix') ?? $produit->prix }}">
  @error("prix")
    <small class="text-danger">{{  $message }}</small>
  @enderror
</div>

{{-- quantité --}}
<div class="form-group">
  <label for="quantite">Quantité :</label>
  <input type="number" name="quantite" id="quantite" class="form-control" placeholder="" aria-describedby="helpId" required value="{{ old('quantite') ?? $produit->quantite }}">
  @error("quantite")
    <small class="text-danger">{{  $message }}</small>
  @enderror
</div>

{{-- catégorie --}}
<div class="form-group">
  <label for="category_id">Catégorie :</label>
  <select class="form-control" name="category_id" id="category_id" required>
    @foreach ($categories as $categorie)
        <option value="{{ $categorie->id }}" {{ $categorie->id == $produit->category_id ? "selected" : "" }}>{{ $categorie->libelle }}</option>
    @endforeach
  </select>
  @error("category_id")
    <small class="text-danger">{{  $message }}</small>
  @enderror
</div>

{{-- description --}}
<div class="form-group">
  <label for="description">Description :</label>
  <textarea class="form-control" name="description" id="description" rows="3">{{ old('description') ?? $produit->description }}</textarea>
</div>

{{-- image --}}
<div class="form-group">
  <label for="">Image</label>
  <input type="file" class="form-control-file" name="image" id="image" placeholder="" aria-describedby="fileHelpId">
  @error("image")
    <small class="text-danger">{{  $message }}</small>
  @enderror
</div>

{{-- bouton de validation --}}
<button type="submit" class="btn btn-primary btn-block btn-lg mt-4">Valider</button>