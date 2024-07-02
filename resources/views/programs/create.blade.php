@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4 container mx-auto">Create Program</h1>
    <form action="{{ route('programs.store') }}" method="POST" class="space-y-4">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-lg font-medium">Name</label>
            <input type="text" name="name" id="name" class="input input-bordered w-full" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-lg font-medium">Description</label>
            <textarea name="description" id="description" class="textarea textarea-bordered w-full" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Create Program</button>
    </form>
@endsection
