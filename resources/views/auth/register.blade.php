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

        <!-- Nom d'utilisateur -->
        <div>
            <x-input-label for="username" :value="__('Nom d\'utilisateur')" class="label-text" />
            <x-text-input id="username" class="input input-bordered w-full" type="text" name="username" :value="old('username')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Adresse e-mail -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" class="label-text" />
            <x-text-input id="email" class="input input-bordered w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Mot de passe -->
        <div>
            <x-input-label for="password" :value="__('Mot de passe')" class="label-text" />
            <x-text-input id="password" class="input input-bordered w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmer le mot de passe -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="label-text" />
            <x-text-input id="password_confirmation" class="input input-bordered w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0 mt-6">
            <a class="link link-primary text-sm" href="{{ route('login') }}">
                {{ __('Déjà inscrit ?') }}
            </a>
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                <a class="btn btn-neutral btn-sm w-full sm:w-auto" href="{{ route('login') }}">
                    {{ __('Se connecter') }}
                </a>
                <button class="btn btn-accent btn-sm w-full sm:w-auto">
                    {{ __('S\'inscrire') }}
                </button>
            </div>
        </div>
    </form>
</x-guest-layout>