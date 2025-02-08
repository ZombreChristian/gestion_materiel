

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js">

</script>

<style type="text/css">
    .form-check-label{
        text-transform: capitalize;
    }
</style>


@extends("layouts.master")

@section('contenu')
<div class="page-content">


            <div class="row profile-body">


                    <!-- middle wrapper start -->
                    <div class="col-md-12 col-xl-12 middle-wrapper">

                            <div class="card">
                                <div class="card-body">
                                                  <h6 class="card-title">Edit Role in Permission</h6>
                                                <form method="POST" action="{{route('admin.roles.update.roles',$role->id)}}" class="forms-sample" enctype="multipart/form-data">
                                                    @csrf
                                                      <div class="form-group">
                                                        <input type="hidden" name="id" value="">

                                                          <label for="exampleInputUsername1">Nom du profile</label>

                                                      </div>

                                                    <div class="form-check mb-2">
                                                            <input type="checkbox" class="form-check-input" id="checkDefaultmain">
                                                                 <label class="form-check-label" for="checkDefaultmain">Tous les droits                                                                            </label>
                                                    </div>

                                                    <hr>

                                                    @foreach($permission_groups as $group)

                                                    <div class="row">
                                                        <div class="col-3">

                                                        @php
                                                            $permissions = App\Models\User::getpermissionByGroupName($group->group_name)
                                                        @endphp

                                                            <div class="form-check mb-2">
                                                                <input type="checkbox" class="form-check-input" id="checkDefault" {{App\Models\User::roleHasPermissions($role,$permissions) ? 'checked':''}}>
                                                                     <label class="form-check-label" for="checkDefault">{{$group->group_name}} </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-9 ">


                                                    @foreach($permissions as $permission )


                                                            <div class="form-check mb-2">
                                                                <input type="checkbox" class="form-check-input" id="checkDefault{{$permission->id}}" value="{{$permission->id}}" name="permission[]" {{$role->hasPermissionTo($permission->name)? 'checked': ''}}>
                                                                <label class="form-check-label" for="checkDefault{{$permission->id}}">{{$permission->name}}</label>
                                                            </div>

                                                    @endforeach
                                                            <br>
                                                        </div>

                                                    </div> <!--///fin row-->

                                                    @endforeach





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

<script type="text/javascript">
    $('#checkDefaultmain').click(function(){
        if ($(this).is(':checked')){
            $('input[type = checkbox]').prop('checked',true);
         }else{
            $('input[type = checkbox]').prop('checked',false);

         }
    });

</script>

@endsection
