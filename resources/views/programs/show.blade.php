@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div class="w-full md:w-auto mb-6 md:mb-0">
                <div class="breadcrumbs text-sm mb-4">
                    {!! Breadcrumbs::render() !!}
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold"><i
                            class="fa-solid fa-dumbbell mr-2 text-accent"></i> {{ $program->name }}</h1>
            </div>
            <div class="flex flex-wrap gap-2">
                @if (Auth::check() && Auth::user()->hasRole('premium'))
                    <a href="{{ route('programs.exportPdf', $program->id) }}"
                       class="btn btn-sm">{{ __('Exporter en PDF') }} <i class="fa-solid fa-download ml-2"></i></a>
                    <a href="{{ route('programs.exportCsv', $program->id) }}"
                       class="btn btn-sm">{{ __('Exporter en CSV') }} <i class="fa-solid fa-file-csv ml-2"></i></a>
                @else
                    <a href="{{ route('subscriptions.index') }}"
                       class="btn btn-sm bg-black/20 hover:bg-black/20 text-white/10">{{ __('Exporter en PDF') }} <i
                                class="fa-solid fa-lock text-yellow-500 ml-2"></i></a>
                    <a href="{{ route('subscriptions.index') }}"
                       class="btn btn-sm bg-black/20 hover:bg-black/20 text-white/10">{{ __('Exporter en CSV') }} <i
                                class="fa-solid fa-lock text-yellow-500 ml-2"></i></a>
                @endif
                @if(Auth::check() && Auth::user()->id === $program->user_id)
                    <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-sm">{{ __('Modifier') }} <i
                                class="fa-solid fa-pen-to-square ml-2"></i></a>
                    <form action="{{ route('programs.destroy', $program) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm"
                                onclick="return confirm('{{ __('Êtes-vous sûr de vouloir supprimer ce programme ?') }}')">{{ __('Supprimer') }}
                            <i class="fa-solid fa-trash ml-2"></i></button>
                    </form>
                @endif
            </div>
        </div>

        <div class="card lg:card-side bg-base-300 shadow-xl mb-12">
            <figure class="lg:w-1/3">
                <img src="{{ asset($program->image) }}" alt="{{ __('Image du programme') }}"
                     class="w-full h-64 lg:h-full object-cover"/>
            </figure>
            <div class="card-body lg:w-2/3">
                <p class="text-lg"><i class="fa-solid fa-caret-right mr-2"></i> {{ $program->description }}</p>
                <p class="text-sm"><i class="fa-regular fa-calendar-check mr-2"></i> {{ __('Créé le') }}
                    : {{ $program->created_at->format('d M Y') }}</p>
                <p class="text-sm"><i class="fa-regular fa-calendar-plus mr-2"></i> {{ __('Dernière mise à jour') }}
                    : {{ $program->updated_at->format('d M Y') }}</p>
                <p class="text-sm"><i class="fa-solid fa-star mr-2"></i> {{ __('Nombre de jours') }}
                    : {{ $program->exercises->groupBy('pivot.day')->count() }}</p>
            </div>
        </div>

        <div class="space-y-8">
            @foreach ($program->exercises->groupBy('pivot.day') as $day => $exercises)
                <div class="p-4 md:p-6 rounded-lg text-white">
                    <h2 class="text-2xl md:text-3xl font-bold mb-4"><i
                                class="fa-regular fa-calendar mr-2"></i> {{ __('Jour') }} {{ $day }}</h2>
                    <div class="overflow-x-auto shadow-md p-3 md:p-5 bg-base-300">
                        <table class="table w-full text-center">
                            <thead>
                            <tr>
                                <th class="px-1 md:px-2"><i class="fa-solid fa-list-ol mr-1"></i></th>
                                <th class="px-1 md:px-2">{{ __('Illustration') }} <i class="fa-solid fa-image ml-1"></i>
                                </th>
                                <th class="px-1 md:px-2">{{ __('Exercice') }} <i class="fa-solid fa-dumbbell ml-1"></i>
                                </th>
                                <th class="px-1 md:px-2">{{ __('Répétitions') }} <i class="fa-solid fa-repeat ml-1"></i>
                                </th>
                                <th class="px-1 md:px-2">{{ __('Pause') }} <i class="fa-solid fa-clock ml-1"></i></th>
                                <th class="px-1 md:px-2">{{ __('Poids') }} <i class="fa-solid fa-weight ml-1"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($exercises as $index => $exercise)
                                <tr>
                                    <td class="px-1 md:px-2">{{ $index + 1 }}</td>
                                    <td class="px-1 md:px-2 flex justify-center items-center">
                                        <img src="{{ asset($exercise->image) }}" alt="{{ $exercise->name }}"
                                             class="w-20 h-16 md:w-32 md:h-24 object-fill">
                                    </td>
                                    <td class="px-1 md:px-2">{{ $exercise->name }}</td>
                                    <td class="px-1 md:px-2">{{ $exercise->pivot->rep }}</td>
                                    <td class="px-1 md:px-2">{{ $exercise->pivot->break }} {{ __('s') }}</i></td>
                                    <td class="px-1 md:px-2">{{ $exercise->pivot->weight }} {{ __('kg') }}</i></td>
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
