@extends('admin.admin_dashboard')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js">

</script>
@section('admin')
<div class="page-content">


            <div class="row profile-body">


                    <!-- middle wrapper start -->
                    <div class="col-md-8 col-xl-8 middle-wrapper">

                            <div class="card">
                                <div class="card-body">
                                                  <h6 class="card-title">Modifier droit</h6>
                                                <form method="POST" action="{{route('update.permission')}}" class="forms-sample" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$permissions->id}}">

                                                      <div class="form-group">


                                                          <label for="exampleInputUsername1">Nom droit</label>
                                                          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" autocomplete="off" value="{{$permissions->name}}">
                                                          @error('name')
                                                            <span class="text-danger">{{ $message}}</span>
                                                          @enderror
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="exampleInputUsername1">Nom groupe</label>
                                                        <input type="text" class="form-control @error('group_name') is-invalid @enderror" name="group_name" autocomplete="off" value="{{$permissions->group_name}}">

                                                        @error('group_name')
                                                        <span class="text-danger">{{ $message}}</span>
                                                      @enderror

                                                    </div>


                                                      <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
                                                  </form>
                                </div>
                              </div>


                    </div>

                    <!-- middle wrapper end -->
                    <!-- right wrapper start -->

                    <!-- right wrapper end -->
        </div>

</div>

@endsection
