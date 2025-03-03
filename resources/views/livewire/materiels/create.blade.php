{{-- <div class="row p-4 pt-5">
            <div class="col-md-6"> --}}
<!-- general form elements -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'ajout d'un materiel</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{ route('etudiants.store.etudiant') }}" class="forms-sample"
        enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="d-flex">

            <div class=" my-4 bg-gray-light p-3 flex-grow-1">

                <div class="form-group">
                    <label>Nom du materiel</label>
                    <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                        name="nom" placeholder="Nom du materiel">

                    @error('nom')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Numero de serie</label>
                    <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                        name="nom" placeholder="Numero du materiel">

                    @error('nom')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Type de materiel</label>
                    <select class="form-control @error('sexe') is-invalid @enderror" name="sexe">
                        <option value="">---------</option>
                        <option value="1">Disponible</option>
                        <option value="0">Indisponible</option>
                    </select>
                    @error('prenom')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Etat</label>
                    <select class="form-control @error('sexe') is-invalid @enderror" name="sexe">
                        <option value="">---------</option>
                        <option value="1">Disponible</option>
                        <option value="0">Indisponible</option>
                    </select>
                    @error('prenom')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>



            <div class="p-4">
                <div class="form-group">
                    <input type="file" id="image">
                </div>
                <div
                    style="border: 1px solid #d0d1d3; border-radius: 20px; height: 200px; width:200px; overflow:hidden;">

                        <img src="" style="height:250px; width:200px;">

                </div>
            </div>
        </div>
















        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-success">Enregistrer</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">fermer</button>

            {{-- <button type="button" wire:click="goToListUser()" class="btn btn-danger">Retouner à la liste des utilisateurs</button> --}}
        </div>
    </form>
</div>
<!-- /.card -->
{{--
            </div>
          </div> --}}
