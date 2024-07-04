@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4 container mx-auto">{{ $program->exists ? 'Edit Program' : 'Create Program' }}</h1>
    <form id="programForm" class="space-y-4">
        @csrf
        @if($program->exists)
            @method('PUT')
        @else
            @method('POST')
        @endif
        <div class="mb-4">
            <label for="name" class="block text-lg font-medium">Name</label>
            <input type="text" name="name" id="name" class="input input-bordered w-full" value="{{ $program->name ?? '' }}" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-lg font-medium">Description</label>
            <textarea name="description" id="description" class="textarea textarea-bordered w-full" required>{{ $program->description ?? '' }}</textarea>
        </div>
        <div class="mb-4 flex items-center space-x-4">
            <img src="{{ asset($program->image) }}" alt="{{ $program->name }}" class="w-32 h-32 rounded shadow-lg mb-2" id="programImage">
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text font-semibold">Pick a file</span>
                    <span class="label-text-alt">(2MB max)</span>
                </div>
                <input type="file" class="file-input file-input-bordered file-input-primary w-full max-w-xs" onchange="saveImage()">
                <span class="label-text-alt">.png, .jpg, .jpeg .gif .wepb .svg</span>
            </label>
        </div>
        <div class="text-center">
            <a href="{{ route('programs.index') }}" class="btn btn-outline">Save</a>
        </div>
        <div class="mb-4">
            <label for="status" class="block text-lg font-medium">Public</label>
            <input type="checkbox" name="status" id="status" class="toggle toggle-success" {{ $program->status == 1 ? 'checked' : '' }} onchange="toggleStatus()">
        </div>
        <br>
    </form>
    <div id="programArea" class="{{ $program->exists ? '' : 'hidden' }}">
        <div class="flex justify-between items-center">
            <div>
                <div class="flex">
                    <div class="w-1/3 p-4 bg-gray-100 rounded-md space-y-2">
                        <h3 class="text-xl font-bold mb-2">Exercises</h3>
                        @foreach ($exercises as $exercise)
                                <div class="flex items-center justify-between p-2 bg-white rounded-md shadow-sm">
                                    <img src="{{ asset($exercise->image) }}" alt="{{ $exercise->name }}" class="w-16 h-16 rounded-full mr-2">
                                    <span>{{ $exercise->name }}</span>
                                    <button type="button" class="btn btn-circle btn-outline"
                                            onclick="addExercise('{{ $exercise->id }}', '{{ $exercise->name }}')">+</button>
                                </div>
                        @endforeach
                    </div>
                    <div class="w-2/3 p-4 bg-gray-100 rounded-md ml-4 space-y-4">
                        <div class="flex justify-between">
                            <h3 class="text-xl font-bold mb-2">Days</h3>
                            <button type="button" class="btn btn-outline" onclick="addDay()">Add Day</button>
                        </div>
                        <div id="day-container" class="space-y-2">
                            @foreach ($days as $dayIndex => $exercises)
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-xl font-bold mb-2">Day {{ $dayIndex }}</h3>
                                        <input type="radio" name="selected_day" value="{{ $dayIndex }}" class="form-radio">
                                    </div>
                                    <table class="table-auto w-full">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Exercise</th>
                                            <th>Repetitions</th>
                                            <th>Break (s)</th>
                                            <th>Weight (kg)</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="exercise-list-{{ $dayIndex }}">
                                        @foreach ($exercises as $index => $exercise)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $exercise->name }}</td>
                                                <input type="hidden" name="exercise_program_id" value="{{ $exercise->pivot->id }}">
                                                <input type="hidden" name="exercise_id" value="{{ $exercise->id }}">
                                                <td><input type="number" name="rep" placeholder="Rep" class="input input-bordered w-full" value="{{ $exercise->pivot->rep }}" onchange="saveExercise(this, {{ $exercise->id }}, {{ $dayIndex }}, {{ $index + 1 }})"></td>
                                                <td><input type="number" name="break_time" placeholder="Break" class="input input-bordered w-full" value="{{ $exercise->pivot->break }}" onchange="saveExercise(this, {{ $exercise->id }}, {{ $dayIndex }}, {{ $index + 1 }})"></td>
                                                <td><input type="number" name="weight" placeholder="Weight" class="input input-bordered w-full" value="{{ $exercise->pivot->weight }}" onchange="saveExercise(this, {{ $exercise->id }}, {{ $dayIndex }}, {{ $index + 1 }})"></td>
                                                <td><button type="button" class="btn btn-circle btn-outline" onclick="removeExercise(this, '{{ $exercise->pivot->id }}')">X</button></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let programId = {{ $program->id ?? 'null' }};
        let dayCount = {{ count($days) }};
        let exerciseCounts = @json($exerciseCounts);
        let debounceTimer;

        document.getElementById('name').addEventListener('input', debounceUpdateProgramDetails);
        document.getElementById('description').addEventListener('input', debounceUpdateProgramDetails);

        function debounceUpdateProgramDetails() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(updateProgramDetails, 1000);
        }

        function updateProgramDetails() {
            const name = document.getElementById('name').value;
            const description = document.getElementById('description').value;

            fetch(`/programs/${programId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ name, description })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error('Error:', data.error);
                    } else {
                        console.log('Program details updated:', data);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function addExercise(exerciseId, exerciseName) {
            const selectedDay = document.querySelector('input[name="selected_day"]:checked');
            if (!selectedDay) {
                alert('Please select a day to add the exercise.');
                return;
            }

            const dayIndex = selectedDay.value;
            const exerciseDiv = document.createElement('tr');
            exerciseCounts[dayIndex] = (exerciseCounts[dayIndex] || 0) + 1;
            const exerciseCount = exerciseCounts[dayIndex];

            exerciseDiv.innerHTML = `
                <td>${exerciseCount}</td>
                <td>${exerciseName}</td>
                <input type="hidden" name="exercise_program_id" value="">
                <input type="hidden" name="exercise_id" value="${exerciseId}">
                <td><input type="number" name="rep" placeholder="Rep" class="input input-bordered w-full" onchange="saveExercise(this, ${exerciseId}, ${dayIndex}, ${exerciseCount})"></td>
                <td><input type="number" name="break_time" placeholder="Break" class="input input-bordered w-full" onchange="saveExercise(this, ${exerciseId}, ${dayIndex}, ${exerciseCount})"></td>
                <td><input type="number" name="weight" placeholder="Weight" class="input input-bordered w-full" onchange="saveExercise(this, ${exerciseId}, ${dayIndex}, ${exerciseCount})"></td>
                <td><button type="button" class="btn btn-circle btn-outline" onclick="removeExercise(this, '')">X</button></td>
            `;

            const dayContainer = document.getElementById(`exercise-list-${dayIndex}`);
            if (dayContainer) {
                dayContainer.appendChild(exerciseDiv);
                saveExercise(exerciseDiv, exerciseId, dayIndex, exerciseCount);
            } else {
                console.error('Day container not found for day index:', dayIndex);
            }
        }

        function saveExercise(element, exerciseId, dayIndex, order) {
            const row = element.closest('tr');
            const rep = row.querySelector('input[name="rep"]').value || 0;
            const breakTime = row.querySelector('input[name="break_time"]').value || 0;
            const weight = row.querySelector('input[name="weight"]').value || 0;
            const exerciseProgramId = row.querySelector('input[name="exercise_program_id"]').value;

            const url = exerciseProgramId ? `/programs/${programId}/exercises/${exerciseProgramId}` : `/programs/${programId}/exercises`;
            const method = exerciseProgramId ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ day: dayIndex, exercise_id: exerciseId, order: order, rep: rep, break_time: breakTime, weight: weight })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error('Error:', data.error);
                    } else {
                        console.log('Success:', data);
                        if (!exerciseProgramId) {
                            row.querySelector('input[name="exercise_program_id"]').value = data.id;
                            row.querySelector('button').setAttribute('onclick', `removeExercise(this, ${data.id})`);
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        }



        function removeExercise(button, exerciseProgramId) {
            const row = button.closest('tr');
            row.remove();

            fetch(`/programs/${programId}/exercises/${exerciseProgramId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error('Error:', data.error);
                    } else {
                        console.log('Deleted:', data);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function addDay() {
            dayCount++;
            exerciseCounts[dayCount] = 0;
            const dayDiv = document.createElement('div');
            dayDiv.classList.add('space-y-2');
            dayDiv.innerHTML = `
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold mb-2">Day ${dayCount}</h3>
                    <input type="radio" name="selected_day" value="${dayCount}" class="form-radio">
                </div>
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Exercise</th>
                            <th>Repetitions</th>
                            <th>Break (s)</th>
                            <th>Weight (kg)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="exercise-list-${dayCount}">
                        <!-- Placeholder for dynamically added exercises -->
                    </tbody>
                </table>
            `;
            document.getElementById('day-container').appendChild(dayDiv);
        }

        function updateExerciseOrder(dayIndex) {
            const rows = document.querySelectorAll(`#exercise-list-${dayIndex} tr`);
            rows.forEach((row, index) => {
                row.children[0].textContent = index + 1;
                const exerciseId = row.querySelector('input[name="exercise_id"]').value;
                saveExercise(row, exerciseId, dayIndex, index + 1);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('programArea').classList.remove('hidden');
        });

        function toggleStatus() {
            const status = document.getElementById('status').checked ? 1 : 0;

            fetch(`/programs/${programId}/toggle-status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ status: status })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error('Error:', data.error);
                    } else {
                        console.log('Status updated:', data);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function saveImage() {
            const fileInput = document.querySelector('.file-input');
            const file = fileInput.files[0];
            const formData = new FormData();
            formData.append('image', file);

            fetch(`/programs/${programId}/image`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error('Error:', data.error);
                    } else {
                        console.log('Image uploaded:', data);
                        document.getElementById('programImage').src = `{{ asset('') }}${data.image}`;
                    }
                })
                .catch(error => alert('Erreur: Image invalide'));
        }
    </script>
@endsection
