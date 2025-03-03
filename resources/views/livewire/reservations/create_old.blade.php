<div>
    <h1>Ajouter une Réservation</h1>
    <form action="{{ route('reservation.store') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

        <div class="form-group">
            <label for="materiel_id">Matériel</label>
            <select name="materiel_id" id="materiel_id" class="form-control" required>
                @foreach($materiels as $materiel)
                    <option value="{{ $materiel->id }}">{{ $materiel->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="duree_reservation_id">Durée</label>
            <select name="duree_reservation_id" id="duree_reservation_id" class="form-control" required>
                @foreach($durees as $duree)
                    <option value="{{ $duree->id }}">{{ $duree->duree }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="statut_reservation_id">Statut</label>
            <select name="statut_reservation_id" id="statut_reservation_id" class="form-control" required>
                @foreach($statuts as $statut)
                    <option value="{{ $statut->id }}" {{ $statut->statut == 'En attente' ? 'selected' : '' }}>
                        {{ $statut->statut }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="date_reservation">Date de Réservation</label>
            <input type="datetime-local" name="date_reservation" id="date_reservation" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="commentaire">Commentaire</label>
            <textarea name="commentaire" id="commentaire" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group text-right btn-group">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <button type="button" class="btn btn-secondary" onclick="fermerFormulaire()">Annuler</button>
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
    gap: 30px; /* Espacement entre les boutons */
    }


    .btn-primary {
        background-color: #007bff;
        color: white;
    }
    .btn-secondary{
        background-color:rgb(255, 0, 0);
        justify-content: right;
        color: white;
    }
</style>
