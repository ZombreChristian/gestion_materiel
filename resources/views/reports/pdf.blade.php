<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport PDF</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Rapport d'Utilisation des Équipements</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Utilisation</th>
                <th>Réservations</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipmentUsageData as $equipement)
                <tr>
                    <td>{{ $equipement->nom }}</td>
                    <td>{{ $equipement->utilisation }} heures</td>
                    <td>{{ $equipement->reservations }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
