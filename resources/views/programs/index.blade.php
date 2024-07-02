@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-4xl font-bold">Programmes</h1>
            <a href="{{ route('programs.edit') }}" class="btn btn-primary">Créer un Programme</a>
        </div>

        <div class="tabs mb-6">
            <a class="tab tab-bordered tab-lg tab-active" id="my-programs-tab">Mes programmes</a>
            <a class="tab tab-bordered tab-lg" id="community-programs-tab">Programmes de la communauté</a>
            <a class="tab tab-bordered tab-lg" id="gymbro-programs-tab">Programmes Gymbro</a>
        </div>

        <div id="my-programs" class="program-list">
            @if ($myPrograms->isEmpty())
                <div class="alert alert-warning shadow-lg">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 16h-1v-4h-1m0-4h.01M12 8v4m0 4v4m8-8h.01M2 12h.01M4.22 19.78l.01-.01M20.49 20.49l-.01-.01M4.22 4.22l.01-.01M20.49 3.51l-.01.01M3 12a9 9 0 1 1 18 0 9 9 0 0 1-18 0z"></path>
                        </svg>
                        <span>Aucun programme trouvé. Veuillez en créer un !</span>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($myPrograms as $program)
                        <div class="card bg-base-100 shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title">{{ $program->name }}</h2>
                                <p>{{ Str::limit($program->description, 100) }}</p>
                                <p class="text-sm text-gray-600">Créé le : {{ $program->created_at->format('d M Y') }}</p>
                                <p class="text-sm text-gray-600">Dernière Mise à Jour : {{ $program->updated_at->format('d M Y') }}</p>
                                <p class="text-sm text-gray-600">Nombre de Jours : {{ $program->exercises->groupBy('pivot.day')->count() }}</p>
                                <p class="text-sm text-gray-600">Statut : {{ $program->status ? 'Public' : 'Privé' }}</p>
                                <div class="card-actions justify-end">
                                    <a href="{{ route('programs.show', $program) }}" class="btn btn-outline">Voir</a>
                                    <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-primary">Modifier</a>
                                    <form action="{{ route('programs.destroy', $program) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-error" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce programme ?')">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div id="community-programs" class="program-list hidden">
            @if ($communityPrograms->isEmpty())
                <div class="alert alert-warning shadow-lg">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 16h-1v-4h-1m0-4h.01M12 8v4m0 4v4m8-8h.01M2 12h.01M4.22 19.78l.01-.01M20.49 20.49l-.01-.01M4.22 4.22l.01-.01M20.49 3.51l-.01.01M3 12a9 9 0 1 1 18 0 9 9 0 0 1-18 0z"></path>
                        </svg>
                        <span>Aucun programme trouvé.</span>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($communityPrograms as $program)
                        <div class="card bg-base-100 shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title">{{ $program->name }}</h2>
                                <p>{{ Str::limit($program->description, 100) }}</p>
                                <p class="text-sm text-gray-600">Créé le : {{ $program->created_at->format('d M Y') }}</p>
                                <p class="text-sm text-gray-600">Dernière Mise à Jour : {{ $program->updated_at->format('d M Y') }}</p>
                                <p class="text-sm text-gray-600">Nombre de Jours : {{ $program->exercises->groupBy('pivot.day')->count() }}</p>
                                <p class="text-sm text-gray-600">Statut : {{ $program->status ? 'Public' : 'Privé' }}</p>
                                <div class="card-actions justify-end">
                                    <a href="{{ route('programs.show', $program) }}" class="btn btn-outline">Voir</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div id="gymbro-programs" class="program-list hidden">
            @if ($gymbroPrograms->isEmpty())
                <div class="alert alert-warning shadow-lg">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 16h-1v-4h-1m0-4h.01M12 8v4m0 4v4m8-8h.01M2 12h.01M4.22 19.78l.01-.01M20.49 20.49l-.01-.01M4.22 4.22l.01-.01M20.49 3.51l-.01.01M3 12a9 9 0 1 1 18 0 9 9 0 0 1-18 0z"></path>
                        </svg>
                        <span>Aucun programme trouvé.</span>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($gymbroPrograms as $program)
                        <div class="card bg-base-100 shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title">{{ $program->name }}</h2>
                                <p>{{ Str::limit($program->description, 100) }}</p>
                                <p class="text-sm text-gray-600">Créé le : {{ $program->created_at->format('d M Y') }}</p>
                                <p class="text-sm text-gray-600">Dernière Mise à Jour : {{ $program->updated_at->format('d M Y') }}</p>
                                <p class="text-sm text-gray-600">Nombre de Jours : {{ $program->exercises->groupBy('pivot.day')->count() }}</p>
                                <p class="text-sm text-gray-600">Statut : {{ $program->status ? 'Public' : 'Privé' }}</p>
                                <div class="card-actions justify-end">
                                    <a href="{{ route('programs.show', $program) }}" class="btn btn-outline">Voir</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script>
        document.getElementById('my-programs-tab').addEventListener('click', function() {
            showTab('my-programs');
        });

        document.getElementById('community-programs-tab').addEventListener('click', function() {
            showTab('community-programs');
        });

        document.getElementById('gymbro-programs-tab').addEventListener('click', function() {
            showTab('gymbro-programs');
        });

        function showTab(tabId) {
            document.querySelectorAll('.program-list').forEach(function(element) {
                element.classList.add('hidden');
            });

            document.getElementById(tabId).classList.remove('hidden');
            document.querySelectorAll('.tab').forEach(function(tab) {
                tab.classList.remove('tab-active');
            });
            document.getElementById(tabId + '-tab').classList.add('tab-active');
        }

        // Initial display
        showTab('my-programs');
    </script>
@endsection
