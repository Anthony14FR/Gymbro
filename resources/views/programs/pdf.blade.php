<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $program->name }} - Program Details</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: #f3f4f6;
            color: #1f2937;
            margin: 0;
            padding: 0;
        }
        .header, .footer {
            background: #1e3a8a;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        .content {
            padding: 1rem;
        }
        .program-title {
            background: #9333ea;
            color: white;
            padding: 1rem;
            border-radius: 0.5rem;
            text-align: center;
        }
        .section-title {
            color: #1e3a8a;
            font-weight: bold;
            margin-top: 1rem;
        }
        .table {
            width: 100%;
            margin-top: 1rem;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 0.5rem;
            text-align: center;
        }
        .table th {
            background: #1e3a8a;
            color: white;
        }
        .day-card {
            background: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 1rem;
            margin-bottom: 1rem;
            page-break-after: always;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>{{ $program->name }}</h1>
</div>

<div class="content">
    <div class="program-title">
        <p>{{ $program->description }}</p>
        <p>Created: {{ $program->created_at->format('d M Y') }}</p>
        <p>Last Updated: {{ $program->updated_at->format('d M Y') }}</p>
        <p>Number of Days: {{ $days->count() }}</p>
    </div>

    <div>
        @foreach ($days as $day => $exercises)
            <div class="day-card">
                <h2 class="section-title">Day {{ $day }}</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Exercise</th>
                        <th>Repetitions</th>
                        <th>Break (s)</th>
                        <th>Weight (kg)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($exercises as $index => $exercise)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $exercise->name }}</td>
                            <td>{{ $exercise->pivot->rep }}</td>
                            <td>{{ $exercise->pivot->break }}</td>
                            <td>{{ $exercise->pivot->weight }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</div>

<div class="footer">
    <p>&copy; {{ date('Y') }} Gymbro. All rights reserved.</p>
</div>
</body>
</html>
