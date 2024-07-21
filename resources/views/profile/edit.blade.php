@extends('layouts.app')

@section('content')

    <div class="flex justify-between md:flex-row md:space-y-0 space-y-10 flex-col sm:px-6 lg:px-6 p-6">
        <div class="breadcrumbs text-sm">
            <span class="text-4xl font-normal">Profile <i class="fa-regular fa-address-card ml-2 text-accent"></i></span>
            {!! Breadcrumbs::render() !!}
        </div>
    </div>

    <x-slot name="header">
        <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </span>
    </x-slot>

    <div class="p-6">
        <div class="grid md:grid-cols-2 grid-cols-1 gap-5">
            <div class="p-4 sm:p-8 dark:bg-base-200 border border-2 border-white/10 shadow sm:rounded-lg">
                <div class="">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 dark:bg-base-200 border border-2 border-white/10 shadow sm:rounded-lg">
                <div class="">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 dark:bg-base-200 border border-2 border-white/10 shadow sm:rounded-lg">
                <div class="">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 dark:bg-base-200 border border-2 border-white/10 shadow sm:rounded-lg">
                <div class="max-w-xl space-y-5">
                    <span class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Subscription Management') }}
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

                    @role('premium')
                        @if ($subscription)
                            <p>You are subscribed to the <span class="font-semibold text-yellow-600">Premium</span> plan.</p>
                            <form action="{{ route('subscriptions.unsubscribe') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-neutral mt-2">Unsubscribe</button>
                            </form>
                        @else
                            <p>You do not have an active subscription.</p>
                            <a href="{{ route('subscriptions.index') }}" class="btn btn-accent mt-2">Subscribe</a>
                        @endif
                    @else
                        <p>You do not have an active subscription.</p>
                        <a href="{{ route('subscriptions.index') }}" class="btn btn-accent mt-2">Subscribe</a>
                        
                    @endrole
                </div>
            </div>
        </div>
    </div>
@endsection
