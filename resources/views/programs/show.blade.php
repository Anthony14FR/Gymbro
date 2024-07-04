@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <h1 class="text-5xl font-extrabold text-blue-600 mb-4 md:mb-0">{{ $program->name }}</h1>
            <div class="flex space-x-4">
                <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('programs.exportPdf', $program->id) }}" class="btn btn-secondary">Export PDF</a>
                <a href="{{ route('programs.exportCsv', $program->id) }}" class="btn btn-secondary">Export CSV</a>
                <form action="{{ route('programs.destroy', $program) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error" onclick="return confirm('Are you sure you want to delete this program?')">Delete</button>
                </form>
            </div>
        </div>

        <div class="mb-8 bg-blue-100 p-6 rounded-lg shadow-md">
            <p class="text-lg text-gray-700">{{ $program->description }}</p>
            <p class="text-sm text-gray-500 mt-2">Created: {{ $program->created_at->format('d M Y') }}</p>
            <p class="text-sm text-gray-500">Last Updated: {{ $program->updated_at->format('d M Y') }}</p>
            <p class="text-sm text-gray-500">Number of Days: {{ $program->exercises->groupBy('pivot.day')->count() }}</p>
        </div>

        <div class="space-y-8">
            @foreach ($program->exercises->groupBy('pivot.day') as $day => $exercises)
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6 rounded-lg shadow-md text-white">
                    <h2 class="text-3xl font-bold mb-4">Day {{ $day }}</h2>
                    <div class="overflow-x-auto">
                        <table class="table w-full">
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
                </div>
            @endforeach
        </div>
    </div>
@endsection
