<form action="{{ route('typeMateriel.update', $type->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="nom">Nom du Matériel</label>
        <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $type->nom) }}" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" required>{{ old('description', $type->description) }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Modifier</button>
</form>
