@extends("layouts.master")
@section('contenu')


<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <button type="button" class="btn btn-inverse-info" data-toggle="modal" data-target="#exampleModal">
                Ajouter Droit
            </button>&nbsp;&nbsp;&nbsp;
            <!--  modale -->

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajouter un Droit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Ajouter droit</h6>
                                    <form method="POST" action="{{route('admin.roles.store.permission')}}" class="forms-sample"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="">

                                            <label for="exampleInputUsername1">Nom droit</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" autocomplete="off">
                                            @error('name')
                                            <span class="text-danger">{{ $message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Nom groupe</label>
                                            <input type="text"
                                                class="form-control @error('group_name') is-invalid @enderror"
                                                name="group_name" autocomplete="off">

                                            @error('group_name')
                                            <span class="text-danger">{{ $message}}</span>
                                            @enderror

                                        </div>


                                        <button type="submit" class="btn btn-primary mr-2">Save changes</button>
                                    </form>
                                </div>
                            </div>


                        </div>



                    </div>

                </div>
            </div>





            <button type="button" class="btn btn-inverse-warning" data-toggle="modal" data-target="#example1Modal">
                Import
            </button> &nbsp;&nbsp;&nbsp;
            <!--  modale -->
            <div class="modal fade" id="example1Modal" tabindex="-1" role="dialog" aria-labelledby="example1ModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="card-title">Import Droit</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>


                        <div class="modal-body">
                            <div class="card">
                                <div class=" card-body">

                                    <a href=" {{route('admin.roles.export')}}" class="btn btn-inverse-danger">Download
                                        Xlsx</a>&nbsp;&nbsp;&nbsp;

                                    <form method="POST" action="{{route('admin.roles.import')}}" class="forms-sample"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">

                                            <label for="exampleInputUsername1">Xlsx File Import</label>
                                            <input type="file" class="form-control @error('name') is-invalid @enderror"
                                                name="import_file" autocomplete="off">
                                            @error('name')
                                            <span class="text-danger">{{ $message}}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-warning  mr-2">Upload</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Fermer</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



            <a href="{{route('admin.roles.export')}}" class="btn btn-inverse-danger">Export</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Liste droits</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Id#</th>
                                    <th>Nom droit</th>
                                    <th>Nom groupe</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($permissions as $key => $item )
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->group_name}}</td>

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
                                                        <h5 class="modal-title" id="editModalLabel">Modifier Permission
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form to edit the specific item using its ID -->
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <form method="POST"
                                                                    action="{{ route('admin.roles.update.permission', ['id' => $item->id]) }}"
                                                                    class="forms-sample" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <!-- Rest of the form fields -->
                                                                    <div class="form-group">
                                                                        <label for="exampleInputUsername1">Nom
                                                                            droit</label>
                                                                        <input type="text"
                                                                            class="form-control @error('name') is-invalid @enderror"
                                                                            name="name" autocomplete="off"
                                                                            value="{{$item->name}}">
                                                                        @error('name')
                                                                        <span class=" text-danger">{{ $message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputUsername1">Nom
                                                                            groupe</label>
                                                                        <input type="text"
                                                                            class="form-control @error('group_name') is-invalid @enderror"
                                                                            name="group_name" autocomplete="off"
                                                                            value="{{$item->group_name}}">

                                                                        @error('group_name')
                                                                        <span class="text-danger">{{ $message}}</span>
                                                                        @enderror

                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-success mr-2">Enregistrer</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Fermer</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <a href="{{route('admin.roles.delete.permission',$item->id)}}"class="btn btn-inverse-danger" id="delete"><i class="far fa-trash-alt"></i></a>
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
