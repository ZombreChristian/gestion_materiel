
{{-- <div class="row p-4 pt-5">
            <div class="col-md-6"> --}}
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire des informations du nouveau membre crée</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="" action="" class="forms-sample" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" value="{{$item->id}}">
                    <div class="card-body">
                      <div class="d-flex">
                          <div class="form-group flex-grow-1 mr-2">
                              <label >Nom</label>
                              <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" name="nom" placeholder="KAFANDO" value="{{$item->nom}}" disabled>

                              @error("nom")
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="form-group flex-grow-1 mr-2">
                              <label >Prenom</label>
                              <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror" name="prenom" placeholder="Moussa" value="{{$item->prenom}} " disabled>

                              @error("prenom")
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>

                          <div class="form-group flex-grow-1">
                            <label>Pièce d'identité</label>
                            <select class="form-control @error('pieceIdentite') is-invalid @enderror" name="pieceIdentite" disabled>
                                <option value="" disabled>---------</option>
                                <option  value="CNIB" @if(old('pieceIdentite', $item->pieceIdentite) == 'CNIB') selected @endif>CNIB</option>
                                <option value="PASSPORT" @if(old('pieceIdentite', $item->pieceIdentite) == 'PASSPORT') selected @endif>PASSPORT</option>
                                <option value="PERMIS DE CONDUIRE" @if(old('pieceIdentite', $item->pieceIdentite) == 'PERMIS DE CONDUIRE') selected @endif>PERMIS DE CONDUIRE</option>
                            </select>
                            @error("pieceIdentite")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                      </div>


                     <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Sexe</label>
                                <select class="form-control @error('sexe') is-invalid @enderror" name="sexe" disabled>
                                    <option value="" disabled>---------</option>
                                    <option value="M" @if(old('sexe', $item->sexe) == 'M') selected @endif>Homme</option>
                                    <option value="F" @if(old('sexe', $item->sexe) == 'F') selected @endif>Femme</option>
                                </select>
                                @error("sexe")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label >Adresse email</label>
                                <input type="mail" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="test@gmail.com" value="{{$item->email}}" disabled>
                                @error("email")
                                            <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label >Montant à emprunter</label>
                                <div class="input-group">

                                    <input type="number" class="form-control @error('montant') is-invalid @enderror" name="montant"value="{{$item->montant}}" disabled>
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
                              <input type="text" class="form-control @error('telephone1') is-invalid @enderror" name="telephone1" maxlength="8" placeholder="52132865" value="{{$item->telephone1}}" disabled>
                              @error("telephone1")
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="form-group flex-grow-1 mr-2">
                              <label >Telephone 2 (Optionnel)</label>
                              <input type="text" class="form-control" name="telephone2" maxlength="8" placeholder="52132865" value="{{$item->telephone2}}" disabled>
                          </div>

                          <div class="form-group flex-grow-1">
                            <label >Numéro de piece d'identité</label>
                            <input type="text" class="form-control @error('noPieceIdentite') is-invalid @enderror" name="noPieceIdentite" maxlength="12" value="{{$item->noPieceIdentite}}" disabled>
                            @error("noPieceIdentite")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                      </div>




                      <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label for="exampleInputPassword1">Date de naissance</label>
                            <input type="date" class="form-control @error('dateNaissance') is-invalid @enderror" name="dateNaissance" value="{{$item->dateNaissance}}" disabled>
                            @error("dateNaissance")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1 mr-2">
                            <label >Lieu de naissance</label>
                            <input type="text" class="form-control" @error('lieuNaissance') is-invalid @enderror name="lieuNaissance" placeholder="Ouagadougou" value="{{$item->lieuNaissance}}" disabled>
                            @error("lieuNaissance")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group flex-grow-1 ">
                            <label for="exampleInputPassword1">Adresse</label>
                            <input type="text" class="form-control @error('adresse') is-invalid @enderror" name="adresse" placeholder="secteur 12 Boulmiougou" value="{{$item->adresse}}" disabled>
                            @error("adresse")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label for="exampleInputPassword1">Pays</label>
                            <input type="text" class="form-control @error('pays') is-invalid @enderror" name="pays" value="{{$item->pays}}" disabled>
                            @error("pays")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1 mr-2">
                            <label >Ville</label>
                            <input type="text" class="form-control" @error('ville') is-invalid @enderror name="ville" placeholder="BOBO" value="{{$item->ville}}"disabled>
                            @error("ville")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>

                        <div class="form-group flex-grow-1 ">
                            <label >Nationalité</label>
                            <input type="text" class="form-control" @error('nationalite') is-invalid @enderror name="nationalite" placeholder="Burkinabè"value="{{$item->nationalite}}"disabled>
                            @error("nationalite")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>







                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">fermer</button>

                    {{-- <button type="button" wire:click="goToListUser()" class="btn btn-danger">Retouner à la liste des utilisateurs</button> --}}
                  </div>
                </form>
              </div>
              <!-- /.card -->
  {{--
            </div>
          </div> --}}

