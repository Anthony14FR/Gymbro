@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        @if ($errors->any())
            <div class="alert alert-error shadow-lg mb-8">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if ($success = Session::get('success'))
            <div class="alert alert-success shadow-lg mb-8">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                         viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ $success }}</span>
                </div>
            </div>
        @endif

        @if ($warning = Session::get('warning'))
            <div class="alert alert-warning shadow-lg mb-8">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span>{{ $warning }}</span>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8 bg-base-200 p-4 rounded-lg shadow">
            <div class="stat bg-base-100 shadow rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="stat-title text-xs font-semibold uppercase">{{ __('Total Utilisateurs') }}</div>
                        <div class="stat-value text-3xl font-bold">{{ number_format($totalUsers) }}</div>
                    </div>
                    <i class="fas fa-users text-2xl text-primary"></i>
                </div>
            </div>

            <div class="stat bg-base-100 shadow rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="stat-title text-xs font-semibold uppercase">{{ __('Utilisateurs Vérifiés') }}</div>
                        <div class="stat-value text-3xl font-bold">{{ number_format($verifiedUsers) }}</div>
                    </div>
                    <i class="fas fa-user-check text-2xl text-success"></i>
                </div>
            </div>

            <div class="stat bg-base-100 shadow rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="stat-title text-xs font-semibold uppercase">{{ __('Nouveaux Utilisateurs') }}</div>
                        <div class="stat-value text-3xl font-bold">{{ number_format($newUsers) }}</div>
                        <div class="stat-desc text-xs">{{ __('30 derniers jours') }}</div>
                    </div>
                    <i class="fas fa-user-plus text-2xl text-info"></i>
                </div>
            </div>

            <div class="stat bg-base-100 shadow rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="stat-title text-xs font-semibold uppercase">{{ __('Utilisateurs Abonnés') }}</div>
                        <div class="stat-value text-3xl font-bold">{{ number_format($subscribedUsers) }}</div>
                    </div>
                    <i class="fas fa-star text-2xl text-warning"></i>
                </div>
            </div>

            <div class="stat bg-base-100 shadow rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="stat-title text-xs font-semibold uppercase">{{ __('Total Programmes') }}</div>
                        <div class="stat-value text-3xl font-bold">{{ number_format($totalPrograms) }}</div>
                    </div>
                    <i class="fas fa-dumbbell text-2xl text-secondary"></i>
                </div>
            </div>

            <div class="stat bg-base-100 shadow rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="stat-title text-xs font-semibold uppercase">{{ __('Programmes Publics') }}</div>
                        <div class="stat-value text-3xl font-bold">{{ number_format($publicPrograms) }}</div>
                    </div>
                    <i class="fas fa-globe text-2xl text-accent"></i>
                </div>
            </div>
        </div>

        <div class="bg-base-100 shadow-xl rounded-lg overflow-hidden">
            <div class="flex flex-col p-6 bg-base-200 border-b border-base-300">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
                    <h1 class="text-3xl font-bold text-base-content mb-2 sm:mb-0">
                        {{ __('Gestion des utilisateurs') }}
                        <i class="fa-solid fa-users fa-xs ml-2 text-accent"></i>
                    </h1>
                    <div>
                        <button class="btn btn-sm btn-primary mr-2" onclick="openInviteModal()">
                            {{ __('Inviter des utilisateurs') }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <button class="btn btn-sm btn-primary" onclick="openCreateModal()">
                            {{ __('Créer un utilisateur') }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="breadcrumbs text-sm">
                    {!! Breadcrumbs::render() !!}
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="table w-full text-center">
                    <thead>
                    <tr>
                        <th class="bg-base-200">#</th>
                        <th class="bg-base-200">{{ __('Nom d\'utilisateur') }}</th>
                        <th class="bg-base-200">{{ __('Email') }}</th>
                        <th class="bg-base-200">{{ __('Vérifié') }}</th>
                        <th class="bg-base-200">{{ __('Abonné') }}</th>
                        <th class="bg-base-200">{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-base-200">
                            <th>{{ $user->id }}</th>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->email_verified_at)
                                    <span class="badge badge-success">{{ __('Oui') }} <i class="fa-solid fa-check ml-1"></i></span>
                                @else
                                    <span class="badge badge-error">{{ __('Non') }} <i class="fa-solid fa-times ml-1"></i></span>
                                @endif
                            </td>
                            <td>
                                @if($user->hasRole('premium'))
                                    <span class="badge badge-success">{{ __('Oui') }} <i class="fa-solid fa-check ml-1"></i></span>
                                @else
                                    <span class="badge badge-error">{{ __('Non') }} <i class="fa-solid fa-times ml-1"></i></span>
                                @endif
                            </td>
                            <td>
                                <div class="flex flex-col gap-2 sm:flex-row sm:gap-1 justify-center">
                                    <button class="btn btn-xs sm:btn-sm btn-outline btn-primary"
                                            onclick="openEditModal({{ $user->id }}, '{{ $user->username }}', '{{ $user->email }}')">{{ __('Modifier') }} <i class="fa-solid fa-pencil ml-1"></i></button>
                                    <button class="btn btn-xs sm:btn-sm btn-outline btn-secondary"
                                            onclick="openDeleteModal({{ $user->id }}, '{{ $user->username }}')">{{ __('Supprimer') }} <i class="fa-solid fa-trash ml-1"></i></button>
                                    <a href="{{ route('users.show', ['user' => $user->id]) }}"
                                       class="btn btn-xs sm:btn-sm btn-outline btn-accent">{{ __('Afficher') }} <i class="fa-solid fa-eye ml-1"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <dialog id="create_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="font-bold text-lg mb-4">{{ __('Créer un utilisateur') }}</h3>
            <form id="create_user_form" method="POST" action="{{ route('users.store') }}" class="space-y-4">
                @csrf
                <div class="form-control">
                    <label class="label" for="create_username">
                        <span class="label-text">{{ __('Nom d\'utilisateur') }}</span>
                    </label>
                    <input type="text" id="create_username" name="username" class="input input-bordered w-full"
                           required>
                </div>
                <div class="form-control">
                    <label class="label" for="create_email">
                        <span class="label-text">{{ __('Email') }}</span>
                    </label>
                    <input type="email" id="create_email" name="email" class="input input-bordered w-full" required>
                </div>
                <div class="form-control">
                    <label class="label" for="create_password">
                        <span class="label-text">{{ __('Mot de passe') }}</span>
                    </label>
                    <input type="password" id="create_password" name="password" class="input input-bordered w-full"
                           required>
                </div>
                <div class="form-control">
                    <label class="label" for="create_password_confirmation">
                        <span class="label-text">{{ __('Confirmer le mot de passe') }}</span>
                    </label>
                    <input type="password" id="create_password_confirmation" name="password_confirmation"
                           class="input input-bordered w-full" required>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">{{ __('Créer') }}</button>
                    <button type="button" class="btn"
                            onclick="document.getElementById('create_modal').close()">{{ __('Fermer') }}</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Invite Modal -->
    <dialog id="invite_modal" class="modal modal-bottom sm:modal-middle h-auto w-auto">
        <div class="modal-box">
            <h3 class="font-bold text-lg mb-4">{{ __('Inviter des utilisateurs') }}</h3>
            <form id="invite_users_form" method="POST" action="{{ route('send.mail') }}" class="space-y-4">
                @csrf
                <div id="email-fields" class="space-y-4 max-h-64 overflow-y-auto">
                    <div class="email-field flex items-center">
                        <div class="w-full">
                            <label class="label" for="mail_to">
                                <span class="label-text">{{ __('Email') }}</span>
                            </label>
                            <input type="email" name="mail_to[]" class="input input-bordered" required>
                            <button type="button" class="btn btn-error ml-2 remove-email-field">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <div class="modal-action">
                        <button type="button" id="add-email-field" class="btn btn-secondary">
                            {{ __('Add email') }}
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <button type="submit" class="btn btn-primary">{{ __('Send') }}
                            <i class="fa-regular fa-paper-plane"></i></button>
                        <button type="button" class="btn"
                                onclick="document.getElementById('invite_modal').close()">{{ __('Fermer') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        function openCreateModal() {
            document.getElementById('create_modal').showModal();
        }

        function openInviteModal() {
            document.getElementById('invite_modal').showModal();
        }

        function openEditModal(userId, username, email) {
            document.getElementById('edit_user_id').value = userId;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_modal').showModal();
        }

        function openDeleteModal(userId, username) {
            document.getElementById('delete_user_id').value = userId;
            document.getElementById('delete_user_form').action = "/users/" + userId;
            document.getElementById('delete_user_message').innerText = "{{ __('Êtes-vous sûr de vouloir supprimer l\'utilisateur :') }} " + username + "?";
            document.getElementById('delete_modal').showModal();
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('add-email-field').addEventListener('click', function() {
                let emailFields = document.getElementById('email-fields');
                let newField = document.createElement('div');
                newField.classList.add('email-field' ,'flex', 'items-center');
                newField.innerHTML = `
                    <div class="w-full">
                            <label class="label" for="mail_to">
                                <span class="label-text">{{ __('Email') }}</span>
                            </label>
                            <input type="email" name="mail_to[]" class="input input-bordered" required>
                            <button type="button" class="btn btn-error ml-2 remove-email-field">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                `;
                emailFields.appendChild(newField);
            });

            document.getElementById('email-fields').addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-email-field') || event.target.closest('.remove-email-field')) {
                    event.target.closest('.email-field').remove();
                }
            });

           document.getElementById('invite_users_form').addEventListener('submit', function(event) {
                let emailInputs = document.querySelectorAll('input[name="mail_to[]"]');
                let emails = [];
                let duplicates = false;

                emailInputs.forEach(function(input) {
                    if (emails.includes(input.value)) {
                        duplicates = true;
                        input.classList.add('border-red-500');
                    } else {
                        emails.push(input.value);
                        input.classList.remove('border-red-500');
                    }
                });

                if (duplicates) {
                    event.preventDefault();
                    alert('Please remove duplicate emails.');
                }
            });
        });

    </script>
@endsection
