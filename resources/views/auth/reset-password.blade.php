<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Jeton de réinitialisation du mot de passe -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Adresse e-mail -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" class="label-text" />
            <x-text-input id="email" class="input input-bordered w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Mot de passe -->
        <div>
            <x-input-label for="password" :value="__('Nouveau mot de passe')" class="label-text" />
            <x-text-input id="password" class="input input-bordered w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmation du mot de passe -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="label-text" />
            <x-text-input id="password_confirmation" class="input input-bordered w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit" class="btn btn-primary btn-sm">
                {{ __('Réinitialiser le mot de passe') }}
            </button>
        </div>
    </form>
</x-guest-layout>