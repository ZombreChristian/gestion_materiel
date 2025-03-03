@include('livewire.membres.test')


<div class="row ">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-gradient-primary d-flex align-items-center">
          <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i> Liste des prêts</h3>

          <div class="card-tools d-flex align-items-center ">

            <div class="input-group input-group-md" style="width: 250px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="row p-4 pt-5">
          <!-- Le reste du contenu de votre vue -->

          <!-- Nouvelle section pour afficher les cartes des utilisateurs -->


          <div class="col-12">
              <div class="card-columns">
                  @foreach($resultats as $resultat)
                      <div class="card">
                          <img src="{{ $resultat->membres->sexe == 'F' ? asset('images/woman.png') : asset('images/man.png') }}" class="card-img-top" alt="...">
                          <div class="card-body">
                              <h5 class="card-title">
                                @if ($resultat->membres)
                                    {{ $resultat->membres->nom }} {{ $resultat->membres->prenom }}
                                @else
                                aucun
                              @endif

                            </h5><br>

                            <p >Montant emprunté: <a style="color: red">{{ $resultat->membres->montant }}F</a></p>

                              <p class="card-text">Montant payé:{{ $resultat->somme_montants }}F</p>

                              <p>Montant restant: {{ $resultat->membres->montant - $resultat->somme_montants }}</p>
                              {{-- <p class="card-text">Somme payé:25.000 F</p>
                              <p class="card-text">Somme restante:75.000 F</p> --}}

                          </div>

                      </div>
                  @endforeach
              </div>
          </div>

                      <!-- Ajouter les liens de pagination -->

      </div>


        <!-- /.card-body -->
        <div class="card-footer">
            <div class="float-right">
                {{ $resultats->links('pagination::bootstrap-4') }}
            </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
</div>


{{--  --}}

@include('livewire.membres.test')


<div class="row ">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-gradient-primary d-flex align-items-center">
          <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i> Liste des prêts</h3>

          <div class="card-tools d-flex align-items-center ">

            <div class="input-group input-group-md" style="width: 250px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="row p-4 pt-5">
          <!-- Le reste du contenu de votre vue -->

          <!-- Nouvelle section pour afficher les cartes des utilisateurs -->

                      <!-- Ajouter les liens de pagination -->
      </div>


        <!-- /.card-body -->
        <div class="card-footer">
            <div class="float-right">
                {{ $resultats->links('pagination::bootstrap-4') }}
            </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
</div>



