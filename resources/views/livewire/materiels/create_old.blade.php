<div>
    <h1>Ajouter un Matériel</h1>
    <form action="{{ route('materiel.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nom">Nom du Matériel</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="type_materiel">Type de Matériel</label>
            <select name="type_materiel_id" id="type_materiel" class="form-control" required>
                <option value="">Sélectionner un type</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="proprietaire_materiel">Propriétaire</label>
            <select name="proprietaire_materiel_id" id="proprietaire_materiel" class="form-control" required>
                <option value="">Sélectionner un propriétaire</option>
                @foreach($proprietaires as $proprietaire)
                    <option value="{{ $proprietaire->id }}">{{ $proprietaire->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="date_acquisition">Date d'Acquisition</label>
            <input type="date" name="date_acquisition" id="date_acquisition" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="image">Image du Matériel</label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>

        <div class="form-group text-right btn-group">
            
            <button type="button" class="btn btn-danger" onclick="fermerFormulaire()">
                <i class="fas fa-times"></i> Fermer
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Enregistrer
            </button>
        </div>
    </form>
</div>

<script>
    function fermerFormulaire() {
        window.history.back(); // Retourne à la page précédente
    }
</script>

<style>
    div {
        max-width: 500px;
        margin: auto;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    .form-control {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .btn {
        padding: 10px 15px;
        border: none;
        border-radius: 20px;
        cursor: pointer;
    }

    .btn-group {
        display: flex;
        justify-content: flex-end; /* Aligner les boutons à droite */
        gap: 20px; /* Espacement entre les boutons */
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }
</style>
