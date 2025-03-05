<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Mes Réservations</title>
    @include('include.head_link')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="animsition">
    <div class="page-wrapper">
        @include('include.sidebar_admin')
        <div class="page-container2">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                    <h3 class="card-title">
                        <i class="fas fa-list fa-2x"></i> Mes Réservations
                    </h3>
                    <div class="d-flex align-items-center">
                        <form action="{{ route('reservation.indexuser') }}" method="GET" class="form-inline mr-3">
                            <input type="text" class="form-control" name="search" placeholder="Rechercher" value="{{ request()->get('search') }}">
                        </form>
                        <button class="btn btn-success" data-toggle="modal" data-target="#ajoutReservationModal">
                            <i class="fas fa-plus"></i> Ajouter une Réservation
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Matériel</th>
                                <th>Statut</th>
                                <th>Durée</th>
                                <th>Date de Réservation</th>
                                <th>Commentaire</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->materiel->nom }}</td>
                                    <td>{{ $reservation->statutReservation->statut }}</td>
                                    <td>{{ $reservation->dureeReservation->duree }}</td>
                                    <td>{{ $reservation->date_reservation }}</td>
                                    <td>{{ $reservation->commentaire }}</td>
                                    <td>
                                        <button class="btn btn-primary edit-btn"
                                            data-id="{{ $reservation->id }}"
                                            data-user_id="{{ $reservation->user_id }}"
                                            data-statut_reservation_id="{{ $reservation->statut_reservation_id }}"
                                            data-materiel_id="{{ $reservation->materiel_id }}"
                                            data-duree_reservation_id="{{ $reservation->duree_reservation_id }}"
                                            data-date_reservation="{{ $reservation->date_reservation }}"
                                            data-commentaire="{{ $reservation->commentaire }}">
                                            <i class="far fa-edit"></i> Modifier
                                        </button>
                                        <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="far fa-trash-alt"></i> Supprimer
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="pagination">
                            {{ $reservations->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal d'ajout de réservation -->
<div class="modal fade" id="ajoutReservationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une Réservation</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('reservation.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                    <!-- Matériel -->
                    <div class="form-group">
                        <label for="materiel_id">Matériel</label>
                        <select name="materiel_id" id="materiel_id" class="form-control" required>
                            <option value="" disabled selected>Choisir un matériel</option>
                            @foreach($materiels ?? [] as $materiel)
                                <option value="{{ $materiel->id }}" {{ old('materiel_id') == $materiel->id ? 'selected' : '' }}>
                                    {{ $materiel->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Durée -->
                    <div class="form-group">
                        <label for="duree_reservation_id">Durée</label>
                        <select name="duree_reservation_id" id="duree_reservation_id" class="form-control" required>
                            <option value="" disabled selected>Choisir une durée</option>
                            @foreach($durees ?? [] as $duree)
                                <option value="{{ $duree->id }}" {{ old('duree_reservation_id') == $duree->id ? 'selected' : '' }}>
                                    {{ $duree->duree }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Statut (Caché) -->
                    <div class="form-group" style="display: none;">
                        <label for="statut_reservation_id">Statut</label>
                        <select name="statut_reservation_id" id="statut_reservation_id" class="form-control">
                            @foreach($statuts ?? [] as $statut)
                                <option value="{{ $statut->id }}" {{ $statut->statut == 'En attente' ? 'selected' : '' }}>
                                    {{ $statut->statut }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date de réservation -->
                    <div class="form-group">
                        <label for="date_reservation">Date de Réservation</label>
                        <input type="datetime-local" name="date_reservation" id="date_reservation" class="form-control" value="{{ old('date_reservation') }}" required>
                    </div>

                    <!-- Commentaire -->
                    <div class="form-group">
                        <label for="commentaire">Commentaire</label>
                        <textarea name="commentaire" id="commentaire" class="form-control" rows="3">{{ old('commentaire') }}</textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Modal de Modification -->
<div class="modal fade" id="editReservationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier la Réservation</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editReservationForm" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="user_id" id="edit_user_id">
                    <input type="hidden" name="statut_reservation_id" id="edit_statut_reservation_id">

                    <!-- Matériel -->
                    <div class="form-group">
                        <label for="edit_materiel_id">Matériel</label>
                        <select name="materiel_id" id="edit_materiel_id" class="form-control" required>
                            @foreach($materiels as $materiel)
                                <option value="{{ $materiel->id }}">{{ $materiel->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Durée -->
                    <div class="form-group">
                        <label for="edit_duree_reservation_id">Durée</label>
                        <select name="duree_reservation_id" id="edit_duree_reservation_id" class="form-control" required>
                            @foreach($durees as $duree)
                                <option value="{{ $duree->id }}">{{ $duree->duree }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date de réservation -->
                    <div class="form-group">
                        <label for="edit_date_reservation">Date de Réservation</label>
                        <input type="datetime-local" name="date_reservation" id="edit_date_reservation" class="form-control" required>
                    </div>

                    <!-- Commentaire -->
                    <div class="form-group">
                        <label for="edit_commentaire">Commentaire</label>
                        <textarea name="commentaire" id="edit_commentaire" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" onclick="$('#editReservationModal').modal('hide');">Annuler</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $(".edit-btn").click(function() {
        let id = $(this).data("id");
        let user_id = $(this).data("user_id");
        let statut_reservation_id = $(this).data("statut_reservation_id");
        let materiel_id = $(this).data("materiel_id");
        let duree_reservation_id = $(this).data("duree_reservation_id");
        let date_reservation = $(this).data("date_reservation");
        let commentaire = $(this).data("commentaire");

        // Remplir le formulaire avec les données existantes
        $("#editReservationForm").attr("action", "/reservation/" + id);
        $("#edit_user_id").val(user_id);
        $("#edit_statut_reservation_id").val(statut_reservation_id);
        $("#edit_materiel_id").val(materiel_id);
        $("#edit_duree_reservation_id").val(duree_reservation_id);
        $("#edit_date_reservation").val(date_reservation);
        $("#edit_commentaire").val(commentaire);

        // Ouvrir le modal
        $("#editReservationModal").modal("show");
    });
});
</script>

<script>
    $(document).ready(function () {
        $('.modal').on('hidden.bs.modal', function () {
            $(this).find('form')[0].reset(); // Réinitialise le formulaire après fermeture
        });

        $('.edit-btn').click(function () {
            let modal = $('#editReservationModal');
            modal.modal('show'); // Ouvre le modal manuellement si besoin
        });

        $('.btn-secondary').click(function () {
            $('#editReservationModal').modal('hide'); // Ferme le modal manuellement
        });
    });
</script>

    @include('include.foot_link')
</body>
</html>
