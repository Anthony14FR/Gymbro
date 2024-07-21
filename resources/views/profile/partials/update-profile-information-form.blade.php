<section>
    <header>
        <span class="text-2xl font-medium text-base-content">
            {{ __('profile.profile_information') }} <i class="fa-regular fa-address-card ml-2"></i>
        </span>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('profile.update_profile_information') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="username" :value="__('profile.username')" class="text-base-content" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full bg-base-200 text-base-content border-base-300" :value="old('username', $user->username)" required autofocus autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('profile.email')" class="text-base-content" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-base-200 text-base-content border-base-300" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-base-content">
                        {{ __('profile.email_not_verified') }}

                        <button form="send-verification" class="underline text-sm text-base-content/70 hover:text-primary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            {{ __('profile.resend_verification_email') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-success">
                            {{ __('profile.verification_link_sent') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="btn btn-primary">{{ __('profile.save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-base-content/70"
                >{{ __('profile.saved.') }}</p>
            @endif
        </div>
    </form>
</section>
