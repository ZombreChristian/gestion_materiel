<div class="row p-4 pt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-gradient-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fa fa-list fa-2x"></i> Liste des materiels</h3>

                <div class="card-tools d-flex align-items-center ">
                <a class="btn btn-link text-white mr-4 d-block" wire:click="showAddmaterielModal"><i class="fas fa-user-plus"></i> Ajouter un materiel</a>
                  <div class="input-group input-group-md" style="width: 250px;">
                    <input type="text" name="table_search" wire:model.debounce.250ms="search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 table-striped" >
                <div class="d-flex justify-content-end p-4 bg-indigo">
                    <div class="form-group mr-3">
                        <label for="filtreType">Filtrer par type</label>
                        <select  id="filtreType" wire:model="filtreType" class="form-control">
                                <option value=""></option>
                                @foreach ($typemateriels as $typemateriel)
                                    <option value="{{$typemateriel->id}}">{{ $typemateriel->nom }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="filtreEtat">Filtrer par etat</label>
                        <select  id="filtreEtat" wire:model="filtreEtat" class="form-control">
                            <option value=""></option>
                            <option value="1">Disponible</option>
                            <option value="0">Indisponible</option>
                        </select>
                    </div>
                </div>
                <div style="height:350px;">
                    <table class="table table-head-fixed">
                    <thead>
                        <tr>
                        <th></th>
                        <th >materiel</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Etat</th>
                        <th  class="text-center">Ajouté</th>
                        <th  class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                            @forelse ($materiels as $materiel)
                                <tr>
                                    <td>
                                        <img src="{{asset($materiel->imageUrl)}}" alt="" style="width:60px;height:60px;">

                                    </td>
                                    <td>{{ $materiel->nom }} - {{ $materiel->noSerie }}</td>
                                    <td class="text-center">{{ $materiel->type->nom }}</td>
                                    <td class="text-center">
                                        @if($materiel->estDisponible)
                                            <span class="badge badge-success">Disponible</span>
                                        @else
                                            <span class="badge badge-danger">Indisponible</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ optional($materiel->created_at)->diffForHumans() }}</td>
                                    <td class="text-center">

                                        <!-- <a 
                                        title="Tarifs {{ $materiel->nom }}"
                                        href="{{ route('admin.gestmateriels.materiels.tarifs', ['materielId'=> $materiel->id]) }}" class="btn btn-link" > <i class="fas fa-money-check"></i> </a> -->

                                        <button class="btn btn-link" wire:click="editmateriel({{$materiel->id}})"> <i class="far fa-edit"></i> </button>

                                        <button class="btn btn-link" wire:click="confirmDelete({{$materiel->id}})"> <i class="far fa-trash-alt"></i> </button>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-danger">

                                            <h5><i class="icon fas fa-ban"></i> Information!</h5>
                                            Aucune donnée trouvée par rapport aux éléments de recherche entrés.
                                            </div>
                                    </td>
                                </tr>
                            @endforelse
                    </tbody>
                    </table>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                    {{ $materiels->links() }}
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
    </div>