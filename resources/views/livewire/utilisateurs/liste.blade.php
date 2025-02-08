<div class="row p-4 pt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-gradient-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i> Liste des utilisateurs</h3>

                <div class="card-tools d-flex align-items-center ">
                {{-- <a class="btn btn-link text-white mr-4 d-block" wire:click.prevent="goToAddUser()"><i class="fas fa-user-plus"></i> Nouvel utilisateur</a> --}}

                <button type="button" class="btn btn-link text-white mr-4 d-block" data-toggle="modal" data-target=".bd-example-modal-lg">
                    <i class="fas fa-user-plus"></i> Nouvel utilisateur
                </button>

                {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg">
                    <i class="fas fa-plus"></i>Ajouter Arme
                </button>--}}
                  <div class="input-group input-group-md" style="width: 250px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th style="width:5%;"></th>
                      <th style="width:25%;">Utilisateurs</th>
                      <th style="width:20%;" >Roles</th>
                      <th style="width:20%;" class="text-center">Ajouté</th>
                      <th style="width:30%;" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                    <tr>
                      <td>
                        @if($user->sexe == "F")
                            <img src="{{asset('images/woman.png')}}" width="24"/>
                        @else
                            <img src="{{asset('images/man.png')}}" width="24"/>
                        @endif
                      </td>
                      <td>{{ $user->prenom }} {{ $user->nom }}</td>
                      <td>{{ $user->allRoleNames}}</td>
                      <td class="text-center"><span class="tag tag-success">{{ $user->created_at->diffForHumans() }}</span></td>

                      <td class="text-center">
                        
                        <button class="btn btn-primary" wire:click="goToEditUser({{$user->id}})"> <i class="far fa-edit"></i> </button>
                        <button class="btn btn-link" wire:click="confirmDelete(' {{$user->id}})"> <i class="far fa-trash-alt"></i> </button>

                   <!-- Button trigger modal -->
                   {{-- <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#modal-default">
                    <i class="far fa-trash-alt"></i>
                  </button> --}}
                  <!-- Modal -->
  <div class="modal fade" wire:ignore.self id="modal-default" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Supprimer utilisateur</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
          </button>
        </div>
        <div class="modal-body">
          Voulez-vous vraiment le supprimer?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          {{-- <button type="button" class="btn btn-danger" wire:click="deleteUser('{{$user->id}})">Oui, Supprimer</button> --}}
          <a href="{{route('delete.user',$user->id)}}" class="btn btn-danger"
            >Oui , supprimer</a>
        </div>
      </div>
    </div>
  </div>


        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                    {{ $users->links() }}
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>




        <nav class="page-breadcrumb">
            <ol class="breadcrumb">

                <!--  modale -->
                <div class="modal fade bd-example-modal-lg"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class=" card-body">
                                                @include("livewire.utilisateurs.create")


                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>


                        </div>
                    </div>

                </div>

            </ol>
        </nav>






