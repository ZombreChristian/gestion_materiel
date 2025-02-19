<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport des Équipements</title>
</head>
<body>
    <h1>Rapport des équipements</h1>
    <table border="1">
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
</body>
</html>
