{{-- <div class="row p-4 pt-5">
            <div class="col-md-6"> --}}
<!-- general form elements -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'ajout d'un materiel</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{ route('equipements.store.equipement') }}" class="forms-sample" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="d-flex">

                <div class="my-4 bg-gray-light p-3 flex-grow-1">

                    <div class="form-group">
                        <label>Nom du materiel</label>
                        <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" placeholder="Nom du materiel">
                        @error('nom')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Numero de serie</label>
                        <input type="text" name="noSerie" class="form-control @error('noSerie') is-invalid @enderror" placeholder="Numero du materiel">
                        @error('noSerie')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Type de materiel</label>
                        <select name="type_materiel_id" class="form-control @error('type_materiel_id') is-invalid @enderror">
                            <option selected>---------</option>
                            @foreach ($typesMateriel as $type)
                                <option value="{{ $type->id }}">{{ $type->nom }}</option>
                            @endforeach
                        </select>
                        @error('type_materiel_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Etat</label>
                        <select class="form-control @error('estDisponible') is-invalid @enderror" name="estDisponible">
                            <option value="">---------</option>
                            <option value="1">Disponible</option>
                            <option value="0">Indisponible</option>
                        </select>
                        @error('estDisponible')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="p-4 d-flex flex-column align-items-center">
                    <div class="form-group">
                        <input type="file" id="imageUrl" name="imageUrl" class="form-control @error('imageUrl') is-invalid @enderror" onchange="previewImage(event)">
                    </div>
                    <div style="border: 1px solid #d0d1d3; border-radius: 20px; height: 300px; width:250px; overflow:hidden;">
                        <img id="preview" src="" style="height:100%; width:100%; object-fit:cover;">
                    </div>
                </div>

                <script>
                    function previewImage(event) {
                        var reader = new FileReader();
                        reader.onload = function() {
                            var output = document.getElementById('preview');
                            output.src = reader.result;
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    }
                </script>

            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-success">Enregistrer</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
        </div>
    </form>

</div>
<!-- /.card -->
{{--
            </div>
          </div> --}}
