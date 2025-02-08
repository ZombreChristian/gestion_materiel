@extends("layouts.master")

@section('contenu')


<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <button type="button" class="btn btn-inverse-info" data-toggle="modal" data-target="#exampleModal">
                Ajouter Profil
            </button>
            <!--  modale -->

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajouter un Profil</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class=" card-body">
                                    

                                </div>
                            </div>


                        </div>

                    </div>
                </div>

            </div>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Liste profile</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
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
                                        <button type="button" class="btn btn-inverse-warning" data-toggle="modal"
                                            data-target="#editModal{{$item->id}}">
                                            <i class="far fa-edit"></i>
                                        </button>


                                        <!-- Edit Modal -->

                                        <div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" role="dialog"
                                            aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Permission</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h6 class="card-title">Modifier profile</h6>
                                                                <form method="POST" action="{{route('admin.roles.update.roles')}}"
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
                                                                </form>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{route('admin.roles.delete.roles',$item->id)}}" class="btn btn-inverse-danger"
                                            id="delete"><i class="far fa-trash-alt"></i></a>

                                    </td>


                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>






@endsection






