@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center md:flex-row md:space-y-0 space-y-10 flex-col mb-6 p-3 bg-base-300 rounded-xl shadow-lg outline outline-accent/20">
            <h1 class="text-4xl font-bold">Programmes</h1>
            <a href="{{ route('programs.edit') }}" class="btn btn-accent"><i class="fa-solid fa-circle-plus"></i> Créer un Programme</a>
        </div>

        <div class="tabs my-10 flex md:flex-row flex-col items-start md:space-y-0 space-y-5 md:space-x-10">
            <button class="tab tab-bordered tab-lg tab-active border-0 btn btn-accent md:w-auto w-full" id="my-programs-tab"><i class="fa-solid fa-dumbbell"></i> Mes programmes</button>
            <button class="tab tab-bordered tab-lg border-0 btn md:w-auto w-full" id="community-programs-tab"><i class="fa-solid fa-users"></i> Programmes de la communauté</button>
            <button class="tab tab-bordered tab-lg border-0 btn md:w-auto w-full" id="gymbro-programs-tab">Programmes Gymbro</button>
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
                                <h2 class="card-title text-2xl">{{ $program->name }}</h2>
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
        const myPrograms = document.getElementById('my-programs-tab');
        const communityPrograms = document.getElementById('community-programs-tab');
        const gymbroPrograms = document.getElementById('gymbro-programs-tab');

        const programsBtn = [myPrograms, communityPrograms, gymbroPrograms]

        programsBtn.forEach(btn => {
            btn.addEventListener('click', function() {
                showTab(btn.id.replace('-tab', ''));
                programsBtn.forEach(btn => {
                    btn.classList.remove('btn-accent');
                });
                btn.classList.add('btn-accent');
            });
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
