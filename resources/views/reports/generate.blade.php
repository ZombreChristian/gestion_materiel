@extends('layouts.master')

@section('contenu')
<div class="container mx-auto px-4 py-8">
    <!-- Titre de la page -->
    <h1 class="text-3xl font-bold text-center mb-8">Module d’analyse et de rapports</h1>

    <!-- Description du module -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <p class="text-gray-700">
            Ce module permet de générer des rapports et d’analyser l’utilisation des équipements pour faciliter la prise de décisions stratégiques.
        </p>
    </div>

    <!-- Fonctionnalités clés -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
        <!-- Tableaux de bord interactifs -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Tableaux de bord interactifs</h2>
            <p class="text-gray-700">
                Les administrateurs et responsables peuvent visualiser des tableaux de bord avec des graphiques dynamiques, comme le taux de réservation, l’utilisation des équipements, et les plages horaires les plus sollicitées.
            </p>
            <div class="mt-4">
                <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    <i class="fas fa-chart-line mr-2"></i> Voir les tableaux de bord
                </a>
            </div>
        </div>

        <!-- Rapports détaillés -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Rapports détaillés</h2>
            <p class="text-gray-700">
                Génération de rapports sur les réservations effectuées, l’utilisation des équipements, la fréquence des annulations, les équipements sous-utilisés, etc.
            </p>
            <div class="mt-4">
                <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    <i class="fas fa-file-alt mr-2"></i> Générer un rapport
                </a>
            </div>
        </div>

        <!-- Prévision des besoins -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Prévision des besoins</h2>
            <p class="text-gray-700">
                Basé sur les tendances d’utilisation des équipements, le système peut générer des prévisions concernant la demande future et suggérer des achats ou la maintenance des équipements.
            </p>
            <div class="mt-4">
                <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    <i class="fas fa-chart-pie mr-2"></i> Voir les prévisions
                </a>
            </div>
        </div>

        <!-- Exportation des données -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Exportation des données</h2>
            <p class="text-gray-700">
                Les utilisateurs peuvent exporter les rapports sous différents formats (PDF, Excel) pour des analyses approfondies ou des présentations.
            </p>
            <div class="mt-4 space-x-4">
                <a href="{{ route('reports.export.pdf') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    <i class="fas fa-file-pdf mr-2"></i> Exporter en PDF
                </a>
                <a href="{{ route('reports.export.excel') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                    <i class="fas fa-file-excel mr-2"></i> Exporter en Excel
                </a>
            </div>
        </div>
    </div>

    <!-- Section pour les graphiques dynamiques (exemple) -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold mb-4">Graphiques dynamiques</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Graphique 1 : Taux de réservation -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-2">Taux de réservation</h3>
                <canvas id="reservationChart" class="w-full h-64"></canvas>
            </div>

            <!-- Graphique 2 : Utilisation des équipements -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-2">Utilisation des équipements</h3>
                <canvas id="equipmentUsageChart" class="w-full h-64"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Scripts pour les graphiques (Chart.js) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique 1 : Taux de réservation
    const reservationCtx = document.getElementById('reservationChart').getContext('2d');
    new Chart(reservationCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
            datasets: [{
                label: 'Taux de réservation',
                data: [65, 59, 80, 81, 56, 55],
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    // Graphique 2 : Utilisation des équipements
    const equipmentUsageCtx = document.getElementById('equipmentUsageChart').getContext('2d');
    new Chart(equipmentUsageCtx, {
        type: 'bar',
        data: {
            labels: ['Équipement A', 'Équipement B', 'Équipement C', 'Équipement D'],
            datasets: [{
                label: 'Heures d\'utilisation',
                data: [120, 90, 150, 80],
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });
</script>
@endsection