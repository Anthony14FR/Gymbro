@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        @if ($errors->any())
            <div class="alert alert-error shadow-lg mb-8">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
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
                    <i class="fas fa-check-circle"></i>
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
                        <div class="stat-title text-xs font-semibold uppercase">{{ __('users.total_users') }}</div>
                        <div class="stat-value text-3xl font-bold">{{ number_format($totalUsers) }}</div>
                    </div>
                    <i class="fas fa-users text-2xl text-primary"></i>
                </div>
            </div>

            <div class="stat bg-base-100 shadow rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="stat-title text-xs font-semibold uppercase">{{ __('users.verified_users') }}</div>
                        <div class="stat-value text-3xl font-bold">{{ number_format($verifiedUsers) }}</div>
                    </div>
                    <i class="fas fa-user-check text-2xl text-success"></i>
                </div>
            </div>

            <div class="stat bg-base-100 shadow rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="stat-title text-xs font-semibold uppercase">{{ __('users.new_users') }}</div>
                        <div class="stat-value text-3xl font-bold">{{ number_format($newUsers) }}</div>
                        <div class="stat-desc text-xs">{{ __('users.last_30_days') }}</div>
                    </div>
                    <i class="fas fa-user-plus text-2xl text-info"></i>
                </div>
            </div>

            <div class="stat bg-base-100 shadow rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="stat-title text-xs font-semibold uppercase">{{ __('users.subscribed_users') }}</div>
                        <div class="stat-value text-3xl font-bold">{{ number_format($subscribedUsers) }}</div>
                    </div>
                    <i class="fas fa-star text-2xl text-warning"></i>
                </div>
            </div>

            <div class="stat bg-base-100 shadow rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="stat-title text-xs font-semibold uppercase">{{ __('users.total_programs') }}</div>
                        <div class="stat-value text-3xl font-bold">{{ number_format($totalPrograms) }}</div>
                    </div>
                    <i class="fas fa-dumbbell text-2xl text-secondary"></i>
                </div>
            </div>

            <div class="stat bg-base-100 shadow rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="stat-title text-xs font-semibold uppercase">{{ __('users.public_programs') }}</div>
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
                        {{ __('users.user_management') }}
                        <i class="fa-solid fa-users fa-xs ml-2 text-accent"></i>
                    </h1>
                    <div>
                        <button class="btn btn-sm btn-primary mr-2" onclick="openInviteModal()">
                            {{ __('users.invite_users') }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <button class="btn btn-sm btn-primary mr-2" onclick="openCreateModal()">
                            {{ __('users.create_user') }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <button class="btn btn-sm btn-primary" onclick="openCleanProgramsModal()">
                            {{ __('Nettoyer les programmes') }}
                            <i class="fa-solid fa-trash ml-2"></i>
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
                        <th class="bg-base-200">{{ __('users.username') }}</th>
                        <th class="bg-base-200">{{ __('users.email') }}</th>
                        <th class="bg-base-200"><i class="fa-solid fa-check"></i>{{ __('users.verified') }}</th>
                        <th class="bg-base-200"><i class="fa-solid fa-star"></i>{{ __('users.subscribed') }}</th>
                        <th class="bg-base-200"><i class="fa-solid fa-crown"></i>{{ __('users.admin') }}</th>
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
                                    <span class="badge badge-success">{{ __('users.yes') }} <i class="fa-solid fa-check ml-1"></i></span>
                                @else
                                    <span class="badge badge-error">{{ __('users.no') }} <i class="fa-solid fa-times ml-1"></i></span>
                                @endif
                            </td>
                            <td>
                                @if($user->hasRole('premium'))
                                    <span class="badge badge-success">{{ __('users.yes') }} <i class="fa-solid fa-check ml-1"></i></span>
                                @else
                                    <span class="badge badge-error">{{ __('users.no') }} <i class="fa-solid fa-times ml-1"></i></span>
                                @endif
                            </td>
                            <td>
                                @if($user->hasRole('admin'))
                                    <span class="badge badge-success">{{ __('Oui') }} <i class="fa-solid fa-check ml-1"></i></span>
                                @else
                                    <span class="badge badge-error">{{ __('Non') }} <i class="fa-solid fa-times ml-1"></i></span>
                                @endif
                            </td>
                            <td>
                                <div class="flex flex-col gap-2 sm:flex-row sm:gap-1 justify-center">
                                    <button class="btn btn-xs sm:btn-sm btn-outline btn-primary"
                                            onclick="openEditModal({{ $user->id }}, '{{ $user->username }}', '{{ $user->email }}')">{{ __('users.edit') }} <i class="fa-solid fa-pencil ml-1"></i></button>
                                    <button class="btn btn-xs sm:btn-sm btn-outline btn-secondary"
                                            onclick="openDeleteModal({{ $user->id }}, '{{ $user->username }}')">{{ __('users.delete') }} <i class="fa-solid fa-trash ml-1"></i></button>
                                    <a href="{{ route('users.show', ['user' => $user->id]) }}"
                                       class="btn btn-xs sm:btn-sm btn-outline btn-accent">{{ __('users.view') }} <i class="fa-solid fa-eye ml-1"></i></a>
                                    <button class="btn btn-xs sm:btn-sm btn-outline {{ $user->hasRole('admin') ? 'btn-error' : 'btn-warning' }}"
                                            onclick="openEditRoleModal({{ $user->id }}, '{{ $user->username }}', {{ $user->hasRole('admin') ? 'true' : 'false' }})">
                                        @if($user->hasRole('admin'))
                                            {{ __('users.retrograde') }}
                                            <i class="fa-solid fa-user-minus ml-1"></i>
                                        @else
                                            {{ __('users.promote') }}
                                            <i class="fa-solid fa-crown ml-1"></i>
                                        @endif
                                    </button>
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
            <h3 class="font-bold text-lg mb-4">{{ __('users.create_user') }}</h3>
            <form id="create_user_form" method="POST" action="{{ route('users.store') }}" class="space-y-4">
                @csrf
                <div class="form-control">
                    <label class="label" for="create_username">
                        <span class="label-text">{{ __('users.username') }}</span>
                    </label>
                    <input type="text" id="create_username" name="username" class="input input-bordered w-full"
                           required>
                </div>
                <div class="form-control">
                    <label class="label" for="create_email">
                        <span class="label-text">{{ __('users.email') }}</span>
                    </label>
                    <input type="email" id="create_email" name="email" class="input input-bordered w-full" required>
                </div>
                <div class="form-control">
                    <label class="label" for="create_password">
                        <span class="label-text">{{ __('users.password') }}</span>
                    </label>
                    <input type="password" id="create_password" name="password" class="input input-bordered w-full"
                           required>
                </div>
                <div class="form-control">
                    <label class="label" for="create_password_confirmation">
                        <span class="label-text">{{ __('users.confirm_password') }}</span>
                    </label>
                    <input type="password" id="create_password_confirmation" name="password_confirmation"
                           class="input input-bordered w-full" required>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">{{ __('users.create') }}</button>
                    <button type="button" class="btn"
                            onclick="document.getElementById('create_modal').close()">{{ __('users.close') }}</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Invite Modal -->
    <dialog id="invite_modal" class="modal modal-bottom sm:modal-middle h-auto w-auto">
        <div class="modal-box">
            <h3 class="font-bold text-lg mb-4">{{ __('users.invite_users') }}</h3>
            <form id="invite_users_form" method="POST" action="{{ route('send.mail') }}" class="space-y-4">
                @csrf
                <div id="email-fields" class="space-y-4 max-h-64 overflow-y-auto">
                    <div class="email-field flex items-center">
                        <div class="w-full">
                            <label class="label" for="mail_to">
                                <span class="label-text">{{ __('users.email') }}</span>
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
                            {{ __('users.add_email') }}
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <button type="submit" class="btn btn-primary">{{ __('users.send') }}
                            <i class="fa-regular fa-paper-plane"></i></button>
                        <button type="button" class="btn"
                                onclick="document.getElementById('invite_modal').close()">{{ __('users.close') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Edit Modal -->
    <dialog id="edit_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="font-bold text-lg mb-4">{{ __('Modifier l\'utilisateur') }}</h3>
            <form id="edit_user_form" method="POST" action="{{ route('users.update' , ['user' => $user->id]) }}"
                  class="space-y-4">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_user_id" name="user_id">
                <div class="form-control">
                    <label class="label" for="edit_username">
                        <span class="label-text">{{ __('Nom d\'utilisateur') }}</span>
                    </label>
                    <input type="text" id="edit_username" name="username" class="input input-bordered w-full" required>
                </div>
                <div class="form-control">
                    <label class="label" for="edit_email">
                        <span class="label-text">{{ __('Email') }}</span>
                    </label>
                    <input type="email" id="edit_email" name="email" class="input input-bordered w-full" required>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">{{ __('Modifier') }}</button>
                    <button type="button" class="btn" onclick="document.getElementById('edit_modal').close()">{{ __('Fermer') }}</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Delete Modal -->
    <dialog id="delete_modal" class="modal modal-center">
        <div class="modal-box">
            <h3 class="font-bold text-lg mb-4">{{ __('users.delete_user') }}</h3>
            <form id="delete_user_form" method="POST" action="">
                @csrf
                @method('DELETE')
                <input type="hidden" id="delete_user_id" name="user_id">
                <p id="delete_user_message" class="text-base-content"></p>
                <div class="modal-action">
                    <button type="submit" class="btn btn-error">{{ __('users.delete') }}</button>
                    <button type="button" class="btn"
                            onclick="document.getElementById('delete_modal').close()">{{ __('users.close') }}</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Edit Role Modal -->
    <dialog id="edit_role_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="font-bold text-lg mb-4">{{ __('users.modify_role') }}</h3>
            <form id="edit_role_form" method="POST" action="" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_role_user_id" name="user_id">
                <p id="edit_role_message" class="text-base-content"></p>
                <div class="modal-action">
                    <button type="submit" id="edit_role_submit" class="btn btn-warning"></button>
                    <button type="button" class="btn" onclick="document.getElementById('edit_role_modal').close()">{{ __('users.cancel') }}</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Clean Programs Modal -->
    <dialog id="clean_programs_modal" class="modal modal-center">
        <div class="modal-box">
            <h3 class="font-bold text-lg mb-4">{{ __('users.clean_programs') }}</h3>
            <form id="clean_programs_form" method="POST" action="{{ route('users.cleanPrograms') }}">
                @csrf
                <p class="text-base-content">{{ __(users.clean_programs_check') }}</p>
                <div class="modal-action">
                    <button type="submit" class="btn btn-error">{{ __('users.clean') }}</button>
                    <button type="button" class="btn"
                            onclick="document.getElementById('clean_programs_modal').close()">{{ __('users.cancel') }}</button>
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
            document.getElementById('delete_user_message').innerText = "{{ __('users.are_you_sure') }} " + username + "?";
            document.getElementById('delete_modal').showModal();
        }

        function openCleanProgramsModal() {
            document.getElementById('clean_programs_modal').showModal();
        }

        function openEditRoleModal(userId, username) {
            const form = document.getElementById('edit_role_form');
            const message = document.getElementById('edit_role_message');
            const submitButton = document.getElementById('edit_role_submit');
            const currentUserId = {{ auth()->id() }};

            form.action = `/users/${userId}/role`;
            document.getElementById('edit_role_user_id').value = userId;

            const isAdmin = {{ $user->hasRole('admin') ? 'true' : 'false' }};

            if (userId == 1 || (userId == currentUserId && isAdmin)) {
                message.textContent = "Vous ne pouvez pas modifier le rôle de cet utilisateur.";
                submitButton.style.display = 'none';
            } else if (isAdmin) {
                message.textContent = `Voulez-vous rétrograder ${username} du rôle d'administrateur ?`;
                submitButton.textContent = 'Rétrograder';
                submitButton.style.display = 'inline-block';
            } else {
                message.textContent = `Voulez-vous promouvoir ${username} au rôle d'administrateur ?`;
                submitButton.textContent = 'Promouvoir';
                submitButton.style.display = 'inline-block';
            }

            document.getElementById('edit_role_modal').showModal();
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('add-email-field').addEventListener('click', function() {
                let emailFields = document.getElementById('email-fields');
                let newField = document.createElement('div');
                newField.classList.add('email-field' ,'flex', 'items-center');
                newField.innerHTML = `
                    <div class="w-full">
                            <label class="label" for="mail_to">
                                <span class="label-text">{{ __('users.email') }}</span>
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
