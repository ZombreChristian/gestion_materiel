
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<style>

.menu-text {
    margin-left: 10px; /* Ajustez la valeur selon l'espace souhaité */
}
</style>

@section('contenu')
<li class="nav-item">
    <a href="{{route('admin.dashboard')}}" class="nav-link">
        <i class="link-icon" data-feather="box"></i>
        <span class=
        "link-title">Accueil</span>
    </a>
    </li>
@endsection


<nav class="sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Service<span>BIR</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
           @yield('contenu')
           <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Tableau de bord

                </p>
              </a>


        </li>


        {{-- @if (Auth::user()->can('menu.role')) --}}

        {{-- <li  class="nav-icon fas fa-cogs">Profiles et Droits</li> --}}

        {{-- <li class="nav-item">


            <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
               Profiles et Droits
                </p>
            </a>
            <div class="collapse" id="advancedUI">
                <ul class="nav sub-menu">
                <li class="nav-item">
                    <a href="{{route('all.permission')}}" class="nav-link">Liste des droits</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('all.roles')}}" class="nav-link">Liste profiles</a>
                    </li>

                    <li class="nav-item">
                    <a href="{{route('add.roles.permission')}}" class="nav-link">Droits de profile</a>
                    </li>

                    <li class="nav-item">
                    <a href="{{route('all.roles.permission')}}" class="nav-link">Liste des Droits de Profiles</a>
                    </li>
                </ul>
            </div>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false" aria-controls="advancedUI">
                <i class="nav-icon fas fa-cogs"></i>
                <span class="link-title">Profiles et Droits</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="advancedUI">
                <ul class="nav sub-menu">
                <li class="nav-item">
                    <a href="#" class="nav-link">Liste des droits</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('all.roles')}}" class="nav-link">Liste profiles</a>
                    </li>

                    <li class="nav-item">
                    <a href="{{route('add.roles.permission')}}" class="nav-link">Droits de profile</a>
                    </li>

                    <li class="nav-item">
                    <a href="{{route('all.roles.permission')}}" class="nav-link">
                        <i class="nav-icon fas fa-fingerprint"></i>
                        <p>Liste des Droits de Profiles</p>
                    </a>
                    </li>
                </ul>
            </div>
        </li>

         {{-- @endif --}}

        {{-- @if (Auth::user()->can('menu.utilisateur')) --}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#admin" role="button" aria-expanded="false" aria-controls="advancedUI">
                <i class="nav-icon fas fa-cogs" ></i>
                <span class="link-text">Gestion Utilisateurs</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="admin">
                <ul class="nav sub-menu">

                    <a href="{{route('all.admin')}}" class="nav-link">Liste des utilisateurs</a>

                </ul>
            </div>
        </li>

      {{-- @endif --}}





   {{-- @if (Auth::user()->can('menu.personnel')) --}}
   <li class="nav-item">

    <a class="nav-link" data-toggle="collapse" href="#personnel" role="button" aria-expanded="false" aria-controls="emails">
        <i class="nav-icon fas fa-cogs" ></i>
        <span class="link-text">Personnel et mission</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
    </a>


         <div class="collapse" id="personnel">
         <ul class="nav sub-menu">

                        <!-- menu service -->

                    <a  class="nav-link" href="{{ route('all.personnel') }}">
                        <i data-feather="users"></i>

                        <span class="menu-text">Personnel</span>
                    </a>



     <!-- fin menu service -->

     <!-- menu visiteur -->

                    <a href="{{ route('all.mission') }}" class="nav-link">
                        <i data-feather="target"></i>


                        <span class="menu-text">Mission
                    </a>

     <!-- fin menu visiteur -->
<br>
   <!-- menu permanence -->
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#indis" role="button" aria-expanded="false" aria-controls="emails">
                        <i data-feather="slash"></i>

                        <span class="menu-text">Indisponibilité</span>

                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    {{-- <div class="collapse" id="indis">
                        <ul class="nav sub-menu">
                            <a href="{{ route('all.permissionIndisponibilite') }}" class="nav-link">
                                <i class="fas fa-key"></i>
                                <span class="menu-text"> permission</span>
                            </a>
                            <a href="{{ route('all.nonRejoin') }}" class="nav-link">
                                <i class="fas fa-user-slash"></i>
                                <span class="menu-text"> Non-rejoins</span>
                            </a>
                            <a href="{{ route('all.malade') }}" class="nav-link">
                                <i class="fas fa-bed"></i>
                                <span class="menu-text"> Maladie</span>
                            </a>
                            <a href="{{ route('all.prison') }}" class="nav-link">
                                <i class="fas fa-warehouse"></i>
                                <span class="menu-text"> Prison</span>
                            </a>
                            <a href="{{ route('all.stage') }}" class="nav-link">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <span class="menu-text"> Stage</span>
                            </a>

                        </ul>
                    </div> --}}


 <!-- fin menu permanence -->

     <!-- fin menu Evènenment -->

     <!-- menu permanence -->
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#pers" role="button" aria-expanded="false" aria-controls="emails">
                    <i data-feather="box"></i>
                    <span class="menu-text">Structuration</span>

                    <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    {{-- <div class="collapse" id="pers">
                        <ul class="nav sub-menu">

                            <a href="{{ route('all.compagnie') }}" class="nav-link">
                                <i class="fas fa-building"></i>
                                <span class="menu-text">Compagnie</span>
                            </a>

                            <a href="{{ route('all.section') }}" class="nav-link">
                                <i class="fas fa-th-large "></i>
                                <span class="menu-text">Section</span>
                            </a>
                            <a href="{{ route('all.groupe') }}" class="nav-link">
                                <i class="fas fa-users"></i>
                                <span class="menu-text">Groupe</span>
                            </a>

                            <a href="{{ route('all.fonction') }}" class="nav-link">
                                <i class="fas fa-cogs "></i>
                                <span class="menu-text">Fonction</span>
                            </a>

                            <a href="{{ route('all.specialite') }}" class="nav-link">
                                <i class="fas fa-flask"></i>
                                <span class="menu-text">Specialite</span>
                            </a>

                            <a href="{{ route('all.categorie') }}" class="nav-link">
                                <i class="fas fa-layer-group"></i>
                                <span class="menu-text">Categorie</span>
                            </a>


                            <a href="{{ route('all.grade') }}" class="nav-link">
                                <i class="fas fa-graduation-cap"></i>
                                <span class="menu-text">Grade</span>
                            </a>

                            <a href="{{ route('all.moyenmission') }}" class="nav-link">
                                <i class="fas fa-tools"></i>
                                <span class="menu-text"> Moyens
                            </a>

                        </ul>
                    </div> --}}
                </li>

 <!-- fin menu permanence -->

</ul>
</div>

</li>






       {{-- @endif --}}

    {{-- @if (Auth::user()->can('menu.permanence')) --}}


    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#permanence" role="button" aria-expanded="false" aria-controls="emails">
        <i class="nav-icon fas fa-cogs"></i>
        <span class="link-text"> Gestion de Permanence</span>

        <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
      <div class="collapse" id="permanence">
        <ul class="nav sub-menu">

            <!-- menu service -->
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#service" role="button" aria-expanded="false" aria-controls="emails">

                        <span class="link-text">Gestion de Services</span>

                        <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="service">
                        <ul class="nav sub-menu">


                            <li class="nav-item">
                            <a href="{{route('all.service')}}" class="nav-link">Liste Service</a>
                            </li>

                        </ul>
                        </div>
                    </li>

                    <!-- fin menu service -->

                    <!-- menu visiteur -->
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#visiteur" role="button" aria-expanded="false" aria-controls="emails">
                        <span class="link-text">Gestion des Visiteurs</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="visiteur">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                            <a href="{{route('all.visit')}}" class="nav-link">Liste Visiteurs</a>
                            </li>
                        </ul>
                        </div>
                    </li>
                    <!-- fin menu visiteur -->

                    <!-- menu évènenment -->
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#evenement" role="button" aria-expanded="false" aria-controls="emails">
                        <span class="link-text">Gestion des Evènenments</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="evenement">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                            <a href="{{route('all.even')}}" class="nav-link">Liste Evènements</a>
                            </li>
                        </ul>
                        </div>
                    </li>

                    <!-- fin menu Evènenment -->

                    <!-- menu permanence -->
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#perm" role="button" aria-expanded="false" aria-controls="emails">
                            <span class="link-text">Nouvelle de Permanence</span>

                            <i class="link-arrow" data-feather="chevron-down"></i>
                            </a>
                            <div class="collapse" id="perm">
                                <ul class="nav sub-menu">

                                    <li class="nav-item">
                                        <a href="{{route('all.poste')}}" class="nav-link">Poste de Garde</a>
                                    </li>


                                    <li class="nav-item">
                                        <a href="{{route('all.moyen')}}" class="nav-link">Moyen Poste</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('all.perma')}}" class="nav-link">Liste Permanence</a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                <!-- fin menu permanence -->

        </ul>
      </div>

    </li>



{{-- @endif --}}

{{-- @if (Auth::user()->can('menu.AMO')) --}}


{{-- @section('gestionnaire') --}}
      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#gestion" role="button" aria-expanded="false" aria-controls="emails">
            <i class="nav-icon fas fa-cogs"></i>
            <span class="link-text">Gestionnaire</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>

          <div class="collapse" id="gestion">
              <ul class="nav sub-menu menu-open">


                      <a class="nav-link" data-toggle="collapse" href="#amo" role="button" aria-expanded="false" aria-controls="emails">

                        <span class="link-text">Gestion Armes</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                      </a>
                      <div class="collapse" id="amo">
                        <ul class="nav sub-menu active">
                          {{-- @if (Auth::user()->can('test1')) --}}

                            {{-- <a href="{{route('all.arme')}}"
                                class="nav-link">
                            <i class="nav-icon fas fa-list-ul"></i>
                            <p>Armes</p>
                            </a> --}}

                            <a href="{{ route('all.arme') }}" class="nav-link {{ request()->is('all/arme') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-list-ul"></i>
                                <p>Armes</p>
                            </a>


                          {{-- @endif --}}

                            <a href="{{route('all.typearme')}}"
                                class="nav-link">
                            <i class="nav-icon far fa-circle"></i>
                            <p>Type d'armes</p>
                            </a>

                            <a href="{{route('all.stockArmeDote')}}"
                                class="nav-link">
                            <i class="nav-icon fas fa-list-ul"></i>
                            <p>Armes dotées</p>
                            </a>

                            <a href="{{route('all.etat')}}"
                                class="nav-link">
                            <i class="nav-icon far fa-circle"></i>
                            <p>Etats</p>
                        </a>

                        <a href="{{route('all.pays')}}"
                            class="nav-link">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Provenances</p>
                    </a>


                        </ul>
                      </div>

                      <a class="nav-link" data-toggle="collapse" href="#muni" role="button" aria-expanded="false" aria-controls="emails">

                        <span class="link-text">Gestion Munitions</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                      </a>
                      <div class="collapse" id="muni">
                        <ul class="nav sub-menu">
                          {{-- @if (Auth::user()->can('all.arme')) --}}

                           <a href="{{route('all.typemunition')}}"
                                class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Type de munition</p>
                            </a>

                            <a href="{{route('all.munition')}}"
                                class="nav-link">
                            <i class="nav-icon fas fa-list-ul"></i>
                            <p>Stock Munitions</p>
                            </a>

                          {{-- @endif --}}


                        </ul>
                      </div>

                      <a class="nav-link" data-toggle="collapse" href="#opt" role="button" aria-expanded="false" aria-controls="emails">

                        <span class="link-text">Gestion Optiques</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                      </a>
                      <div class="collapse" id="opt">
                        <ul class="nav sub-menu">
                          {{-- @if (Auth::user()->can('all.arme')) --}}

                          <a href="{{route('all.optique')}}"
                          class="nav-link">
                      <i class="nav-icon fas fa-list-ul"></i>
                      <p>Optiques</p>
                      </a>



                          {{-- @endif --}}


                        </ul>
                      </div>









                      <a class="nav-link" data-toggle="collapse" href="#auto" role="button" aria-expanded="false" aria-controls="emails">
                        <span class="link-text">Gestion Auto</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                      </a>
                      <div class="collapse" id="auto">
                        <ul class="nav sub-menu">
                          <li class="nav-item">
                            <a href="{{route('all.vehicule')}}" class="nav-link">Vehicules</a>
                          </li>
                          <li class="nav-item">
                            <a href="{{route('all.moto')}}" class="nav-link">Motos</a>
                          </li>
                        </ul>
                      </div>



                      <a class="nav-link" data-toggle="collapse" href="#dotation" role="button" aria-expanded="false" aria-controls="emails">
                        <span class="link-text">Gestion Dotation</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                      </a>
                      <div class="collapse" id="dotation">
                        <ul class="nav sub-menu">
                          <li class="nav-item">
                            <a href="{{route('all.dotation')}}" class="nav-link">Dotations</a>
                          </li>
                        </ul>
                    </div>

                    <a class="nav-link" data-toggle="collapse" href="#bon" role="button" aria-expanded="false" aria-controls="emails">

                        <span class="link-text">Gestion Bon</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                      </a>
                      <div class="collapse" id="bon">
                        <ul class="nav sub-menu">
                          <li class="nav-item">
                            <a href="{{route('all.bon')}}" class="nav-link">Bons</a>
                          </li>
                        </ul>
                      </div>




                </ul>



          </div>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-circle"></i>
            <p>
           Gestion du
            <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        <ul class="nav nav-treeview" style="display: none;">

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                        Niveau 2
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Niveau 3</p>
                                </a>
                            </li>

                            <li class="nav-item active">
                                <a href="#" class="nav-link active ">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p> Niveau 4 </p>
                                </a>
                            </li>

                    </ul>

                </li>

        </ul>
    </li>
    <li class="nav-item ">
        <a href="#" class="nav-link ">
          <i class=" nav-icon fas fa-user-shield"></i>
          <p>
            Gestion des profiles
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>

        <ul class="nav nav-treeview">
          <li class="nav-item ">
            <a
            {{-- href="{{route('admin.habilitations.users.index')}}" --}}
            href="#{{--route('admin.habilitations.users.index')--}}"


            class="nav-link"
            >
              <i class=" nav-icon fas fa-users-cog"></i>
              <p>Utilisateurs</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fingerprint"></i>
              <p>Roles et permissions</p>
            </a>
          </li>
        </ul>
    </li>


        {{-- @endif --}}




        <li class="nav-item {{ setMenuClass('all.arme', 'menu-open') }}">
            <a href="#" class="nav-link {{ setMenuClass('all.arme', 'active') }}">
                <i class="nav-icon fas fa-circle"></i>
                <p>
               Gestion armes
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">

                    <li class="nav-item {{ setMenuClass('all.arme', 'menu-open') }}">
                        <a href="#" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                            Niveau 2
                            <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('all.arme')}}"
                                    class="nav-link  {{ setMenuActive('all.arme') }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Niveau 3</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#"
                                    class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Niveau 4</p>
                                    </a>
                                </li>



                        </ul>

                    </li>

            </ul>
        </li>


      </ul>





    </div>
  </nav>
