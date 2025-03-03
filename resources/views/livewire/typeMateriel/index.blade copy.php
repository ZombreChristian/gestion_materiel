<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Types de Matériel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
    <div class="container py-4">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="card-title"><i class="fas fa-tools fa-2x"></i> Liste des Types de Matériel</h3>
                <div class="d-flex">
                    <input type="text" id="table_search" class="form-control mr-2" placeholder="Rechercher...">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">
                        <i class="fas fa-plus"></i> Ajouter
                    </button>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th class="text-center">Ajouté</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table_body">
                        @foreach($types as $type)
                        <tr>
                            <td>{{ $type->nom }}</td>
                            <td>{{ $type->description }}</td>
                            <td class="text-center">{{ $type->created_at ? $type->created_at->diffForHumans() : 'N/A' }}</td>
                            <td class="text-center">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#editModal{{ $type->id }}">
                                    <i class="far fa-edit"></i>
                                </button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $type->id }}">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Modale Modification -->
                        <div class="modal fade" id="editModal{{ $type->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modifier</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        @include("livewire.typeMateriel.edit", ['type' => $type])
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modale Suppression -->
                        <div class="modal fade" id="deleteModal{{ $type->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirmation</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Êtes-vous sûr de vouloir supprimer ce matériel ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('typeMateriel.destroy', $type->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                {{ $types->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <!-- Modale Ajouter -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    @include("livewire.typeMateriel.create")
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#table_search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table_body tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
