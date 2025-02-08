
{{-- <div class="row p-4 pt-5">
            <div class="col-md-6"> --}}
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire des informations du nouveau utilisateur crée</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('admin.roles.update.admin',$item->id)}}" class="forms-sample" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" value="{{$item->id}}">
                    <div class="card-body">
                      <div class="d-flex">
                          <div class="form-group flex-grow-1 mr-2">
                              <label >Nom</label>
                              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="KAFANDO" value="{{$item->name}}" disabled>

                              @error("name")
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="form-group flex-grow-1 mr-2">
                              <label >Prenom</label>
                              <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror" name="surname" placeholder="Moussa" value="{{$item->surname}}" disabled>

                              @error("surname")
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>

                          <div class="form-group flex-grow-1">
                            <label>Pièce d'identité</label>
                            <select class="form-control @error('pieceIdentite') is-invalid @enderror" name="pieceIdentite" disabled>
                                <option value="" disabled>---------</option>
                                <option value="CNIB" @if(old('pieceIdentite', $item->pieceIdentite) == 'CNIB') selected @endif>CNIB</option>
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
                                <label for="exampleInputUsername1">Profile</label>
                                <select name="roles" class="form-control @error('group_name') is-invalid @enderror" id="exampleFormControlSelect1" disabled>
                                    <option  disabled>Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}">@if ($role->$role)
                                            {{$role->$role->name}}
                                            @else aucun

                                        @endif
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>



                    <div class="d-flex">
                          <div class="form-group flex-grow-1 mr-2">
                              <label >Telephone 1</label>
                              <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" maxlength="8" placeholder="52132865" value="{{$item->phone}}" disabled>
                              @error("phone")
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="form-group flex-grow-1 mr-2">
                              <label >Telephone 2 (Optionnel)</label>
                              <input type="text" class="form-control" name="phone2" maxlength="8" placeholder="52132865" value="{{$item->phone2}}" disabled>
                          </div>

                          <div class="form-group flex-grow-1">
                            <label >Numéro de piece d'identité</label>
                            <input type="text" class="form-control @error('numeroPieceIdentite') is-invalid @enderror" name="numeroPieceIdentite" maxlength="12" value="{{$item->numeroPieceIdentite}}" disabled>
                            @error("numeroPieceIdentite")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                      </div>




                      <div class="d-flex">

                        <div class="form-group flex-grow-1 ">
                            <label for="exampleInputPassword1">Statut</label>
                            <select class="form-control @error('status') is-invalid @enderror" name="status" disabled>
                                <option value="" disabled>---------</option>
                                <option value="active" @if(old('status', $item->status) == 'active') selected @endif>active</option>
                                <option value="inactive" @if(old('status', $item->status) == 'inactive') selected @endif>inactive</option>
                            </select>
                              @error("status")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div class="form-group flex-grow-1 mr-2">
                            <label >Mot de passe</label>
                            <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="*****" value="{{$item->password}}">

                            @error("surname")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}

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


          <script>
              window.addEventListener("showSuccessMessage",envent=>{
                  Swal.fire({
                      position:'top-end',
                      icon: 'success',
                      toast:true,
                      title:event.detail.message || "Opération effectuée avec succès",
                      showConfirmButton:false,
                      timer:2000
                  })
              })
          </script>


{{-- <form method="POST" action="{{route('admin.membres.update.membre')}}"
                            class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id"
                                value="{{$item->id}}">

                            <div class="form-group">


                                <label for="exampleInputUsername1">Nom
                                    profile</label>
                                <input type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name" autocomplete="off"
                                    value="{{$item->name}}">
                                @error('name')
                                <span class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>



                            <button type="submit"
                                class="btn btn-primary mr-2">Enregistrer</button>
</form> --}}
