{{-- @include('livewire.membres.filter') --}}

@extends('layouts.master')
@section('contenu')
<div class="row p-4 pt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-gradient-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i> Liste des roles</h3>

                <div class="card-tools d-flex align-items-center ">
                {{-- <a class="btn btn-link text-white mr-4 d-block" wire:click.prevent="goToAddUser()"><i class="fas fa-user-plus"></i> Nouvel utilisateur</a> --}}

                <button type="button" class="btn btn-link text-white mr-4 d-block" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-plus"></i> Nouveau role
                </button>

                {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg">
                    <i class="fas fa-plus"></i>Ajouter Arme
                </button>--}}
                  <div class="input-group input-group-md" >
                   <form method="get" action="#{{--route('admin.membres.cherche.membre')--}}">
                       <div class="input-group">
                        <input type="text" name="search" class="form-control float-right" placeholder="Search" value="">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>

                       </div>

                   </form>

                  </div>

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                        <th>Id#</th>
                        <th>Nom profile</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($roles as $key => $item )
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$item->name}}</td>


                      <td>

                        <!-- Button to trigger the modal -->
                        <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target="#editModal{{$item->id}}">
                            <i class="far fa-edit"></i>
                        </button>


                        <!-- Edit Modal -->

                        <div class="modal fade bd-example-modal-xl" id="editModal{{$item->id}}" tabindex="-1" role="dialog"
                            aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">

                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="card-body">
                                                @include("backend.pages.roles.edit_roles")


                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>



                        <a href="{{route('admin.roles.delete.roles',$item->id)}}" class="btn btn-danger"
                            id="delete"><i class="far fa-trash-alt"></i></a>


                             <!-- affiché plus de detail -->
                             <button type="button" class="btn btn-info " data-toggle="modal"data-target="#allModal{{$item->id}}">
                                <i class="fas fa-info-circle"></i>
                           </button>

                        <div class="modal fade bd-example-modal-xl" id="allModal{{$item->id}}" tabindex="-1" role="dialog"
                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="dialog">
                                <div class="modal-content">

                                    <div class="modal-body">
                                        <!-- Form to edit the specific item using its ID -->
                                        <div class="card">
                                            <div class="card-body">

                                                @include("backend.pages.roles.info")

                                            </div>
                                        </div>
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
                    {{-- {{ $membres->links('pagination::bootstrap-4') }} --}}
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">

                <!--  modale -->
                <div class="modal fade exampleModal" id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog exampleModal" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class=" card-body">
                                                @include("backend.pages.roles.create")


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




@endsection

