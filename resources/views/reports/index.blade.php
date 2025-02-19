@extends('layouts.master')

@section('contenu')
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h1 class="card-title">Tableau de Bord - Rapports</h1>
            </div>
            <div class="card-body">
                <!-- Section des graphiques interactifs -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Utilisation des équipements</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="usageChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Équipement le plus utilisé</h3>
                            </div>
                            <div class="card-body">
                                <h4 class="text-center">{{ $mostUsedEquipment }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section des prévisions et équipements sous-utilisés -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Prévisions des besoins</h3>
                            </div>
                            <div class="card-body">
                                <p>En fonction des tendances, voici nos suggestions :</p>
                                <ul class="list-group">
                                    @foreach ($suggestions as $suggestion)
                                        <li class="list-group-item">
                                            {{ $suggestion->nom }} : Taux d'utilisation faible ({{ $suggestion->utilisation }}%)
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Liste des équipements</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Équipement</th>
                                            <th>Utilisation (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($equipements as $equipement)
                                            <tr>
                                                <td>{{ $equipement->nom }}</td>
                                                <td>{{ $equipement->utilisation }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12 text-center">
                        <a href="{{ route('exportPdf') }}" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Télécharger en PDF
                        </a>
                        <a href="{{ route('exportExcel') }}" class="btn btn-success ml-2">
                            <i class="fas fa-file-excel"></i> Télécharger en Excel
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts pour les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Données pour le graphique d'utilisation des équipements
        var usageData = @json($equipements);
        var labels = usageData.map(e => e.nom);
        var usageValues = usageData.map(e => e.utilisation);

        // Graphique d'utilisation des équipements
        new Chart(document.getElementById('usageChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Utilisation (%)',
                    data: usageValues,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100 // Taux d'utilisation en pourcentage
                    }
                }
            }
        });

        // Exportation en PDF
        document.getElementById('exportPdf').addEventListener('click', function() {
            fetch("{{ route('exportPdf') }}")
                .then(response => response.blob())
                .then(blob => {
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "rapport.pdf";
                    link.click();
                });
        });

        // Exportation en Excel
        document.getElementById('exportExcel').addEventListener('click', function() {
            fetch("{{ route('exportExcel') }}")
                .then(response => response.blob())
                .then(blob => {
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "rapport.xlsx";
                    link.click();
                });
        });
    </script>
@endsection