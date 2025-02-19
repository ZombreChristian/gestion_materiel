<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport des Équipements</title>
    <style>
        /* Style pour le tableau */
        table {
            width: 100%; /* Le tableau prend toute la largeur */
            border-collapse: collapse; /* Fusionner les bordures */
        }
        th, td {
            border: 1px solid #000; /* Bordures des cellules */
            padding: 8px; /* Espacement interne */
            text-align: left; /* Alignement du texte */
        }
        th {
            background-color: #f2f2f2; /* Couleur de fond pour l'en-tête */
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Rapport des Équipements</h1>
    <table>
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
