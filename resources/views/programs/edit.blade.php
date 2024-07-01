@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4 container mx-auto">{{ $program ? 'Edit Program' : 'Create Program' }}</h1>
    <form id="programForm" class="space-y-4">
        @csrf
        @method($program ? 'PUT' : 'POST')
        <div class="mb-4">
            <label for="name" class="block text-lg font-medium">Name</label>
            <input type="text" name="name" id="name" class="input input-bordered w-full" value="{{ $program->name ?? '' }}" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-lg font-medium">Description</label>
            <textarea name="description" id="description" class="textarea textarea-bordered w-full" required>{{ $program->description ?? '' }}</textarea>
        </div>
    </form>
    <div id="programArea" class="{{ $program ? '' : 'hidden' }}">
        <div class="flex justify-between items-center">
            <div>
                <div class="flex">
                    <div class="w-1/3 p-4 bg-gray-100 rounded-md space-y-2">
                        <h3 class="text-xl font-bold mb-2">Exercises</h3>
                        @foreach ($muscles as $muscle)
                            @foreach ($muscle->exercises as $exercise)
                                <div class="flex items-center justify-between p-2 bg-white rounded-md shadow-sm">
                                    <span>{{ $exercise->name }}</span>
                                    <button type="button" class="btn btn-circle btn-outline"
                                            onclick="addExercise('{{ $exercise->id }}', '{{ $exercise->name }}')">+</button>
                                </div>
                            @endforeach
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
                                                    <input type="hidden" name="exercise_id" value="{{ $exercise->id }}">
                                                    <td><input type="number" name="repetitions" placeholder="Rep" class="input input-bordered w-full" value="{{ $exercise->pivot.rep }}" onchange="saveExercise(this, {{ $exercise->id }}, {{ $dayIndex }}, {{ $index + 1 }})"></td>
                                                    <td><input type="number" name="break" placeholder="Break" class="input input-bordered w-full" value="{{ $exercise->pivot.break }}" onchange="saveExercise(this, {{ $exercise->id }}, {{ $dayIndex }}, {{ $index + 1 }})"></td>
                                                    <td><input type="number" name="weight" placeholder="Weight" class="input input-bordered w-full" value="{{ $exercise->pivot.weight }}" onchange="saveExercise(this, {{ $exercise->id }}, {{ $dayIndex }}, {{ $index + 1 }})"></td>
                                                    <td><button type="button" class="btn btn-circle btn-outline" onclick="removeExercise(this, {{ $exercise->id }}, {{ $dayIndex }})">X</button></td>
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
            <button type="button" class="btn btn-primary" onclick="publishProgram()">Publish</button>
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
            debounceTimer = setTimeout(updateProgramDetails, 1000); // Delay of 1 second
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
                <input type="hidden" name="exercise_id" value="${exerciseId}">
                <td><input type="number" name="repetitions" placeholder="Rep" class="input input-bordered w-full" onchange="saveExercise(this, ${exerciseId}, ${dayIndex}, ${exerciseCount})"></td>
                <td><input type="number" name="break" placeholder="Break" class="input input-bordered w-full" onchange="saveExercise(this, ${exerciseId}, ${dayIndex}, ${exerciseCount})"></td>
                <td><input type="number" name="weight" placeholder="Weight" class="input input-bordered w-full" onchange="saveExercise(this, ${exerciseId}, ${dayIndex}, ${exerciseCount})"></td>
                <td><button type="button" class="btn btn-circle btn-outline" onclick="removeExercise(this, ${exerciseId}, ${dayIndex})">X</button></td>
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
            const repetitions = row.querySelector('input[name="repetitions"]').value || 0;
            const breakTime = row.querySelector('input[name="break"]').value || 0;
            const weight = row.querySelector('input[name="weight"]').value || 0;

            fetch(`/programs/${programId}/exercises`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ day: dayIndex, exercise_id: exerciseId, order: order, repetitions, break: breakTime, weight })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Error:', data.error);
                } else {
                    console.log('Success:', data);
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function removeExercise(button, exerciseId, dayIndex) {
            const row = button.closest('tr');
            row.remove();
            exerciseCounts[dayIndex]--;
            updateExerciseOrder(dayIndex);

            fetch(`/programs/${programId}/exercises/${exerciseId}`, {
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

        function publishProgram() {
            const programData = {
                name: document.getElementById('name').value,
                description: document.getElementById('description').value,
                days: []
            };

            for (let i = 1; i <= dayCount; i++) {
                const dayData = { day: i, exercises: [] };
                const rows = document.querySelectorAll(`#exercise-list-${i} tr`);

                rows.forEach(row => {
                    const exerciseId = row.querySelector('input[name="exercise_id"]').value;
                    const repetitions = row.querySelector('input[name="repetitions"]').value || 0;
                    const breakTime = row.querySelector('input[name="break"]').value || 0;
                    const weight = row.querySelector('input[name="weight"]').value || 0;

                    dayData.exercises.push({
                        exercise_id: exerciseId,
                        repetitions,
                        break: breakTime,
                        weight
                    });
                });

                programData.days.push(dayData);
            }

            fetch(`/programs/${programId}/save`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(programData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Error:', data.error);
                } else {
                    alert('Program saved!');
                    console.log('Program saved:', data);
                }
            })
            .catch(error => console.error('Error:', error));
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Initialize the program form for editing
            document.getElementById('programArea').classList.remove('hidden');

            // Load existing days and exercises
            const days = @json($days);
            Object.keys(days).forEach(day => {
                dayCount = parseInt(day);
                addDay();

                days[day].forEach((exercise, index) => {
                    const exerciseDiv = document.createElement('tr');
                    exerciseCounts[day] = (exerciseCounts[day] || 0) + 1;
                    const exerciseCount = exerciseCounts[day];

                    exerciseDiv.innerHTML = `
                        <td>${exerciseCount}</td>
                        <td>${exercise.name}</td>
                        <input type="hidden" name="exercise_id" value="${exercise.id}">
                        <td><input type="number" name="repetitions" placeholder="Rep" class="input input-bordered w-full" value="${exercise.pivot.rep}" onchange="saveExercise(this, ${exercise.id}, ${day}, ${exerciseCount})"></td>
                        <td><input type="number" name="break" placeholder="Break" class="input input-bordered w-full" value="${exercise.pivot.break}" onchange="saveExercise(this, ${exercise.id}, ${day}, ${exerciseCount})"></td>
                        <td><input type="number" name="weight" placeholder="Weight" class="input input-bordered w-full" value="${exercise.pivot.weight}" onchange="saveExercise(this, ${exercise.id}, ${day}, ${exerciseCount})"></td>
                        <td><button type="button" class="btn btn-circle btn-outline" onclick="removeExercise(this, ${exercise.id}, ${day})">X</button></td>
                    `;

                    const dayContainer = document.getElementById(`exercise-list-${day}`);
                    if (dayContainer) {
                        dayContainer.appendChild(exerciseDiv);
                    } else {
                        console.error('Day container not found for day:', day);
                    }
                });
            });
        });
    </script>
@endsection
