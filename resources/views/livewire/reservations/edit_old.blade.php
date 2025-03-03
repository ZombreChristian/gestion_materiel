<div>
    <h1>Modifier une Réservation</h1>
    <form action="{{ route('reservation.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="materiel_id">Matériel</label>
            <select name="materiel_id" id="materiel_id" class="form-control" required>
                @foreach($materiels as $materiel)
                    <option value="{{ $materiel->id }}" {{ $materiel->id == $reservation->materiel_id ? 'selected' : '' }}>{{ $materiel->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="user_id">Utilisateur</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $reservation->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="statut_reservation_id">Statut</label>
            <select name="statut_reservation_id" id="statut_reservation_id" class="form-control" required>
                @foreach($statuts as $statut)
                    <option value="{{ $statut->id }}" {{ $statut->id == $reservation->statut_reservation_id ? 'selected' : '' }}>{{ $statut->statut }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="duree_reservation_id">Durée</label>
            <select name="duree_reservation_id" id="duree_reservation_id" class="form-control" required>
                @foreach($durees as $duree)
                    <option value="{{ $duree->id }}" {{ $duree->id == $reservation->duree_reservation_id ? 'selected' : '' }}>{{ $duree->duree }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="date_reservation">Date de Réservation</label>
            <input type="datetime-local" name="date_reservation" id="date_reservation" class="form-control" value="{{ $reservation->date_reservation }}" required>
        </div>
        <div class="form-group">
            <label for="commentaire">Commentaire</label>
            <textarea name="commentaire" id="commentaire" class="form-control" rows="3">{{ $reservation->commentaire }}</textarea>
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</div>