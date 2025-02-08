
{{-- <div class="row p-4 pt-5">
            <div class="col-md-6"> --}}
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire de modification d'un role</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
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
