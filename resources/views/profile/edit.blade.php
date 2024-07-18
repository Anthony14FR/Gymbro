@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profil') }}
        </span>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
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
                                        {{ __('Votre abonnement se terminera le') }} {{ $endDate->format('j F Y') }}.
                                    </p>
                                    <p>{{ __('Vous continuerez à bénéficier de l\'accès premium jusqu\'à cette date.') }}</p>
                                @elseif($subscription->isActive())
                                    <p class="text-green-600 dark:text-green-400">
                                        {{ __('Vous êtes actuellement abonné au plan') }} <span class="font-semibold">Premium</span>.
                                    </p>
                                    <p>{{ __('Votre prochain renouvellement est prévu le') }} {{ $endDate->format('j F Y') }}
                                        .</p>
                                    <p>{{ __('Votre abonnement est configuré pour se renouveler automatiquement.') }}</p>
                                    <form action="{{ route('subscriptions.unsubscribe') }}" method="POST" class="mt-4">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-warning">{{ __('Annuler l\'abonnement') }}</button>
                                    </form>
                                @else
                                    <p class="text-green-600 dark:text-green-400">
                                        {{ __('Vous êtes actuellement abonné au plan') }} <span class="font-semibold">Premium</span>.
                                    </p>
                                    <p>{{ __('Votre prochain renouvellement est prévu le') }} {{ $endDate->format('j F Y') }}
                                        .</p>
                                    <p>{{ __('Votre abonnement est configuré pour se renouveler automatiquement.') }}</p>
                                    <form action="{{ route('subscriptions.unsubscribe') }}" method="POST" class="mt-4">
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
@endsection