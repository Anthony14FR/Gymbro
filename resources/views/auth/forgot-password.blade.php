<x-guest-layout>
    <div class="mb-4 text-sm text-center">
        {{ __('Mot de passe oublié ? Pas de problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation du mot de passe qui vous permettra d\'en choisir un nouveau.') }}
    </div>

    <!-- Statut de la session -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Adresse e-mail -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" class="label-text" />
            <x-text-input id="email" class="input input-bordered w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit" class="btn btn-primary btn-sm">
                {{ __('Envoyer le lien de réinitialisation') }}
            </button>
        </div>
    </form>
</x-guest-layout>