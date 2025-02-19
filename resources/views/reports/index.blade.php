
@extends('layouts.master')

@section('contenu')
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h1 class="card-title">Tableau de Bord - Rapports</h1>
        </div>
        <div class="card-body">
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
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Prévisions des besoins</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach ($suggestions as $suggestion)
                                    <li class="list-group-item">{{ $suggestion->nom }} : Taux d'utilisation faible ({{ $suggestion->utilisation }}%)</li>
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
                            <table id="equipmentsTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Équipement</th>
                                        <th>Utilisation (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Données chargées via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12 text-center">
                    <a href="{{ route('exportPdf') }}" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Télécharger en PDF</a>
                    <a href="{{ route('exportExcel') }}" class="btn btn-success ml-2"><i class="fas fa-file-excel"></i> Télécharger en Excel</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
