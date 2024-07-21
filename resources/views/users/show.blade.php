@extends('layouts.app')

@section('content')
    <div id="my-programs" class="program-list">
        @if ($programs->isEmpty())
            <div class="alert alert-warning shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 16h-1v-4h-1m0-4h.01M12 8v4m0 4v4m8-8h.01M2 12h.01M4.22 19.78l.01-.01M20.49 20.49l-.01-.01M4.22 4.22l.01-.01M20.49 3.51l-.01.01M3 12a9 9 0 1 1 18 0 9 9 0 0 1-18 0z">
                        </path>
                    </svg>
                    <span>{{ __('users.no_program_found') }}</span>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($programs as $program)
                    <div class="card relative bg-base-100 ring ring-accent/30 ring-1 rounded shadow-lg">
                        @if ($program->status)
                            <div class="text-sm absolute badge badge-lg badge-success text-white shadow-lg right-3 top-3">
                                {{ __('users.public') }}
                            </div>
                        @else
                            <div class="text-sm absolute badge badge-lg bg-neutral text-white shadow-lg right-3 top-3">
                                {{ __('users.private') }}
                            </div>
                        @endif

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
                                                    class="fa-regular fa-eye"></i> {{ __('users.view') }}</a>
                                    </div>
                                    <div class="mt-5 mb-2 space-y-2">
                                        <p class="text-sm badge badge-lg badge-ghost rounded-md"><i
                                                    class="fa-solid fa-calendar-days mr-2"></i> {{ __('users.created_at') }} :
                                            {{ $program->created_at->format('d M Y') }}
                                        </p>
                                        <p class="text-sm badge badge-lg badge-ghost rounded-md"><i
                                                    class="fa-solid fa-pen mr-2"></i> {{ __('users.updated_at') }} :
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
@endsection
