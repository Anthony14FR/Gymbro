@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between md:flex-row md:space-y-0 space-y-10 flex-col mb-6 p-3 ml-8">
            <div class="breadcrumbs text-sm">
                <h1 class="text-4xl font-normal text-base-content">Profil de {{ auth()->user()->username }} <i class="fa-solid fa-user fa-xs ml-2 text-accent"></i></h1>
                {!! Breadcrumbs::render() !!}
            </div>
        </div>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-base-200 border border-2 border-base-300 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-base-200 border border-2 border-base-300 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-base-200 border border-2 border-base-300 shadow sm:rounded-lg">
                    <div class="max-w-xl space-y-5">
                    <span class="text-2xl font-medium text-base-content">
                        {{ __('Gestion de l\'abonnement') }}
                    </span>

                        @if (session('error'))
                            <div class="alert alert-error">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="space-y-3">
                            @if(auth()->user()->hasRole('admin'))
                                <p class="text-success">{{ __('Vous êtes un administrateur et avez un accès complet à l\'application.') }}</p>
                            @elseif (auth()->user()->hasRole('premium'))
                                @if ($subscription)
                                    @if ($subscription->isCancelled())
                                        <p class="text-warning">
                                            {{ __('Votre abonnement se terminera le') }} {{ $endDate->format('j F Y') }}
                                            .
                                        </p>
                                        <p class="text-base-content">{{ __('Vous continuerez à bénéficier de l\'accès premium jusqu\'à cette date.') }}</p>
                                    @elseif($subscription->isActive())
                                        <p class="text-success">
                                            {{ __('Vous êtes actuellement abonné au plan') }} <span
                                                    class="font-semibold">Premium</span>.
                                        </p>
                                        <p class="text-base-content">{{ __('Votre prochain renouvellement est prévu le') }} {{ $endDate->format('j F Y') }}
                                            .</p>
                                        <p class="text-base-content">{{ __('Votre abonnement est configuré pour se renouveler automatiquement.') }}</p>
                                        <form action="{{ route('subscriptions.unsubscribe') }}" method="POST"
                                              class="mt-4">
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-warning">{{ __('Annuler l\'abonnement') }}</button>
                                        </form>
                                    @else
                                        <p class="text-success">
                                            {{ __('Vous êtes actuellement abonné au plan') }} <span
                                                    class="font-semibold">Premium</span>.
                                        </p>
                                        <p class="text-base-content">{{ __('Votre prochain renouvellement est prévu le') }} {{ $endDate->format('j F Y') }}
                                            .</p>
                                        <p class="text-base-content">{{ __('Votre abonnement est configuré pour se renouveler automatiquement.') }}</p>
                                        <form action="{{ route('subscriptions.unsubscribe') }}" method="POST"
                                              class="mt-4">
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-warning">{{ __('Annuler l\'abonnement') }}</button>
                                        </form>
                                    @endif
                                @else
                                    <p class="text-base-content/70">{{ __('Le statut de votre abonnement n\'est pas clair. Veuillez contacter le support.') }} </p>
                                @endif
                            @else
                                <p class="text-base-content/70">{{ __('Vous n\'avez pas d\'abonnement actif.') }}</p>
                                <a href="{{ route('subscriptions.index') }}"
                                   class="btn btn-primary mt-4">{{ __('S\'abonner maintenant') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="p-4 sm:p-8 bg-base-200 border border-2 border-base-300 shadow sm:rounded-lg">
                    <div class="max-w-xl space-y-5">
                            <span class="text-2xl font-medium text-base-content">
                                {{ __('Progression') }}
                            </span>
                        <div class="space-y-3">
                            <p class="flex items-center text-base-content"><i class="fas fa-chart-line mr-8"></i> Niveau : {{ $level }}</p>
                            <p class="flex items-center text-base-content"><i class="fas fa-star mr-8"></i> Expérience : {{ $experience }} / 100</p>
                            <p class="flex items-center text-base-content"><i class="fas fa-arrow-up mr-8 w-4"></i> Prochain niveau dans : {{ $nextLevelExperience }} points</p>
                            <p class="flex items-center text-base-content"><i class="fas fa-trophy mr-8"></i> Rang actuel : {{ $rank }}</p>
                            <div class="w-full bg-base-300 rounded-full h-2.5">
                                <div class="bg-primary h-2.5 rounded-full" style="width: {{ $experience }}%"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection