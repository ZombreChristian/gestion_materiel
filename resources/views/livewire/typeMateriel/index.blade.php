<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Types de Matériel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- CSS personnalisé -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
    <div class="row p-4 pt-5">
        <div class="col-12">
            <div class="card">
                <!-- En-tête de la carte -->
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <h3 class="card-title flex-grow-1">
                        <i class="fas fa-tools fa-2x"></i> Liste des Types de Matériel
                    </h3>

                    <!-- Bouton "Ajouter" et barre de recherche -->
                    <div class="card-tools d-flex align-items-center">
                        <!-- Bouton "Ajouter" -->
                        <button type="button" class="btn btn-link text-white mr-4 d-block" data-toggle="modal" data-target=".bd-example-modal-lg">
                            <i class="fas fa-plus"></i> Ajouter un Type de Matériel
                        </button>

                        <!-- Barre de recherche -->
                        <div class="input-group input-group-md" style="width: 250px;">
                            <input type="text" id="table_search" class="form-control float-right" placeholder="Rechercher...">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-default bg-light">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Corps de la carte -->
                <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                    <table class="table table-head-fixed">
                        <thead>
                            <tr>
                                <th style="width:25%;">Nom</th>
                                <th style="width:40%;">Description</th>
                                <th style="width:20%;" class="text-center">Ajouté</th>
                                <th style="width:30%;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                            @foreach($types as $type)
                            <tr>
                                <td>{{ $type->nom }}</td>
                                <td>{{ $type->description }}</td>
                                <td class="text-center">
                                    <span class="tag tag-success">
                                        {{ $type->created_at ? $type->created_at->diffForHumans() : 'N/A' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <!-- Bouton "Modifier" -->
                                    <a href="{{ route('typeMateriel.edit', $type->id) }}" class="btn btn-primary">
                                        <i class="far fa-edit"></i>
                                    </a>

                                    <!-- Bouton "Supprimer" -->
                                    <form action="{{ route('typeMateriel.destroy', $type->id) }}" method="POST" style="display:inline;">
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

                <!-- Pied de la carte -->
                <div class="card-footer">
                    <div class="float-right">
                        {{ $types->links() }} <!-- Pagination -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modale pour ajouter un type de matériel -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    @include("livewire.typeMateriel.create") <!-- Inclure le formulaire de création -->
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