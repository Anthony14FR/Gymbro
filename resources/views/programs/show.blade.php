@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <div class="flex justify-between items-center md:flex-row md:space-y-0 space-y-10 flex-col mb-6 p-3">
                <div class="breadcrumbs text-sm">
                    <h1 class="text-5xl font-extrabold mb-4 md:mb-0"><i class="fa-solid fa-dumbbell mr-2 text-accent"></i> {{ $program->name }}</h1>
                    {!! Breadcrumbs::render() !!}
                </div>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-sm">Edit <i
                        class="fa-solid fa-pen-to-square"></i></a>
                @role("premium")
                <a href="{{ route('programs.exportPdf', $program->id) }}" class="btn btn-sm">Export PDF <i
                        class="fa-solid fa-download"></i></a>
                @endrole
                @role("user")
                <a href="{{ route('subscriptions.index') }}" class="btn btn-sm bg-black/20 hover:bg-black/20 text-white/10">Export PDF <i class="fa-solid fa-lock text-yellow-500"></i></a>
                @endrole
                <form action="{{ route('programs.destroy', $program) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm"
                        onclick="return confirm('Are you sure you want to delete this program?')">Delete <i
                            class="fa-solid fa-trash"></i></button>
                </form>
            </div>
        </div>

        <div class="card card-side bg-base-300 shadow-xl mb-12">
            <figure>
                <img src="{{ asset($program->image) }}" alt="Movie" class="h-64 object-cover" />
            </figure>
            <div class="card-body">
                <p class="text-lg"><i class="fa-solid fa-caret-right"></i> {{ $program->description }}</p>
                <p class="text-sm "><i class="fa-regular fa-calendar-check"></i> Created:
                    {{ $program->created_at->format('d M Y') }}</p>
                <p class="text-sm"><i class="fa-regular fa-calendar-plus"></i> Last Updated:
                    {{ $program->updated_at->format('d M Y') }}</p>
                <p class="text-sm"><i class="fa-solid fa-star"></i> Number of Days:
                    {{ $program->exercises->groupBy('pivot.day')->count() }}</p>
            </div>
        </div>

        <div class="space-y-8">
            @foreach ($program->exercises->groupBy('pivot.day') as $day => $exercises)
                <div class="p-6 rounded-lg text-white">
                    <h2 class="text-3xl font-bold mb-4"><i class="fa-regular fa-calendar mr-2"></i> Day {{ $day }}</h2>
                    <div class="overflow-x-auto shadow-md p-5 bg-base-300">
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
