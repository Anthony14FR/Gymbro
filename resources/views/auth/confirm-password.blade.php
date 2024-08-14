<x-guest-layout>
    <div class="mb-4 text-sm">
        {{ __('Ceci est une zone sécurisée de l\'application. Veuillez confirmer votre mot de passe avant de continuer.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <!-- Mot de passe -->
        <div>
            <x-input-label for="password" :value="__('Mot de passe')" class="label-text" />

            <x-text-input id="password"
                          class="input input-bordered w-full"
                          type="password"
                          name="password"
                          required
                          autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit" class="btn btn-primary btn-sm">
                {{ __('Confirmer') }}
            </button>
        </div>
    </form>
</x-guest-layout>