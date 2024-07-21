@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between md:flex-row md:space-y-0 space-y-10 flex-col mb-6 p-3 ml-8">
            <div class="breadcrumbs text-sm">
                <h1 class="text-4xl font-normal">{{ __('profile.title', ['username' => auth()->user()->username]) }} <i class="fa-solid fa-user fa-xs ml-2 text-accent"></i></h1>
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
                            {{ __('profile.subscription_management') }}
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
                            @if(auth()->user()->hasRole('admin'))
                                <p class="text-green-600 dark:text-green-400">{{ __('profile.admin_access') }}</p>
                            @elseif (auth()->user()->hasRole('premium'))
                                @if ($subscription)
                                    @if ($subscription->isCancelled())
                                        <p class="text-yellow-600 dark:text-yellow-400">
                                            {{ __('profile.subscription_end', ['date' => $endDate->format('j F Y')]) }}
                                        </p>
                                        <p>{{ __('profile.premium_access_until') }}</p>
                                    @elseif($subscription->isActive())
                                        <p class="text-green-600 dark:text-green-400">
                                            {{ __('profile.currently_subscribed') }}
                                        </p>
                                        <p>{{ __('profile.next_renewal', ['date' => $endDate->format('j F Y')]) }}</p>
                                        <p>{{ __('profile.auto_renewal') }}</p>
                                        <form action="{{ route('subscriptions.unsubscribe') }}" method="POST"
                                              class="mt-4">
                                            @csrf
                                            <button type="submit" class="btn btn-warning">{{ __('profile.cancel_subscription') }}</button>
                                        </form>
                                    @else
                                        <p class="text-green-600 dark:text-green-400">
                                            {{ __('profile.currently_subscribed') }}
                                        </p>
                                        <p>{{ __('profile.next_renewal', ['date' => $endDate->format('j F Y')]) }}</p>
                                        <p>{{ __('profile.auto_renewal') }}</p>
                                        <form action="{{ route('subscriptions.unsubscribe') }}" method="POST"
                                              class="mt-4">
                                            @csrf
                                            <button type="submit" class="btn btn-warning">{{ __('profile.cancel_subscription') }}</button>
                                        </form>
                                    @endif
                                @else
                                    <p class="text-gray-600 dark:text-gray-400">{{ __('profile.subscription_status_unclear') }}</p>
                                @endif
                            @else
                                <p class="text-gray-600 dark:text-gray-400">{{ __('profile.no_active_subscription') }}</p>
                                <a href="{{ route('subscriptions.index') }}" class="btn btn-primary mt-4">{{ __('profile.subscribe_now') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
