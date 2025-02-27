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
                <th>Nombre</th>
                <th>Utilisation (%)</th>
                <th>Reservations</th>
                <th>Anulation</th>
                <th>Équipement sous-utiliser</th>
                <th>Équipement le plus utiliser</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipements as $equipement)
                <tr>
                    <td>{{ $equipement->nom }}</td>
                    <td>{{ $equipement->nombre }}</td>
                    <td>{{ $equipement->utilisation }}</td>
                    <td>{{ $equipement->reservations }}</td>
                    <td>{{ $equipement->annulations }}</td>
                    <td>{{ $mostUsedEquipment->nom}}</td>
                    <td>{{ $suggestion->utilisation}}</td>


                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
