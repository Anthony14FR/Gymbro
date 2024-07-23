<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        @if ($errors->any())
            <div class="alert alert-error">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Username')" class="label-text" />
            <x-text-input id="username" class="input input-bordered w-full" type="text" name="username" :value="old('username')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="label-text" />
            <x-text-input id="email" class="input input-bordered w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="label-text" />
            <x-text-input id="password" class="input input-bordered w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="label-text" />
            <x-text-input id="password_confirmation" class="input input-bordered w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="link link-primary" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <a class="ml-16 btn btn-neutral btn-sm" href="{{ route('login') }}">
                {{ __('Log in') }}
            </a>
            <button class="btn btn-accent btn-sm lg:ml-0 ml-2">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>