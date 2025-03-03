<div>
    <h1>Ajouter un Type de Matériel</h1>
    <form action="{{ route('typeMateriel.store') }}" method="POST">
        @csrf
        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required>
        </div>
        <div>
            <label for="description">Description :</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>