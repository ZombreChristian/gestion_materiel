<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Matériels</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                <h3 class="card-title">
                    <i class="fas fa-cogs fa-2x"></i> Liste des Matériels
                </h3>
                <div class="d-flex align-items-center">
                    <input type="text" id="table_search" class="form-control mr-3" placeholder="Rechercher...">
                    <select id="filter_type" class="form-control mr-3">
                        <option value="">Tous les types</option>
                        @foreach($types as $type)
                            <option value="{{ $type->nom }}">{{ $type->nom }}</option>
                        @endforeach
                    </select>
                    <select id="filter_etat" class="form-control mr-3">
                        <option value="">Tous les états</option>
                        <option value="Disponible">Disponible</option>
                        <option value="Réservé">Réservé</option>
                    </select>
                    <button class="btn btn-light text-primary" data-toggle="modal" data-target="#addModal">
                        <i class="fas fa-plus"></i> Ajouter
                    </button>
                </div>
            </div>

            <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                <table class="table table-head-fixed">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Propriétaire</th>
                            <th>État</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table_body">
                        @foreach($materiels as $materiel)
                            <tr>
                                <td><img src="{{ $materiel->imageUrl }}" class="img-fluid" style="max-width: 80px;"></td>
                                <td>{{ $materiel->nom }}</td>
                                <td>{{ $materiel->description }}</td>
                                <td class="materiel-type">{{ $materiel->typeMateriel->nom }}</td>
                                <td>{{ $materiel->proprietaireMateriel->nom }}</td>
                                <td class="materiel-etat">{{ $materiel->etat }}</td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal" onclick="editMateriel({{ $materiel->id }})">
                                        <i class="far fa-edit"></i>
                                    </button>
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

        <!-- Pied de page (Pagination sans flèches) -->
        <div class="card-footer d-flex justify-content-between">
            <div>
                <span>{{ $materiels->count() }} matériels affichés</span>
            </div>
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

    <!-- Modal Ajouter -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Ajouter un Matériel</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
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
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fas fa-times"></i> Fermer
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Modifier -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Modifier un Matériel</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_id" name="id">
                        <div class="form-group">
                            <label for="edit_nom">Nom du Matériel</label>
                            <input type="text" name="nom" id="edit_nom" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_description">Description</label>
                            <textarea name="description" id="edit_description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_etat">État</label>
                            <select name="etat" id="edit_etat" class="form-control" required>
                                <option value="Disponible">Disponible</option>
                                <option value="Réservé">Réservé</option>
                            </select>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#table_search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table_body tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $("#filter_type, #filter_etat").on("change", function() {
                var typeFilter = $("#filter_type").val().toLowerCase();
                var etatFilter = $("#filter_etat").val().toLowerCase();
                $("#table_body tr").filter(function() {
                    var matchesType = !typeFilter || $(this).find(".materiel-type").text().toLowerCase().indexOf(typeFilter) > -1;
                    var matchesEtat = !etatFilter || $(this).find(".materiel-etat").text().toLowerCase().indexOf(etatFilter) > -1;
                    $(this).toggle(matchesType && matchesEtat);
                });
            });
        });

        function editMateriel(id) {
            let row = $("button[onclick='editMateriel(" + id + ")']").closest("tr");
            $("#edit_id").val(id);
            $("#edit_nom").val(row.find("td:eq(1)").text().trim());
            $("#edit_description").val(row.find("td:eq(2)").text().trim());
            $("#edit_etat").val(row.find("td:eq(5)").text().trim());
            let actionUrl = "{{ route('materiel.update', ':id') }}".replace(':id', id);
            $("#editForm").attr("action", actionUrl);
        }
    </script>
</body>
</html>