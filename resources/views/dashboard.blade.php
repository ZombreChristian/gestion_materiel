

@extends("layouts.master")

@section("contenu")
    <div class="row">
        <div class="col-12 p-4">
            <div class="jumbotron">
                <h1 class="display-3">Bienvenue, <strong>{{ auth()->user()->name }}</strong></h1>
                @foreach(auth()->user()->roles as $role)
                    <p>{{ $role->nom }}</p>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">

                <h3>{{ $totalUtilisateurs }}</h3>
                    <p>Utilisateurs</p>
                </div>
                    <div class="icon">
                    <i class="fas fa-users" style="color: white;"></i> <!-- Font Awesome -->
                    </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $tauxReservation }}</h3>
                    <p>Réservations</p>
                </div>
                     <div class="icon">
                        <i class="fas fa-calendar-check" style="color: white;"></i> <!-- Font Awesome -->
                     </div>

                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalAnnulations }}</h3>
                    <p>Annulations</p>
                </div>
                      <div class="icon">
                        <i class="fas fa-times-circle" style="color: white;"></i> <!-- Font Awesome -->
                      </div>


                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalEquipements }}</h3>
                    <p>Matériels</p>
                </div>

                    <div class="icon">
                     <i class="fas fa-tools" style="color: white;"></i> <!-- Font Awesome -->
                    </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste des utilisateurs</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Rôle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            {{ $role->nom }}
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer d-flex justify-content-center">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- @extends('livewire.cotisations.accueil') --}}
