<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Matériels</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <!-- En-tête -->
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                <h3 class="card-title">
                    <i class="fas fa-cogs fa-2x"></i> Liste des Matériels
                </h3>
                
                <!-- Barre de recherche et bouton "Ajouter" -->
                <div class="d-flex align-items-center">
                    <div class="input-group input-group-md mr-3">
                        <input type="text" id="table_search" class="form-control" placeholder="Rechercher...">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-light">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    
                    <a href="{{ route('materiel.create') }}" class="btn btn-light text-primary">
                        <i class="fas fa-plus"></i> Ajouter un Matériel
                    </a>
                </div>
            </div>

            <!-- Corps du tableau -->
            <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                <table class="table table-head-fixed">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Propriétaire</th>
                            <th>Date d'Acquisition</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table_body">
                        @foreach($materiels as $materiel)
                            <tr>
                                <td>
                                    <img src="{{ $materiel->imageUrl }}" alt="Image" class="img-fluid" style="max-width: 80px; max-height: 70px; object-fit: cover;">
                                </td>
                                <td>{{ $materiel->nom }}</td>
                                <td>{{ $materiel->description }}</td>
                                <td>{{ $materiel->typeMateriel->nom }}</td>
                                <td>{{ $materiel->proprietaireMateriel->nom }}</td>
                                <td>{{ $materiel->date_acquisition }}</td>
                                <td class="text-center">
                                    <a href="{{ route('materiel.edit', $materiel->id) }}" class="btn btn-primary btn-sm">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <form action="{{ route('materiel.destroy', $materiel->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

            <!-- Pied de page (Pagination sans flèches) -->
            <div class="card-footer d-flex justify-content-between">
                <!-- Pagination -->
                <div>
                    <span>{{ $materiels->count() }} matériels affichés</span>
                </div>
                
                <!-- Boutons de pagination (Previous / Next) -->
                <div>
                    <ul class="pagination pagination-sm">
                        @if ($materiels->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Précédent</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $materiels->previousPageUrl() }}">Précédent</a>
                            </li>
                        @endif

                        @foreach ($materiels->getUrlRange(1, $materiels->lastPage()) as $page => $url)
                            <li class="page-item {{ ($materiels->currentPage() == $page) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        @if ($materiels->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $materiels->nextPageUrl() }}">Suivant</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Suivant</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bouton "Réserver" -->
        <div class="text-center mt-4">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#reservationModal">
                <i class="fas fa-calendar-check"></i> Réserver
            </button>
        </div>
    </div>

    <!-- Modale pour le formulaire de réservation -->
    <div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="reservationModalLabel">
                        <i class="fas fa-calendar-check"></i> Réserver des Matériels
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reservation.store') }}" method="POST">
                        @csrf
                        <!-- Champ caché pour l'utilisateur connecté -->
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <!-- Champ caché pour le statut par défaut "En attente" -->
                        <input type="hidden" name="statut_reservation_id" value="1">

                        <!-- Sélection des matériels -->
                        <div class="form-group">
                            <label for="materiels">Matériels</label>
                            <select name="materiels[]" id="materiels" class="form-control" multiple required>
                                @foreach($materiels as $materiel)
                                    <option value="{{ $materiel->id }}">{{ $materiel->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Durée de la réservation -->
                        <div class="form-group">
                            <label for="duree_reservation_id">Durée</label>
                            <select name="duree_reservation_id" id="duree_reservation_id" class="form-control" required>
                                @foreach($durees as $duree)
                                    <option value="{{ $duree->id }}">{{ $duree->duree }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date de réservation -->
                        <div class="form-group">
                            <label for="date_reservation">Date de Réservation</label>
                            <input type="datetime-local" name="date_reservation" id="date_reservation" class="form-control" required>
                        </div>

                        <!-- Commentaire -->
                        <div class="form-group">
                            <label for="commentaire">Commentaire</label>
                            <textarea name="commentaire" id="commentaire" class="form-control" rows="3"></textarea>
                        </div>

                        <!-- Boutons de la modale -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Réserver</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script pour la recherche -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#table_search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table_body tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>