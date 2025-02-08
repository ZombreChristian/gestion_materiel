@extends('layouts.master')

@section('contenu')
<div class="page-content">


            <div class="row profile-body">


                    <!-- left wrapper start -->
                    <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
                        <div class="card rounded">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-2">

                                    <div>
                                        <img class="wd-100 rounded-circle" src="{{(!empty($profileData->photo))?url('upload/admin_images/'.$profileData->photo):url('upload/no_image.jpg')}}" alt="profile">
                                        <span class="h4 ms-3 ">{{$profileData->username}}</span>

                                    </div>

                                </div>
                                <div class="mt-3">
                                    <label class="tx-11 font-weight-bold mb-0 text-uppercase">Name:</label>
                                    <p class="text-muted">{{$profileData->name}}</p>
                                </div>
                                <div class="mt-3">
                                    <label class="tx-11 font-weight-bold mb-0 text-uppercase">Email:</label>
                                    <p class="text-muted">{{$profileData->email}}</p>
                                </div>
                                <div class="mt-3">
                                    <label class="tx-11 font-weight-bold mb-0 text-uppercase">Phone:</label>
                                    <p class="text-muted">{{$profileData->phone}}</p>
                                </div>
                                <div class="mt-3">
                                    <label class="tx-11 font-weight-bold mb-0 text-uppercase">Address:</label>
                                    <p class="text-muted">{{$profileData->address}}</p>
                                </div>
                                <div class="mt-3 d-flex social-links">
                                    <a href="javascript:;" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon github">
                                        <i data-feather="github" data-toggle="tooltip" title="github.com/nobleui"></i>
                                    </a>
                                    <a href="javascript:;" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon twitter">
                                        <i data-feather="twitter" data-toggle="tooltip" title="twitter.com/nobleui"></i>
                                    </a>
                                    <a href="javascript:;" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon instagram">
                                        <i data-feather="instagram" data-toggle="tooltip" title="instagram.com/nobleui"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- left wrapper end -->
                    <!-- middle wrapper start -->
                    <div class="col-md-8 col-xl-8 middle-wrapper">

                            <div class="card">
                                <div class="card-body">

                                                  <h6 class="card-title">Apdate Admin Profile</h6>
                                                <form method="POST" action="/admin/profile/store" class="forms-sample" enctype="multipart/form-data">
                                                    @csrf
                                                      <div class="form-group">
                                                          <label for="exampleInputUsername1">Username</label>
                                                          <input type="text" class="form-control" name="username" id="exampleInputUsername1" autocomplete="off" value="{{$profileData->username}}">
                                                      </div>
                                                      <div class="form-group">
                                                          <label for="exampleInputEmail1">Name</label>
                                                          <input type="text" class="form-control" name="name" id="exampleInputEmail1" value="{{$profileData->name}}">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="exampleInputEmail1">Email</label>
                                                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" value="{{$profileData->email}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Phone</label>
                                                        <input type="number" class="form-control" name="phone" id="exampleInputEmail1" value="{{$profileData->phone}}">
                                                    </div>
                                                      <div class="form-group">
                                                          <label for="exampleInputPassword1">Address</label>
                                                          <input type="text" class="form-control"name="address" id="exampleInputPassword1" autocomplete="off" value="{{$profileData->address}}">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="exampleInputPassword1">Photo</label>
                                                        <input class="form-control"name="photo" id="image" autocomplete="off" type="file">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1"></label>
                                                        <img type="password" class="wd-80 rounded-circle"name="address" id="showImage" autocomplete="off" src="{{(!empty($profileData->photo))?url('upload/admin_images/'.$profileData->photo):url('upload/no_image.jpg')}}" alt="profile">
                                                    </div>


                                                      <button type="submit" class="btn btn-primary mr-2">Save changes</button>
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
