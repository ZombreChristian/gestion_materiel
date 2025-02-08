{{-- <div class="row p-4 pt-5">
            <div class="col-md-6"> --}}
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire de création d'un nouvel utilisateur</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('admin.roles.store.admin')}}" class="forms-sample" enctype="multipart/form-data">
                  @csrf
                    <div class="card-body">
                      <div class="d-flex">
                          <div class="form-group flex-grow-1 mr-2">
                              <label >Nom</label>
                              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" name="name">

                              @error("name")
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="form-group flex-grow-1">
                              <label >Prenom</label>
                              <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror" name="surname">

                              @error("surname")
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                      <div class="d-flex">
                        <div class="form-group flex-grow-1  mr-2">
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

                          <div class="form-group flex-grow-1">
                                    <label >Numero de piece d'identité</label>
                                    <input type="text" class="form-control @error('numeroPieceIdentite') is-invalid @enderror" name="numeroPieceIdentite">
                                    @error("numeroPieceIdentite")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                    </div>

                    <div class="d-flex">
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
                            <label >Adresse e-mail</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email">
                            @error("email")
                                        <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                    </div>




                    <div class="d-flex">
                          <div class="form-group flex-grow-1 mr-2">
                              <label >Telephone 1</label>
                              <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone">
                              @error("phone")
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="form-group flex-grow-1">
                              <label >Telephone 2 (Optionnel)</label>
                              <input type="text" class="form-control" name="phone2">
                          </div>
                      </div>

                      <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label for="exampleInputPassword1">Mot de passe</label>
                            <input type="text" class="form-control @error('password') is-invalid @enderror" name="password">
                            @error("password")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1">
                            <label >Addresse</label>
                            <input type="text" class="form-control" @error('address') is-invalid @enderror name="address">
                            @error("address")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Profil</label>
                        <select name="roles"
                            class="form-control @error('group_name') is-invalid @enderror"
                            id="exampleFormControlSelect1">
                            <option selected="" disabled="">Selectionné un Profile</option>
                            @foreach ($roles as $role )
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
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


       
