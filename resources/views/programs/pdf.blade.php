<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $program->name }}</title>
    <style>
        @page {
            margin: 0;
            size: A4;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            background-color: #2A303C;
            color: #A6ADBA;
            margin: 0;
            padding: 20px;
        }

        .header {
            background-color: #1D232A;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
        }

        h1 {
            color: #ffffff;
            font-size: 28px;
            margin: 0;
        }

        .program-info {
            background-color: #191E24;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .day-card {
            background-color: transparent;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            page-break-before: always;
        }

        h2 {
            color: #ffffff;
            font-size: 24px;
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 2px solid #4B5563;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #4B5563;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #374151;
            color: #ffffff;
            font-weight: bold;
        }

        tr {
            background-color: #242933;
        }

        .exercise-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            margin-right: 10px;
            vertical-align: middle;
            border-radius: 5px;
        }

        .exercise-name {
            vertical-align: middle;
        }

        .program-image {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .exercise-details {
            font-size: 14px;
            color: #8D99AE;
            margin-top: 5px;
        }

        .program-summary {
            margin-top: 15px;
            padding: 10px;
            background-color: #242933;
            border-radius: 8px;
            font-size: 15px;
        }
        .program-summary h3 {
            color: #ffffff;
            margin-top: 0;
            margin-bottom: 5px;
            font-size: 18px;
        }
        .program-summary ul {
            list-style-type: none;
            padding-left: 0;
            margin: 0;
        }
        .program-summary li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>{{ $program->name }}</h1>
</div>

<div class="program-info">
    <img src="{{ public_path($program->image) }}" alt="{{ $program->name }}" class="program-image">
    <p><strong>Description :</strong> {{ $program->description }}</p>
    <p><strong>Créé le :</strong> {{ $program->created_at->locale('fr')->isoFormat('LL') }}</p>
    <p><strong>Dernière mise à jour :</strong> {{ $program->updated_at->locale('fr')->isoFormat('LL') }}</p>
    <p><strong>Nombre de jours :</strong> {{ $days->count() }}</p>

    <br>
    <div class="program-summary">
        <h3>Conseils pour réussir</h3>
        <ul>
            <li>Échauffez-vous correctement avant chaque séance</li>
            <li>Restez hydraté tout au long de l'entraînement</li>
            <li>Concentrez-vous sur la bonne exécution des mouvements</li>
            <li>Respectez les temps de pause entre les exercices</li>
            <li>N'hésitez pas à ajuster les poids si nécessaire</li>
        </ul>
    </div>
</div>

@foreach ($days as $day => $exercises)
    <div class="day-card">
        <h2>Jour {{ $day }}</h2>
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Exercice</th>
                <th>Répétitions</th>
                <th>Pause (s)</th>
                <th>Poids (kg)</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($exercises as $index => $exercise)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <img src="{{ public_path($exercise->image) }}" alt="{{ $exercise->name }}"
                             class="exercise-image">
                        <strong class="exercise-name">{{ $exercise->name }}</strong>
                        <div class="exercise-details">{{ $exercise->description }}</div>
                    </td>
                    <td>{{ $exercise->pivot->rep }}</td>
                    <td>{{ $exercise->pivot->break }}</td>
                    <td>{{ $exercise->pivot->weight }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endforeach
</body>
</html>