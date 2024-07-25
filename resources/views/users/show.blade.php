@extends('layouts.app')

@section('content')
    <div id="my-programs" class="program-list mt-8 p-4">
        <div class="breadcrumbs text-sm p-4">
            <h1 class="text-4xl font-normal">{{ $user->username }} <i class="fa-solid fa-eye fa-xs"></i></h1>
            {!! Breadcrumbs::render() !!}
        </div>
        <div class="bg-base-300 h-full p-4 rounded-lg space-y-6 mt-6">
            <div class="flex justify-between">
                <span class="badge badge-ghost badge-lg shadow-md">Level {{ $user->level }}</span>
                @if ($isSubscribed)
                    <span class="badge badge-warning badge-lg shadow-md"><i class="fa-regular fa-gem mr-2"></i> Abonné</span>
                @else
                    <span class="badge badge-ghost badge-lg">Non Abonné</span>
                @endif
            </div>
            <div class="mt-6 flex flex-col space-y-3">
                <span class=""><i class="fa-solid fa-user mr-2"></i>Pseudo : <span class="font-bold badge badge-neutral badge-lg">{{ $user->username }}</span></span>
                <span class="mt-2"><i class="fa-solid fa-envelope mr-2"></i>Email : <span class="font-bold badge badge-neutral badge-lg">{{ $user->email }}</span></span>
                <span class="mt-2"><i class="fa-solid fa-hammer mr-2"></i>Rôle : <span class="font-bold badge badge-neutral badge-lg">{{ $user->role }}</span></span>
            </div>
        </div>
        @if ($programs->isEmpty())
            <div class="alert alert-warning shadow-lg mt-6">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m0-4h.01M12 8v4m0 4v4m8-8h.01M2 12h.01M4.22 19.78l.01-.01M20.49 20.49l-.01-.01M4.22 4.22l.01-.01M20.49 3.51l-.01.01M3 12a9 9 0 1 1 18 0 9 9 0 0 1-18 0z">
                        </path>
                    </svg>
                    <span>Aucun programme trouvé.</span>
                </div>
            </div>
        @else
            <div class="flex md:flex-row flex-col gap-5 mt-5 p-3">
                <button id="allBtn" class="btn btn-neutral">Tous les programmes</button>
                <button id="publicBtn" class="btn btn-ghost">Programmes Publics</button>
                <button id="privateBtn" class="btn btn-ghost">Programmes Privés</button>
            </div>

            <div class="">
                <div id="allPrograms" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
                    <span class="text-xl font-bold col-span-full">Tous les programmes</span>
                    @foreach ($programs as $program)
                        <div class="card relative bg-base-100 ring ring-accent/30 ring-1 rounded shadow-lg">
                            <div class="text-sm absolute badge badge-lg {{ $program->status ? 'badge-success' : 'bg-neutral' }} text-white shadow-lg right-3 top-3">
                                {{ $program->status ? 'Public' : 'Privé' }}
                            </div>

                            <div class="absolute text-xl top-0 left-0 bg-accent p-3 text-white rounded-br-xl shadow-md">
                                <i class="fa-regular fa-calendar mr-2"></i>{{ $program->exercises->groupBy('pivot.day')->count() }}J
                            </div>

                            <div class="card-body p-0">
                                <img src="{{ asset($program->image) }}" alt="{{ $program->name }}"
                                    class="w-auto h-32 object-cover">
                                <div class="p-3">
                                    <div class="">
                                        <div class="flex items-center space-x-3">
                                            <i class="fa-solid fa-caret-right"></i>
                                            <h2 class="card-title">{{ $program->name }}</h2>
                                        </div>

                                        <p class=""><i class="fa-solid fa-star mt-6"></i>
                                            {{ Str::limit($program->description, 100) }}</p>
                                        <div class="card-actions justify-start mt-5">
                                            <a href="{{ route('programs.show', $program) }}" class="btn btn-neutral btn-sm"><i
                                                    class="fa-regular fa-eye"></i> Voir</a>
                                        </div>
                                        <div class="mt-5 mb-2 space-y-2">
                                            <p class="text-sm badge badge-lg badge-ghost rounded-md"><i
                                                    class="fa-solid fa-calendar-days mr-2"></i> Créé :
                                                {{ $program->created_at->format('d M Y') }}
                                            </p>
                                            <p class="text-sm badge badge-lg badge-ghost rounded-md"><i
                                                    class="fa-solid fa-pen mr-2"></i> Mise à Jour :
                                                {{ $program->updated_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div id="publicPrograms" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-5 hidden">
                    <span class="text-xl font-bold col-span-full">Programmes Publics</span>
                    @foreach ($programs as $program)
                        @if ($program->status)
                            <div class="card relative bg-base-100 ring ring-accent/30 ring-1 rounded shadow-lg">
                                <div class="text-sm absolute badge badge-lg badge-success text-white shadow-lg right-3 top-3">
                                    Public
                                </div>

                                <div class="absolute text-xl top-0 left-0 bg-accent p-3 text-white rounded-br-xl shadow-md">
                                    <i class="fa-regular fa-calendar mr-2"></i>{{ $program->exercises->groupBy('pivot.day')->count() }}J
                                </div>

                                <div class="card-body p-0">
                                    <img src="{{ asset($program->image) }}" alt="{{ $program->name }}"
                                        class="w-auto h-32 object-cover">
                                    <div class="p-3">
                                        <div class="">
                                            <div class="flex items-center space-x-3">
                                                <i class="fa-solid fa-caret-right"></i>
                                                <h2 class="card-title">{{ $program->name }}</h2>
                                            </div>

                                            <p class=""><i class="fa-solid fa-star mt-6"></i>
                                                {{ Str::limit($program->description, 100) }}</p>
                                            <div class="card-actions justify-start mt-5">
                                                <a href="{{ route('programs.show', $program) }}" class="btn btn-neutral btn-sm"><i
                                                        class="fa-regular fa-eye"></i> Voir</a>
                                            </div>
                                            <div class="mt-5 mb-2 space-y-2">
                                                <p class="text-sm badge badge-lg badge-ghost rounded-md"><i
                                                        class="fa-solid fa-calendar-days mr-2"></i> Créé :
                                                    {{ $program->created_at->format('d M Y') }}
                                                </p>
                                                <p class="text-sm badge badge-lg badge-ghost rounded-md"><i
                                                        class="fa-solid fa-pen mr-2"></i> Mise à Jour :
                                                    {{ $program->updated_at->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div id="privatePrograms" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-5 hidden">
                    <span class="text-xl font-bold col-span-full">Programmes Privés</span>
                    @foreach ($programs as $program)
                        @if (!$program->status)
                            <div class="card relative bg-base-100 ring ring-accent/30 ring-1 rounded shadow-lg">
                                <div class="text-sm absolute badge badge-lg bg-neutral text-white shadow-lg right-3 top-3">
                                    Privé
                                </div>

                                <div class="absolute text-xl top-0 left-0 bg-accent p-3 text-white rounded-br-xl shadow-md">
                                    <i class="fa-regular fa-calendar mr-2"></i>{{ $program->exercises->groupBy('pivot.day')->count() }}J
                                </div>

                                <div class="card-body p-0">
                                    <img src="{{ asset($program->image) }}" alt="{{ $program->name }}"
                                        class="w-auto h-32 object-cover">
                                    <div class="p-3">
                                        <div class="">
                                            <div class="flex items-center space-x-3">
                                                <i class="fa-solid fa-caret-right"></i>
                                                <h2 class="card-title">{{ $program->name }}</h2>
                                            </div>

                                            <p class=""><i class="fa-solid fa-star mt-6"></i>
                                                {{ Str::limit($program->description, 100) }}</p>
                                            <div class="card-actions justify-start mt-5">
                                                <a href="{{ route('programs.show', $program) }}" class="btn btn-neutral btn-sm"><i
                                                        class="fa-regular fa-eye"></i> Voir</a>
                                            </div>
                                            <div class="mt-5 mb-2 space-y-2">
                                                <p class="text-sm badge badge-lg badge-ghost rounded-md"><i
                                                        class="fa-solid fa-calendar-days mr-2"></i> Créé :
                                                    {{ $program->created_at->format('d M Y') }}
                                                </p>
                                                <p class="text-sm badge badge-lg badge-ghost rounded-md"><i
                                                        class="fa-solid fa-pen mr-2"></i> Mise à Jour :
                                                    {{ $program->updated_at->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <script>
        const allBtn = document.getElementById('allBtn');
        const publicBtn = document.getElementById('publicBtn');
        const privateBtn = document.getElementById('privateBtn');
        const allPrograms = document.getElementById('allPrograms');
        const publicPrograms = document.getElementById('publicPrograms');
        const privatePrograms = document.getElementById('privatePrograms');

        function setActiveButton(activeBtn) {
            [allBtn, publicBtn, privateBtn].forEach(btn => {
                btn.classList.remove('btn-neutral');
                btn.classList.add('btn-ghost');
            });
            activeBtn.classList.remove('btn-ghost');
            activeBtn.classList.add('btn-neutral');
        }

        allBtn.addEventListener('click', function() {
            allPrograms.classList.remove('hidden');
            publicPrograms.classList.add('hidden');
            privatePrograms.classList.add('hidden');
            setActiveButton(allBtn);
        });

        publicBtn.addEventListener('click', function() {
            allPrograms.classList.add('hidden');
            publicPrograms.classList.remove('hidden');
            privatePrograms.classList.add('hidden');
            setActiveButton(publicBtn);
        });

        privateBtn.addEventListener('click', function() {
            allPrograms.classList.add('hidden');
            publicPrograms.classList.add('hidden');
            privatePrograms.classList.remove('hidden');
            setActiveButton(privateBtn);
        }); 
        setActiveButton(allBtn);
    </script>
@endsection