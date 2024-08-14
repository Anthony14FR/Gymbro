<x-guest-layout>
    <!-- Statut de la session -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Adresse e-mail -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" class="label-text"/>
            <x-text-input id="email" class="input input-bordered w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Mot de passe -->
        <div>
            <x-input-label for="password" :value="__('Mot de passe')" class="label-text"/>
            <x-text-input id="password" class="input input-bordered w-full" type="password" name="password" required autocomplete="current-password"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Se souvenir de moi -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="checkbox checkbox-primary" name="remember">
            <label for="remember_me" class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Se souvenir de moi') }}
            </label>
        </div>

        <div class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0 mt-6">
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                @if (Route::has('password.request'))
                    <a class="link link-primary text-sm" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié ?') }}
                    </a>
                @endif
            </div>
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                <a class="btn btn-neutral btn-sm w-full sm:w-auto" href="{{ route('register') }}">
                    {{ __('S\'inscrire') }}
                </a>
                <button class="btn btn-accent btn-sm w-full sm:w-auto">
                    {{ __('Se connecter') }}
                </button>
            </div>
        </div>
    </form>
</x-guest-layout>