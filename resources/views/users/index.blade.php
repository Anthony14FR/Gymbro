@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if ($success = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $success }}</p>
        </div>
    @endif
    @if ($warning = Session::get('warning'))
        <div class="alert alert-warning">
            <p>{{ $warning }}</p>
        </div>
    @endif
    <div class="overflow-x-auto space-y-10">
        <div class="flex justify-end mb-4">
            <button class="btn btn-primary" onclick="openCreateModal()">Create User</button>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Verified</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Show</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="hover">
                        <th>{{ $user->id }}</th>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->email_verified_at == null ? 'No' : 'Yes' }}</td>
                        <td>
                            <button class="btn btn-sm" onclick="openEditModal({{ $user->id }}, '{{ $user->username }}', '{{ $user->email }}')">Edit</button>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger" onclick="openDeleteModal({{ $user->id }}, '{{ $user->username }}')">Delete</button>
                        </td>
                        <td>
                            <a href="{{ route('users.show', ['user' => $user->id]) }}" class="btn btn-sm btn-info">Show</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Create Modal -->
    <dialog id="create_modal" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Create User</h3>
            <form id="create_user_form" method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="py-4">
                    <label for="create_username">Username</label>
                    <input type="text" id="create_username" name="username" class="input input-bordered w-full">
                </div>
                <div class="py-4">
                    <label for="create_email">Email</label>
                    <input type="email" id="create_email" name="email" class="input input-bordered w-full">
                </div>
                <div class="py-4">
                    <label for="create_password">Password</label>
                    <input type="password" id="create_password" name="password" class="input input-bordered w-full">
                </div>
                <div class="py-4">
                    <label for="create_password_confirmation">Repeat Password</label>
                    <input type="password" id="create_password_confirmation" name="password_confirmation" class="input input-bordered w-full">
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <button type="button" class="btn" onclick="document.getElementById('create_modal').close()">Close</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Edit Modal -->
    <dialog id="edit_modal" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Edit User</h3>
            <form id="edit_user_form" method="POST" action="{{ route('users.update', ['user' => 0]) }}">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_user_id" name="user_id">
                <div class="py-4">
                    <label for="username">Username</label>
                    <input type="text" id="edit_username" name="username" class="input input-bordered w-full">
                </div>
                <div class="py-4">
                    <label for="email">Email</label>
                    <input type="email" id="edit_email" name="email" class="input input-bordered w-full">
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn" onclick="document.getElementById('edit_modal').close()">Close</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Delete Modal -->
    <dialog id="delete_modal" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Delete User</h3>
            <p id="delete_user_message" class="py-4"></p>
            <div class="modal-action">
                <form id="delete_user_form" method="POST" action="{{ route('users.destroy', ['user' => 0]) }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="delete_user_id" name="user_id">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                <button type="button" class="btn" onclick="document.getElementById('delete_modal').close()">Cancel</button>
            </div>
        </div>
    </dialog>

    <script>
        function openCreateModal() {
            document.getElementById('create_modal').showModal();
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
            document.getElementById('delete_user_message').innerText = "Are you sure you want to delete the user: " + username + "?";
            document.getElementById('delete_modal').showModal();
        }
    </script>
    
@endsection
