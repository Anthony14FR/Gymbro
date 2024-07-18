@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between md:flex-row md:space-y-0 space-y-10 flex-col mb-6 p-3 ml-8">
            <div class="breadcrumbs text-sm">
                <h1 class="text-4xl font-normal">Profil de {{ auth()->user()->username }} <i class="fa-solid fa-user fa-xs ml-2 text-accent"></i></h1>
                {!! Breadcrumbs::render() !!}
            </div>
        </div>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-base-200 border border-2 border-white/10 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-base-200 border border-2 border-white/10 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-base-200 border border-2 border-white/10 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-base-200 border border-2 border-white/10 shadow sm:rounded-lg">
                    <div class="max-w-xl space-y-5">
                    <span class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Gestion de l\'abonnement') }}
                    </span>

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="space-y-3">
                            @if (auth()->user()->hasRole('premium'))
                                @if ($subscription)
                                    @if ($subscription->isCancelled())
                                        <p class="text-yellow-600 dark:text-yellow-400">
                                            {{ __('Votre abonnement se terminera le') }} {{ $endDate->format('j F Y') }}
                                            .
                                        </p>
                                        <p>{{ __('Vous continuerez à bénéficier de l\'accès premium jusqu\'à cette date.') }}</p>
                                    @elseif($subscription->isActive())
                                        <p class="text-green-600 dark:text-green-400">
                                            {{ __('Vous êtes actuellement abonné au plan') }} <span
                                                    class="font-semibold">Premium</span>.
                                        </p>
                                        <p>{{ __('Votre prochain renouvellement est prévu le') }} {{ $endDate->format('j F Y') }}
                                            .</p>
                                        <p>{{ __('Votre abonnement est configuré pour se renouveler automatiquement.') }}</p>
                                        <form action="{{ route('subscriptions.unsubscribe') }}" method="POST"
                                              class="mt-4">
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-warning">{{ __('Annuler l\'abonnement') }}</button>
                                        </form>
                                    @else
                                        <p class="text-green-600 dark:text-green-400">
                                            {{ __('Vous êtes actuellement abonné au plan') }} <span
                                                    class="font-semibold">Premium</span>.
                                        </p>
                                        <p>{{ __('Votre prochain renouvellement est prévu le') }} {{ $endDate->format('j F Y') }}
                                            .</p>
                                        <p>{{ __('Votre abonnement est configuré pour se renouveler automatiquement.') }}</p>
                                        <form action="{{ route('subscriptions.unsubscribe') }}" method="POST"
                                              class="mt-4">
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-warning">{{ __('Annuler l\'abonnement') }}</button>
                                        </form>
                                    @endif
                                @else
                                    <p class="text-gray-600 dark:text-gray-400">{{ __('Le statut de votre abonnement n\'est pas clair. Veuillez contacter le support.') }} </p>
                                @endif
                            @else
                                @if(auth()->user()->hasRole('admin'))
                                    <p class="text-green-600 dark:text-green-400">{{ __('Vous êtes un administrateur et avez un accès complet à l\'application.') }}</p>
                                @else
                                    <p class="text-gray-600 dark:text-gray-400">{{ __('Vous n\'avez pas d\'abonnement actif.') }}</p>
                                    <a href="{{ route('subscriptions.index') }}"
                                       class="btn btn-primary mt-4">{{ __('S\'abonner maintenant') }}</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection