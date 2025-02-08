{{-- <div class="row p-4 pt-5">
            <div class="col-md-6"> --}}
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire de création d'un nouveau membre</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('admin.membres.store.membre')}}" class="forms-sample" enctype="multipart/form-data">
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

                    {{-- <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label >Sexe</label>
                            <select class="form-control @error('sexe') is-invalid @enderror" name="sexe" >
                                <option value="">---------</option>
                                <option value="M">Homme</option>
                                <option value="F">Femme</option>
                            </select>
                            @error("sexe")
                                        <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>

                          <div class="form-group flex-grow-1">
                            <label >Adresse email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email">
                            @error("email")
                                        <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                    </div> --}}

                     <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label >Sexe</label>
                            <select class="form-control @error('sexe') is-invalid @enderror" name="sexe" >
                                <option value="">---------</option>
                                <option value="M">Homme</option>
                                <option value="F">Femme</option>
                            </select>
                            @error("sexe")
                                        <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label >Adresse email</label>
                                <input type="mail" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="test@gmail.com">
                                @error("email")
                                            <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label >Montant à emprunter</label>
                                <div class="input-group">

                                    <input type="number" class="form-control @error('montant') is-invalid @enderror" name="montant">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">F CFA</span>
                                    </div>
                                </div>
                                @error("montant")
                                            <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>



                    <div class="d-flex">
                          <div class="form-group flex-grow-1 mr-2">
                              <label >Telephone 1</label>
                              <input type="text" class="form-control @error('telephone1') is-invalid @enderror" name="telephone1" maxlength="8" placeholder="52132865">
                              @error("telephone1")
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="form-group flex-grow-1 mr-2">
                              <label >Telephone 2 (Optionnel)</label>
                              <input type="text" class="form-control" name="telephone2" maxlength="8" placeholder="52132865">
                          </div>

                          <div class="form-group flex-grow-1">
                            <label >Numéro de piece d'identité</label>
                            <input type="text" class="form-control @error('noPieceIdentite') is-invalid @enderror" name="noPieceIdentite" maxlength="12">
                            @error("noPieceIdentite")
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

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label for="exampleInputPassword1">Pays</label>
                            <input type="text" class="form-control @error('pays') is-invalid @enderror" name="pays">
                            @error("pays")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1 mr-2">
                            <label >Ville</label>
                            <input type="text" class="form-control" @error('ville') is-invalid @enderror name="ville" placeholder="BOBO">
                            @error("ville")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>

                        <div class="form-group flex-grow-1 ">
                            <label >Nationalité</label>
                            <input type="text" class="form-control" @error('nationalite') is-invalid @enderror name="nationalite" placeholder="Burkinabè">
                            @error("nationalite")
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


         

