{{-- <div class="row p-4 pt-5">
            <div class="col-md-6"> --}}
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire de création d'un type de materiel</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('equipements.store.type')}}" class="forms-sample"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id" value="">

                    <label for="exampleInputUsername1">Type de materiel</label>
                    <input type="text" class="form-control @error('nom') is-invalid @enderror"
                        name="nom" autocomplete="off">
                    @error('nom')
                    <span class="text-danger">{{ $message}}</span>
                    @enderror
                </div>



                <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Fermer</button>
            </form>
              </div>
              <!-- /.card -->
  {{--
            </div>
          </div> --}}




