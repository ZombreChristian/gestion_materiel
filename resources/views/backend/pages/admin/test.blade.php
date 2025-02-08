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
                                                  <h6 class="card-title">Edit Admin</h6>


                                                <form method="POST" action="{{route('update.admin',$user->id)}}" class="forms-sample" enctype="multipart/form-data">
                                                    @csrf

                                                      <div class="form-group mb-3">
                                                          <label for="exampleInputUsername1">Nom utilisateur</label>
                                                          <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" autocomplete="off" value="{{$user->username}}">
                                                          @error('username')
                                                            <span class="text-danger">{{ $message}}</span>
                                                          @enderror
                                                      </div>
                                                      <div class="form-group mb-3">
                                                        <label for="exampleInputUsername1">Nom</label>
                                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" autocomplete="off" value="{{$user->name}}">
                                                        @error('name')
                                                          <span class="text-danger">{{ $message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="exampleInputUsername1">Adresse Email</label>
                                                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" autocomplete="off" value="{{$user->email}}">
                                                        @error('email')
                                                          <span class="text-danger">{{ $message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="exampleInputUsername1">Telephone</label>
                                                        <input type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" autocomplete="off" value="{{$user->phone}}">
                                                        @error('phone')
                                                          <span class="text-danger">{{ $message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="exampleInputUsername1">Adresse rue</label>
                                                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" autocomplete="off" value="{{$user->address}}">
                                                        @error('address')
                                                          <span class="text-danger">{{ $message}}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="exampleInputUsername1">Profile</label>
                                                        <select name="roles" class="form-select @error('group_name') is-invalid @enderror" id="exampleFormControlSelect1" >
                                                            <option selected="" disabled="" >Select Role</option>
                                                                @foreach ($roles as $role )
                                                                    <option value="{{$role->id}}" {{$user->hasRole($role->name)? 'selected':''  }}>{{$role->name}}</option>
                                                               @endforeach
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mr-2">Enregister</button>


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
