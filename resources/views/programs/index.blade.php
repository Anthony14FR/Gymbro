@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-4xl font-bold">Programs</h1>
            <a href="{{ route('programs.edit') }}" class="btn btn-primary">Create Program</a>
        </div>

        @if ($programs->isEmpty())
            <div class="alert alert-warning shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m0-4h.01M12 8v4m0 4v4m8-8h.01M2 12h.01M4.22 19.78l.01-.01M20.49 20.49l-.01-.01M4.22 4.22l.01-.01M20.49 3.51l-.01.01M3 12a9 9 0 1 1 18 0 9 9 0 0 1-18 0z"></path>
                    </svg>
                    <span>No programs found. Please create one!</span>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($programs as $program)
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title">{{ $program->name }}</h2>
                            <p>{{ Str::limit($program->description, 100) }}</p>
                            <p class="text-sm text-gray-600">Created: {{ $program->created_at->format('d M Y') }}</p>
                            <p class="text-sm text-gray-600">Last Updated: {{ $program->updated_at->format('d M Y') }}</p>
                            <p class="text-sm text-gray-600">Number of Days: {{ $program->exercises->groupBy('pivot.day')->count() }}</p>
                            <div class="card-actions justify-end">
                                <a href="{{ route('programs.show', $program) }}" class="btn btn-outline">View</a>
                                <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('programs.destroy', $program) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error" onclick="return confirm('Are you sure you want to delete this program?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
