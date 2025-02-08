@extends('admin.admin_dashboard')

<script src="https::ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js">

</script>
@section('admin')
<div class="page-content">


            <div class="row profile-body">


                    <!-- middle wrapper start -->
                    <div class="col-md-8 col-xl-8 middle-wrapper">

                            <div class="card">
                                <div class="card-body">
                                                  <h6 class="card-title">Ajouter utilisateur</h6>


                                                <form method="POST" action="{{route('store.admin')}}" class="forms-sample" enctype="multipart/form-data">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>

                                                      <div class="form-group mb-3">
                                                          <label for="exampleInputUsername1">Nom utilisateur</label>
                                                          <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" autocomplete="off" value="">
                                                          @error('username')
                                                            <span class="text-danger">{{ $message}}</span>
                                                          @enderror
                                                      </div>
                                                      <div class="form-group mb-3">
                                                        <label for="exampleInputUsername1">Nom</label>
                                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" autocomplete="off" value="">
                                                        @error('name')
                                                          <span class="text-danger">{{ $message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="exampleInputUsername1">Adresse-email</label>
                                                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" autocomplete="off" value="">
                                                        @error('email')
                                                          <span class="text-danger">{{ $message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="exampleInputUsername1">Téléphone</label>
                                                        <input type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" autocomplete="off" value="">
                                                        @error('phone')
                                                          <span class="text-danger">{{ $message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="exampleInputUsername1">Addresse rue</label>
                                                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" autocomplete="off" value="">
                                                        @error('address')
                                                          <span class="text-danger">{{ $message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="exampleInputUsername1">Mot de passe</label>
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="off" value="">
                                                        @error('password')
                                                          <span class="text-danger">{{ $message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="exampleInputUsername1">Nom profile</label>
                                                        <select name="roles" class="form-select @error('group_name') is-invalid @enderror" id="exampleFormControlSelect1" >
                                                            <option selected="" disabled="" >Select Profile</option>
                                                                @foreach ($roles as $role )
                                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                               @endforeach ()

                                                    </div>


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
