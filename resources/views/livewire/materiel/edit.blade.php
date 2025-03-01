<div>
    <h1>Modifier un Matériel</h1>
    <form action="{{ route('materiel.update', $materiel->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ $materiel->nom }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ $materiel->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="type_materiel_id">Type de Matériel</label>
            <select name="type_materiel_id" id="type_materiel_id" class="form-control" required>
                @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ $type->id == $materiel->type_materiel_id ? 'selected' : '' }}>{{ $type->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="proprietaire_materiel_id">Propriétaire</label>
            <select name="proprietaire_materiel_id" id="proprietaire_materiel_id" class="form-control" required>
                @foreach($proprietaires as $proprietaire)
                    <option value="{{ $proprietaire->id }}" {{ $proprietaire->id == $materiel->proprietaire_materiel_id ? 'selected' : '' }}>{{ $proprietaire->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="date_acquisition">Date d'Acquisition</label>
            <input type="date" name="date_acquisition" id="date_acquisition" class="form-control" value="{{ $materiel->date_acquisition }}" required>
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</div>