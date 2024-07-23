<section>
    <header>
        <span class="text-2xl font-medium text-base-content">
            {{ __('Mettre à jour le mot de passe') }} <i class="fa-solid fa-key ml-2"></i>
        </span>

        <p class="mt-1 text-sm text-base-content/70">
            {{ __('Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Mot de passe actuel')" class="text-base-content" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full bg-base-200 text-base-content border-base-300" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Nouveau mot de passe')" class="text-base-content" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full bg-base-200 text-base-content border-base-300" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmer le mot de passe')" class="text-base-content" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full bg-base-200 text-base-content border-base-300" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="btn btn-primary">{{ __('Enregistrer') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-base-content/70"
                >{{ __('Enregistré.') }}</p>
            @endif
        </div>
    </form>
</section>