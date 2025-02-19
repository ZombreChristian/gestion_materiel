<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ setMenuActive('dashboard') }}">
                <i class="nav-icon fas fa-home"></i>
              <p>
                Accueil
              </p>
            </a>
          </li>

    {{-- @can("manager") --}}
    <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Tableau de bord
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          {{-- <li class="nav-item">
            <a href="#" class="nav-link active" role="button">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>Vue globale</p>
            </a>
          </li> --}}

          <li class="nav-item">
            <a class="nav-link active" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i> <p>Vue globale</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-swatchbook"></i>
              <p>Paramètres</p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{ route('reports.generate') }}" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>Générer un rapport</p>
            </a>
        </li>



        </ul>
    </li>
    {{-- @endcan --}}
    @auth
    {{-- @if (Auth::user()->can('menu.role')) --}}
    <li class="nav-item {{ setMenuClass('admin.roles', 'menu-open') }}">
        <a href="#" class="nav-link {{ setMenuClass('admin.roles', 'active') }}">
          <i class=" nav-icon fas fa-user-shield"></i>
          <p>
            Gestion des profiles
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item ">
            <a href="{{route('admin.roles.all.admin')}}"
            class="nav-link {{ setMenuActive('admin.roles.all.admin') }}"
            >
              <i class=" nav-icon fas fa-users-cog"></i>
              <p>Utilisateurs</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.roles.all.permission')}}"
            class="nav-link  {{ setMenuActive('admin.roles.all.permission') }}">
              <i class="nav-icon fas fa-fingerprint"></i>
              <p>Les droits</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin.roles.all.roles')}}"
            class="nav-link  {{ setMenuActive('admin.roles.all.roles') }}">
              <i class="nav-icon fas fa-fingerprint"></i>
              <p>Les profiles</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.roles.all.roles.permission')}}"
            class="nav-link  {{ setMenuActive('admin.roles.all.roles.permission') }}">
              <i class="nav-icon fas fa-fingerprint"></i>
              <p>Les droits de profiles</p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fingerprint"></i>
              <p>Listes des droits</p>
            </a>
          </li> --}}
        </ul>
    </li>

    {{-- @endif --}}
    {{--  --}}


    <li class="nav-item {{ setMenuClass('admin.membres', 'menu-open') }}">
        <a href="#" class="nav-link {{ setMenuClass('admin.membres', 'active') }}">
            <i class="nav-icon fas fa-circle"></i>
            <p>
           Gestion étudiants
            <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{route('admin.membres.all.membre')}}" class="nav-link {{ setMenuActive('admin.membres.all.membre') }}">

                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Etudiants</p>
                    </a>
                </li>
        </ul>
    </li>



    @endauth




    {{-- @endcan --}}

    </ul>
  </nav>
