{{-- <div class="row p-4 pt-5">
            <div class="col-md-6"> --}}
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire de réservation</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('etudiants.store.etudiant')}}" class="forms-sample" enctype="multipart/form-data">
                  @csrf
                    <div class="card-body">
                      <div class="d-flex">
                          <div class="form-group flex-grow-1 mr-2">
                              <label >Nom</label>
                              <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" name="nom" placeholder="KAFANDO">

                              @error("nom")
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="form-group flex-grow-1 mr-2">
                              <label >Prenom</label>
                              <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror" name="prenom" placeholder="Moussa">

                              @error("prenom")
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>

                          <div class="form-group flex-grow-1  ">
                            <label >Piece d'identité</label>
                            <select class="form-control @error('pieceIdentite') is-invalid @enderror" name="pieceIdentite">
                                <option value="">---------</option>
                                <option value="CNIB">CNIB</option>
                                <option value="PASSPORT">PASSPORT</option>
                                <option value="PERMIS DE CONDUIRE">PERMIS DE CONDUIRE</option>
                            </select>
                            @error("pieceIdentite")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                      </div>

                    




                      <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label for="exampleInputPassword1">Date de naissance</label>
                            <input type="date" class="form-control @error('dateNaissance') is-invalid @enderror" name="dateNaissance">
                            @error("dateNaissance")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1 mr-2">
                            <label >Lieu de naissance</label>
                            <input type="text" class="form-control" @error('lieuNaissance') is-invalid @enderror name="lieuNaissance" placeholder="Ouagadougou">
                            @error("lieuNaissance")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group flex-grow-1 ">
                            <label for="exampleInputPassword1">Adresse</label>
                            <input type="text" class="form-control @error('adresse') is-invalid @enderror" name="adresse" placeholder="secteur 12 Boulmiougou">
                            @error("adresse")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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




