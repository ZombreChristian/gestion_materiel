<!DOCTYPE html>
<html lang="fr">
    
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Réservations</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>


<body class="animsition">

    <div class="page-wrapper">

      

        <div class="page-container2">
        <div class="card">
            <!-- En-tête -->
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                <h3 class="card-title">
                    <i class="fas fa-list fa-2x"></i> Liste des Réservations
                </h3>

                <!-- Barre de recherche et bouton Ajouter une Réservation -->
                <div class="d-flex align-items-center">
                    <form action="{{ route('reservation.index') }}" method="GET" class="form-inline mr-3">
                        <input type="text" class="form-control" name="search" placeholder="Rechercher" value="{{ request()->get('search') }}">
                    </form>
                    <a href="{{ route('reservation.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Ajouter une Réservation
                    </a>
                </div>
            </div>

            <!-- Corps du tableau -->
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Matériel</th>
                            <th>Utilisateur</th>
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
                                <td>{{ $reservation->user->name }}</td>
                                <td>{{ $reservation->statutReservation->statut }}</td>
                                <td>{{ $reservation->dureeReservation->duree }}</td>
                                <td>{{ $reservation->date_reservation }}</td>
                                <td>{{ $reservation->commentaire }}</td>
                                <td>
                                    <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-primary">
                                        <i class="far fa-edit"></i> Modifier
                                    </a>
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

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center">
                    <div class="pagination">
                        {{ $reservations->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

        </div>



    </div>
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    @include('include.foot_link')
</body>
    
</html>
