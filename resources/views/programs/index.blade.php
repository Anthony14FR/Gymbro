@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between md:flex-row md:space-y-0 space-y-10 flex-col mb-6 p-3">
            <div class="breadcrumbs text-sm">
                <h1 class="text-4xl font-normal">{{ __('programs.title') }} <i class="fa-solid fa-list fa-xs ml-2 text-accent"></i></h1>
                {!! Breadcrumbs::render() !!}
            </div>
            <a href="{{ route('programs.edit') }}" class="btn btn-accent"><i class="fa-solid fa-circle-plus"></i> {{ __('programs.create_program') }}</a>
        </div>

        <div class="tabs mt-8 mb-12 flex md:flex-row flex-col items-start md:space-y-0 space-y-5 md:space-x-10">
            <button class="tab tab-bordered tab-lg tab-active border-0 btn btn-accent md:w-auto w-full"
                    id="my-programs-tab"><i class="fa-solid fa-dumbbell"></i> {{ __('programs.my_programs') }}</button>
            @if (Auth::check() && Auth::user()->hasRole('premium'))
                <button class="tab tab-bordered tab-lg border-0 btn md:w-auto w-full" id="community-programs-tab"><i
                            class="fa-solid fa-users"></i> {{ __('programs.community_programs') }}</button>
                <button class="tab tab-bordered tab-lg border-0 btn md:w-auto w-full" id="gymbro-programs-tab">
                    <i class="fa-solid fa-medal"></i><span class="inline-block">{{ __('programs.gymbro_programs') }}</span>
                </button>
            @elseif (Auth::check() && Auth::user()->hasRole('user'))
                <a href="{{ route('subscriptions.index') }}"
                   class="tab tab-bordered tab-lg border-0 btn md:w-auto w-full hover:bg-black/20 bg-black/20 text-white/10"><i
                            class="fa-solid fa-users"></i> {{ __('programs.community_programs') }} <i
                            class="fa-solid fa-lock text-yellow-500 ml-2"></i></a>
                <a href="{{ route('subscriptions.index') }}"
                   class="tab tab-bordered tab-lg border-0 btn md:w-auto w-full hover:bg-black/20 bg-black/20 text-white/10">
                    <i class="fa-solid fa-medal"></i><span class="inline-block">{{ __('programs.gymbro_programs') }} <i
                                class="fa-solid fa-lock text-yellow-500 ml-2"></i></span>
                </a>
            @endif

        </div>

        <div id="my-programs" class="program-list">
            @if ($myPrograms->isEmpty())
                <div class="alert alert-warning shadow-lg">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 16h-1v-4h-1m0-4h.01M12 8v4m0 4v4m8-8h.01M2 12h.01M4.22 19.78l.01-.01M20.49 20.49l-.01-.01M4.22 4.22l.01-.01M20.49 3.51l-.01.01M3 12a9 9 0 1 1 18 0 9 9 0 0 1-18 0z">
                            </path>
                        </svg>
                        <span>{{ __('programs.no_program_found_create') }}</span>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($myPrograms as $program)
                        <div class="card relative bg-base-100 ring ring-accent/30 ring-1 rounded shadow-lg">
                            @if ($program->status)
                                <div
                                        class="text-sm absolute badge badge-lg badge-success text-white shadow-lg right-3 top-3">
                                    {{ __('programs.public') }}
                                </div>
                            @else
                                <div class="text-sm absolute badge badge-lg bg-neutral text-white shadow-lg right-3 top-3">
                                    {{ __('programs.private') }}
                                </div>
                            @endif

                            <div class="absolute text-xl top-0 left-0 bg-accent p-3 text-white rounded-br-xl shadow-md">
                                <i
                                        class="fa-regular fa-calendar mr-2"></i>{{ $program->exercises->groupBy('pivot.day')->count() }}{{ __('programs.days') }}
                            </div>

                            <div class="card-body p-0">
                                <img src="{{ asset($program->image) }}" alt="{{ $program->name }}"
                                     class="w-auto h-32 object-cover">
                                <div class="p-3">
                                    <div class="">
                                        <div class="flex items-center space-x-3">
                                            <i class="fa-solid fa-caret-right"></i>
                                            <span class="text-xl font-normal">{{ $program->name }}</span>
                                        </div>

                                        <p class=""><i class="fa-solid fa-star mt-6"></i>
                                            {{ Str::limit($program->description, 100) }}</p>
                                        <div class="card-actions justify-start mt-5">
                                            <a href="{{ route('programs.show', $program) }}"
                                               class="btn btn-neutral btn-sm"><i class="fa-regular fa-eye"></i> {{ __('programs.view') }}</a>
                                            <a href="{{ route('programs.edit', $program->id) }}"
                                               class="btn btn-neutral btn-sm"><i class="fa-solid fa-pen-to-square"></i>
                                                {{ __('programs.edit') }}</a>
                                            <form action="{{ route('programs.destroy', $program) }}" method="POST"
                                                  class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-neutral btn-sm"
                                                        onclick="return confirm('{{ __('programs.confirm_delete') }}')"><i
                                                            class="fa-solid fa-trash"></i> {{ __('programs.delete') }}</button>
                                            </form>
                                        </div>
                                        <div class="mt-5 mb-2 space-y-2">
                                            <p class="text-sm badge badge-lg badge-ghost rounded-md"><i
                                                        class="fa-solid fa-calendar-days mr-2"></i> {{ __('programs.created_at') }} :
                                                {{ $program->created_at->format('d M Y') }}
                                            </p>
                                            <p class="text-sm badge badge-lg badge-ghost rounded-md"><i
                                                        class="fa-solid fa-pen mr-2"></i> {{ __('programs.updated_at') }} :
                                                {{ $program->updated_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
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
                        <span>{{ __('programs.no_program_found') }}</span>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($communityPrograms as $program)
                        <div class="card relative bg-base-100 ring ring-accent/30 ring-1 rounded shadow-lg">
                            @if ($program->status)
                                <div
                                        class="text-sm absolute badge badge-lg badge-success text-white shadow-lg right-3 top-3">
                                    {{ __('programs.public') }}
                                </div>
                            @else
                                <div class="text-sm absolute badge badge-lg bg-neutral text-white shadow-lg right-3 top-3">
                                    {{ __('programs.private') }}
                                </div>
                            @endif

                            <div class="absolute text-xl top-0 left-0 bg-accent p-3 text-white rounded-br-xl shadow-md">
                                <i
                                        class="fa-regular fa-calendar mr-2"></i>{{ $program->exercises->groupBy('pivot.day')->count() }}{{ __('programs.days') }}
                            </div>

                            <div class="card-body p-0">
                                <img src="{{ asset($program->image) }}" alt="{{ $program->name }}"
                                     class="w-auto h-32 object-cover">
                                <div class="p-3">
                                    <div class="">
                                        <div class="flex items-center space-x-3">
                                            <i class="fa-solid fa-caret-right"></i>
                                            <span class="text-xl font-normal">{{ $program->name }}</span>
                                        </div>

                                        <p class=""><i
                                                    class="fa-solid fa-star mt-6"></i>{{ Str::limit($program->description, 100) }}
                                        </p>
                                        <div class="card-actions justify-start mt-5">
                                            <a href="{{ route('programs.show', $program) }}"
                                               class="btn btn-neutral btn-sm"><i class="fa-regular fa-eye"></i> {{ __('programs.view') }}</a>
                                        </div>
                                        <div class="mt-5 mb-2 space-y-2">
                                            <p class="text-sm badge badge-lg badge-ghost rounded-md"><i
                                                        class="fa-solid fa-calendar-days mr-2"></i> {{ __('programs.created_at') }} :
                                                {{ $program->created_at->format('d M Y') }}</p>
                                            <p class="text-sm badge badge-lg badge-ghost rounded-md"><i
                                                        class="fa-solid fa-pen mr-2"></i> {{ __('programs.updated_at') }} :
                                                {{ $program->updated_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                             fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 16h-1v-4h-1m0-4h.01M12 8v4m0 4v4m8-8h.01M2 12h.01M4.22 19.78l.01-.01M20.49 20.49l-.01-.01M4.22 4.22l.01-.01M20.49 3.51l-.01.01M3 12a9 9 0 1 1 18 0 9 9 0 0 1-18 0z">
                            </path>
                        </svg>
                        <span>{{ __('programs.no_program_found') }}</span>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($gymbroPrograms as $program)
                        <div class="card relative bg-base-100 ring ring-accent/30 ring-1 rounded shadow-lg">
                            @if ($program->status)
                                <div
                                        class="text-sm absolute badge badge-lg badge-success text-white shadow-lg right-3 top-3">
                                    {{ __('programs.public') }}
                                </div>
                            @else
                                <div class="text-sm absolute badge badge-lg bg-neutral text-white shadow-lg right-3 top-3">
                                    {{ __('programs.private') }}
                                </div>
                            @endif

                            <div class="absolute text-xl top-0 left-0 bg-accent p-3 text-white rounded-br-xl shadow-md">
                                <i
                                        class="fa-regular fa-calendar mr-2"></i>{{ $program->exercises->groupBy('pivot.day')->count() }}{{ __('programs.days') }}
                            </div>

                            <div class="card-body p-0">
                                <img src="{{ asset($program->image) }}" alt="{{ $program->name }}"
                                     class="w-auto h-32 object-cover">
                                <div class="p-3">
                                    <div class="">
                                        <div class="flex items-center space-x-3">
                                            <i class="fa-solid fa-caret-right"></i>
                                            <span class="text-xl font-normal">{{ $program->name }}</span>
                                        </div>

                                        <p class=""><i
                                                    class="fa-solid fa-star mt-6"></i>{{ Str::limit($program->description, 100) }}
                                        </p>
                                        <div class="card-actions justify-start mt-5">
                                            <a href="{{ route('programs.show', $program) }}"
                                               class="btn btn-neutral btn-sm"><i class="fa-regular fa-eye"></i> {{ __('programs.view') }}</a>
                                        </div>
                                        <div class="mt-5 mb-2 space-y-2">
                                            <p class="text-sm badge badge-lg badge-ghost rounded-md"><i
                                                        class="fa-solid fa-calendar-days mr-2"></i> {{ __('programs.created_at') }} :
                                                {{ $program->created_at->format('d M Y') }}</p>
                                            <p class="text-sm badge badge-lg badge-ghost rounded-md"><i
                                                        class="fa-solid fa-pen mr-2"></i> {{ __('programs.updated_at') }} :
                                                {{ $program->updated_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
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
