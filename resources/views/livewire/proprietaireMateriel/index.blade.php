<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Propriétaires de Matériel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
    <div class="row p-4 pt-5">
        <div class="col-12">
            <div class="card">
                <!-- En-tête avec barre de recherche et bouton "Ajouter" -->
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-user-tie fa-2x"></i> Liste des Propriétaires de Matériel
                    </h3>

                    <div class="d-flex">
                        <!-- Barre de recherche -->
                        <div class="input-group input-group-md mr-3">
                            <input type="text" id="table_search" class="form-control" placeholder="Rechercher...">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-light">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Bouton "Ajouter" -->
                        <button type="button" class="btn btn-light text-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                            <i class="fas fa-plus"></i> Ajouter un Propriétaire
                        </button>
                    </div>
                </div>

                <!-- Corps de la carte -->
                <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                    <table class="table table-head-fixed">
                        <thead>
                            <tr>
                                <th style="width:25%;">Nom</th>
                                <th style="width:15%;">Contact</th>
                                <th style="width:30%;">Email</th>
                                <th style="width:15%;" class="text-center">Ajouté</th>
                                <th style="width:30%;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                            @foreach($proprietaires as $proprietaire)
                            <tr>
                                <td>{{ $proprietaire->nom }}</td>
                                <td>{{ $proprietaire->contact }}</td>
                                <td>{{ $proprietaire->email }}</td>
                                <td class="text-center">
                                    <span class="tag tag-success">
                                        {{ $proprietaire->created_at ? $proprietaire->created_at->diffForHumans() : 'N/A' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <!-- Bouton "Modifier" -->
                                    <a href="{{ route('proprietaireMateriel.edit', $proprietaire->id) }}" class="btn btn-primary">
                                        <i class="far fa-edit"></i>
                                    </a>

                                    <!-- Bouton "Supprimer" -->
                                    <form action="{{ route('proprietaireMateriel.destroy', $proprietaire->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="card-footer d-flex justify-content-center">
                    {{ $proprietaires->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modale pour ajouter un propriétaire -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    @include("livewire.proprietaireMateriel.create") <!-- Inclure le formulaire de création -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script pour la recherche -->
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

    <!-- Bootstrap JS et dépendances -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
