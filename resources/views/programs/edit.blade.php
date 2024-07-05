@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center md:flex-row md:space-y-0 space-y-10 flex-col mb-6 p-3">
        <div class="breadcrumbs text-sm">
            <h1 class="text-2xl font-bold">{{ $program->exists ? 'Edit Program' : 'Create Program' }}</h1>
            {!! Breadcrumbs::render() !!}
        </div>
    </div>
    <form id="programForm" class="space-y-4 w-full p-5 bg-base-300 edit-programs-form space-y-5">
        @csrf
        @if ($program->exists)
            @method('PUT')
        @else
            @method('POST')
        @endif
        <div class="flex md:flex-row flex-col md:space-x-10 w-full items-center space-y-2">
            <div class="w-full">
                <label for="name" class="block text-lg font-medium">Nom</label>
                <input type="text" name="name" id="name" class="input rounded-none input-bordered w-full"
                    value="{{ $program->name ?? '' }}" required>
            </div>
            <div class="w-full">
                <label for="description" class="block text-lg font-medium">Description</label>
                <input name="description" id="description" value="{{ $program->description ?? '' }}"
                    class="input rounded-none input-bordered w-full" required>
            </div>
        </div>
        <div class="mb-4 flex items-center space-x-4 justify-center">
            <img src="{{ asset($program->image) }}" alt="{{ $program->name }}"
                 class="w-32 h-32 rounded shadow-lg mb-2" id="programImage">
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text font-semibold">Pick a file</span>
                    <span class="label-text-alt">(2MB max)</span>
                </div>
                <input type="file" class="file-input file-input-bordered file-input-primary w-full max-w-xs"
                       onchange="saveImage()">
                <span class="label-text-alt">.png, .jpg, .jpeg .gif .wepb .svg</span>
            </label>
        </div>
        <label class="swap">
            <input type="checkbox" name="status" id="status" class="hidden" {{ $program->status == 1 ? 'checked' : '' }}
                onchange="toggleStatus()">
            <div class="swap-on flex bg-neutral rounded p-3 items-center">Private <i class="ml-2 fa-solid fa-lock"></i>
            </div>
            <div class="swap-off flex bg-accent/20 rounded p-3 items-center">Public <i
                    class="ml-2 fa-solid fa-lock-open"></i></div>
        </label>
    </form>
    <div id="programArea" class="mt-16 overflow-x-hidden {{ $program->exists ? '' : 'hidden' }}">
        <div class="flex flex-col">
            <h3 class="text-xl font-bold mb-2">Exercises</h3>
            <input type="text" id="search" class="input input-bordered w-56" placeholder="Search exercises">
        </div>
        <div class="flex justify-between items-center bg-base-300 p-6 rounded-xl mt-8 mb-5">
            <div class="flex overflow-x-scroll gap-6">
                @foreach ($exercises as $exercise)
                    <div
                        class="flex mb-5 flex-row justify-between items-center p-4 space-x-5 bg-base-200 rounded-xl shadow-sm">
                        <div class="avatar">
                            <div class="ring-accent ring-offset-base-100 my-5 w-16 rounded-full ring ring-offset-2">
                                <img src="{{ asset($exercise->image) }}" alt="{{ $exercise->name }}"
                                    class="rounded-full mr-2">
                            </div>
                        </div>
                        <span class="w-36">{{ $exercise->name }}</span>
                        <button type="button" class="btn btn-circle btn-outline"
                            onclick="addExercise('{{ $exercise->id }}', '{{ $exercise->name }}')">+</button>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex flex-col mt-8">
            <div class="p-4 bg-base-200 rounded-md ml-4 space-y-4">
                <div class="flex justify-between">
                    <h3 class="text-xl font-bold mb-2"></h3>
                    <button type="button" class="btn btn-outline" onclick="addDay()">Add Day</button>
                </div>
                <div id="day-container" class="space-y-2">
                    @foreach ($days as $dayIndex => $exercises)
                        <div class="space-y-2 day-div" style="display: {{ $dayIndex == 1 ? 'block' : 'none' }}">
                            <div class="flex justify-between items-center">
                                <h3 class="text-xl font-bold mb-2">Day {{ $dayIndex }}</h3>
                                <input type="radio" name="selected_day" value="{{ $dayIndex }}"
                                    class="form-radio hidden" {{ $dayIndex == 1 ? 'checked' : '' }}>
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
                                <tbody id="exercise-list-{{ $dayIndex }}" class="">
                                    @foreach ($exercises as $index => $exercise)
                                        <tr class="">
                                            <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                                            <td class="px-4 py-2">{{ $exercise->name }}</td>
                                            <input type="hidden" name="exercise_program_id"
                                                value="{{ $exercise->pivot->id }}">
                                            <input type="hidden" name="exercise_id" value="{{ $exercise->id }}">
                                            <td class="px-4 py-2"><input type="number" name="rep" placeholder="Rep"
                                                    class="input input-bordered w-full" value="{{ $exercise->pivot->rep }}"
                                                    onchange="saveExercise(this, {{ $exercise->id }}, {{ $dayIndex }}, {{ $index + 1 }})">
                                            </td>
                                            <td class="px-4 py-2"><input type="number" name="break_time"
                                                    placeholder="Break" class="input input-bordered w-full"
                                                    value="{{ $exercise->pivot->break }}"
                                                    onchange="saveExercise(this, {{ $exercise->id }}, {{ $dayIndex }}, {{ $index + 1 }})">
                                            </td>
                                            <td class="px-4 py-2"><input type="number" name="weight" placeholder="Weight"
                                                    class="input input-bordered w-full"
                                                    value="{{ $exercise->pivot->weight }}"
                                                    onchange="saveExercise(this, {{ $exercise->id }}, {{ $dayIndex }}, {{ $index + 1 }})">
                                            </td>
                                            <td class="px-4 py-2 text-center"><button type="button"
                                                    class="btn btn-circle btn-outline"
                                                    onclick="removeExercise(this, '{{ $exercise->pivot->id }}')">X</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    <nav>
                        <ul class="pagination flex overflow-x-scroll py-5">
                            @for ($i = 1; $i <= count($days); $i++)
                                <li class="mx-1">
                                    <button type="button" class="btn btn-outline"
                                        onclick="showDay({{ $i }})">Day {{ $i }}</button>
                                </li>
                            @endfor
                        </ul>
                    </nav>
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
                    body: JSON.stringify({
                        name,
                        description
                    })
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
            exerciseDiv.setAttribute("data-aos", "fade-up");
            exerciseCounts[dayIndex] = (exerciseCounts[dayIndex] || 0) + 1;
            const exerciseCount = exerciseCounts[dayIndex];

            exerciseDiv.innerHTML = `
        <td class="px-4 py-2 text-center">${exerciseCount}</td>
        <td class="px-4 py-2">${exerciseName}</td>
        <input type="hidden" name="exercise_program_id" value="">
        <input type="hidden" name="exercise_id" value="${exerciseId}">
        <td class="px-4 py-2"><input type="number" name="rep" placeholder="Rep" class="input input-bordered w-full" onchange="saveExercise(this, ${exerciseId}, ${dayIndex}, ${exerciseCount})"></td>
        <td class="px-4 py-2"><input type="number" name="break_time" placeholder="Break" class="input input-bordered w-full" onchange="saveExercise(this, ${exerciseId}, ${dayIndex}, ${exerciseCount})"></td>
        <td class="px-4 py-2"><input type="number" name="weight" placeholder="Weight" class="input input-bordered w-full" onchange="saveExercise(this, ${exerciseId}, ${dayIndex}, ${exerciseCount})"></td>
        <td class="px-4 py-2 text-center"><button type="button" class="btn btn-circle btn-outline" onclick="removeExercise(this, '')">X</button></td>
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

            const url = exerciseProgramId ? `/programs/${programId}/exercises/${exerciseProgramId}` :
                `/programs/${programId}/exercises`;
            const method = exerciseProgramId ? 'PUT' : 'POST';

            fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        day: dayIndex,
                        exercise_id: exerciseId,
                        order: order,
                        rep: rep,
                        break_time: breakTime,
                        weight: weight
                    })
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
            dayDiv.classList.add('space-y-2', 'day-div');
            dayDiv.style.display = 'none';
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
            <tbody id="exercise-list-${dayCount}" class="">
                <!-- Placeholder for dynamically added exercises -->
            </tbody>
        </table>
    `;
            document.getElementById('day-container').appendChild(dayDiv);
            updatePagination();
        }



        function showDay(dayIndex) {
            document.querySelectorAll('.day-div').forEach((dayDiv, index) => {
                if (index + 1 === dayIndex) {
                    dayDiv.style.display = 'block';
                    dayDiv.querySelector('input[name="selected_day"]').checked = true;
                } else {
                    dayDiv.style.display = 'none';
                }
            });

            document.querySelectorAll('.pagination button').forEach((button, index) => {
                if (index + 1 === dayIndex) {
                    button.classList.add('bg-accent', 'text-white');
                } else {
                    button.classList.remove('bg-accent');
                }
            });
        }


        function updatePagination() {
            const pagination = document.querySelector('.pagination');
            pagination.innerHTML = '';
            for (let i = 1; i <= dayCount; i++) {
                const li = document.createElement('li');
                li.classList.add('mx-1');
                li.innerHTML = `<button type="button" class="btn btn-outline" onclick="showDay(${i})">Day ${i}</button>`;
                pagination.appendChild(li);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('programArea').classList.remove('hidden');
            updatePagination();
            showDay(1);
        });

        function toggleStatus() {
            const status = document.getElementById('status').checked ? 1 : 0;

            fetch(`/programs/${programId}/toggle-status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        status: status
                    })
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
