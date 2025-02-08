@extends("layouts.master")

@section('contenu')


<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('admin.roles.add.roles.permission')}}" class="btn btn-inverse-info">Ajouter Profil de droit</a>
        </ol>

    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">Liste droit de profile</h6>
    <div class="table-responsive">
      <table  class="table">
        <thead>
          <tr>
            <th>Id#</th>
            <th>Nom profile</th>
            <th>Droit</th>
            <th>Action</th>

          </tr>
        </thead>

        <tbody>
          @foreach ($roles as $key => $item )
          <tr>
            <td>{{$key + 1}}</td>
            <td>{{$item->name}}</td>

            <td>
                @foreach ($item->permissions as $perm )
                <span class="badge bg-danger">
                    {{$perm->name}}
                </span>

                @endforeach

            </td>

            <td>
                <a href="{{route('admin.roles.admin.edit.roles',$item->id)}}" class="btn btn-inverse-warning"><i class="far fa-edit"></i></a>
                <a href="{{route('admin.roles.admin.delete.roles',$item->id)}}" class="btn btn-inverse-danger" id="delete"><i class="far fa-trash-alt"></i></a>

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
