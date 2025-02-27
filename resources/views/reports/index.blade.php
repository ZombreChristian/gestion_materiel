@extends('layouts.master')

@section('contenu')

<div class="row mb-4">

    </div>
<div class="container-fluid mt-4">
    <h1 class="mb-4">Tableau de Bord - Rapports</h1>

    <div class="col-md-12 text-center">
            <a href="{{ route('exportPdf') }}" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Télécharger en PDF
            </a>
            <a href="{{ route('exportExcel') }}" class="btn btn-success ml-2">
                <i class="fas fa-file-excel"></i> Télécharger en Excel
            </a>
        </div>

    <!-- Tableau combiné des équipements -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">Statistiques des Équipements</h3>
                </div>
                <div class="card-body">
                    <table id="combinedTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Équipement</th>
                                <th>Nombre</th>
                                <th>Utilisation (%)</th>
                                <th>Réservations</th>
                                <th>Annulations</th>
                                <th>Annulations Fréquentes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equipements as $equipement)
                                <tr>
                                    <td>{{ $equipement->nom }}</td>
                                    <td>{{ $equipement->nombre }}</td>
                                    <td>{{ number_format(($equipement->reservations * 100) / $equipement->nombre, 2) }}%</td>
                                    <td>{{ $equipement->reservations }}</td>
                                    <td>{{ $equipement->nombre - $equipement->reservations }}</td>
                                    <td>{{ $equipement->annulations > 0 ? 'Oui' : 'Non' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Section des statistiques détaillées et des graphiques -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">Statistiques Détails & Graphiques</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Équipement le plus utilisé -->
                        <div class="col-md-6">
                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-success text-white">
                                    <h3 class="card-title">Équipement le plus utilisé</h3>
                                </div>
                                <div class="card-body">
                                    <h4 class="text-center">{{ $mostUsedEquipment->nom }}</h4>
                                </div>
                            </div>
                        </div>

                        <!-- Suggestions d'équipements sous-utilisés -->
                        <div class="col-md-6">
                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-warning text-white">
                                    <h3 class="card-title">Équipements sous-utilisés (utilisation < 20%)</h3>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @forelse ($suggestions as $suggestion)
                                            <li class="list-group-item">
                                                {{ $suggestion->nom }} : Taux d'utilisation faible ({{ $suggestion->utilisation }}%)
                                            </li>
                                        @empty
                                            <li class="list-group-item text-muted">Aucun équipement sous-utilisé</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Tableau des annulations -->
                        <div class="col-md-6">
                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-secondary text-white">
                                    <h3 class="card-title">Fréquence des annulations</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Équipement</th>
                                                <th>Motif</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($equipements as $equipement)
                                                @if ($equipement->annulations > 0)
                                                    <tr>
                                                        <td>{{ now()->format('Y-m-d') }}</td>
                                                        <td>{{ $equipement->nom }}</td>
                                                        <td>Annulation fréquente</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Graphiques -->
                        <div class="col-md-6">
                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h3 class="card-title">Graphiques</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="reservationChart"></canvas>
                                    <canvas id="usageChart" class="mt-4"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Scripts pour les graphiques -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Graphique circulaire : Taux de réservation
        var reservationCtx = document.getElementById("reservationChart").getContext("2d");
        new Chart(reservationCtx, {
            type: "doughnut",
            data: {
                labels: ["Réservé", "Annulé"],
                datasets: [{
                    data: [{{ $totalReservations - $totalAnnulations }}, {{ $totalAnnulations }}],
                    backgroundColor: ["#28a745", "#dc3545"]
                }]
            }
        });

        // Graphique en barres : Utilisation des équipements
       // var usageCtx = document.getElementById("usageChart").getContext("2d");
        new Chart(usageCtx, {
            type: "bar",
            data: {
                labels: @json($equipements->pluck('nom')),
                datasets: [{
                    label: "Utilisation (%)",
                    data: @json($equipements->pluck('utilisation')),
                    backgroundColor: "rgba(54, 162, 235, 0.5)",
                    borderColor: "rgba(54, 162, 235, 1)",
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
   });
</script>
@endsection
