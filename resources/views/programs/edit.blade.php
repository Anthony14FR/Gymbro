@extends('layouts.app')

@section('content')
    <div class="flex justify-between md:flex-row md:space-y-0 space-y-10 flex-col mb-6 p-3">
        <div class="breadcrumbs text-sm">
            <h1 class="text-4xl font-normal">{{ $program->exists ? 'Edit Program' : 'Create Program' }} <i class="fa-solid fa-pen ml-2 fa-xs"></i></h1>
            {!! Breadcrumbs::render() !!}
        </div>
    </div>
    <form id="programForm" class="space-y-8 w-full p-5 bg-base-300 edit-programs-form space-y-5">
        @csrf
        @if ($program->exists)
            @method('PUT')
        @else
            @method('POST')
        @endif
        <div class="flex md:flex-row flex-col md:space-x-10 w-full items-center">
            <div class="w-full">
                <label for="name" class="block text-lg font-medium">Nom</label>
                <input type="text" name="name" id="name" class="input rounded-none input-bordered w-full"
                    value="{{ '' ?? $program->name }}" placeholder=". . ." required>
            </div>
            <div class="w-full">
                <label for="description" class="block text-lg font-medium">Description</label>
                <input name="description" id="description" value="{{ '' ?? $program->description }}" placeholder=". . ."
                    class="input rounded-none input-bordered w-full" required>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <img src="{{ asset($program->image) }}" alt="{{ $program->name }}" class="w-32 h-32 rounded shadow-lg mb-2"
                id="programImage">
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
            <div class="swap-on flex rounded bg-accent/20 p-3 items-center">Public <i
                    class="ml-2 fa-solid fa-lock-open"></i>
            </div>
            <div class="swap-off flex bg-neutral rounded p-3 items-center">Private <i class="ml-2 fa-solid fa-lock"></i>
            </div>
        </label>
    </form>
    <div class="drawer lg:hidden flex z-40">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-side">
            <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
                <span class="font-semibold text-3xl">Exercice <i class="fa-solid fa-dumbbell ml-2"></i></span>
                <input type="text" id="search" class="input input-bordered w-full mt-2 mb-4"
                    placeholder="Search exercise" oninput="filterExercises()">
                @foreach ($exercises as $exercise)
                    <li>
                        <div onclick="addExercise('{{ $exercise->id }}', '{{ $exercise->name }}')"
                            class="flex mb-5 flex-row active:scale-[0.9] items-center px-4 bg-base-200 rounded-xl shadow-sm w-full cursor-pointer hover:bg-accent/60 transition duration-200 ease-in-out exercise-item">
                            <div class="avatar">
                                <div class="ring-accent ring-offset-base-100 w-8 rounded-full ring ring-offset-2">
                                    <img src="{{ asset($exercise->image) }}" alt="{{ $exercise->name }}"
                                        class="rounded-full mr-2">
                                </div>
                            </div>
                            <span class="ml-6 text-white">{{ $exercise->name }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div id="programArea" class="mb-16 overflow-x-hidden flex gap-8 {{ $program->exists ? '' : 'hidden' }}">
        <div class="lg:flex hidden justify-between bg-base-300 rounded-xl mt-8 lg:w-3/12">
            <div class="flex flex-col w-full">
                <div class="p-4">
                    <span class="font-semibold">Exercice <i class="fa-solid fa-dumbbell ml-2"></i></span>
                    <input type="text" id="search" class="input input-bordered w-full mt-2 mb-4"
                        placeholder="Search exercise" oninput="filterExercises()">
                </div>
                <div class="h-[650px] overflow-y-scroll p-4">
                    @foreach ($exercises as $exercise)
                        <div onclick="addExercise('{{ $exercise->id }}', '{{ $exercise->name }}')"
                            class="flex mb-5 flex-row active:scale-[0.9] items-center px-4 bg-base-200 rounded-xl shadow-sm w-full cursor-pointer hover:bg-accent/60 transition duration-200 ease-in-out exercise-item">
                            <div class="avatar">
                                <div class="ring-accent ring-offset-base-100 my-2 w-8 rounded-full ring ring-offset-2">
                                    <img src="{{ asset($exercise->image) }}" alt="{{ $exercise->name }}"
                                        class="rounded-full mr-2">
                                </div>
                            </div>
                            <span class="ml-6 text-white">{{ $exercise->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex flex-col mt-8 w-full lg:w-9/12">
            <div class="p-4 flex flex-col justify-between bg-base-200 rounded-md space-y-4">
                <div id="day-container" class="space-y-2 p-4">
                    @foreach ($days as $dayIndex => $exercises)
                        <div class="space-y-2 day-div" style="display: {{ $dayIndex == 1 ? 'block' : 'none' }}">
                            <div class="flex justify-between items-center mb-8">
                                <div class="text-4xl font-bold mb-2 ml-3 flex items-center z-1">
                                    <span class="mr-4">Day {{ $dayIndex }}</span>
                                    <label for="my-drawer" class="btn btn-accent drawer-button lg:hidden">Exercice <i
                                            class="fa-solid fa-fire-flame-simple"></i></label>
                                </div>
                                <button type="button" class="btn btn-outline mb-4" onclick="addDay()">Add Day</button>
                                <input type="radio" name="selected_day" value="{{ $dayIndex }}"
                                    class="form-radio hidden" {{ $dayIndex == 1 ? 'checked' : '' }}>
                            </div>
                            <div class="overflow-y-scroll h-[550px]">
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
                                                <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                                                <td class="px-4 py-2">{{ $exercise->name }}</td>
                                                <input type="hidden" name="exercise_program_id"
                                                    value="{{ $exercise->pivot->id }}">
                                                <input type="hidden" name="exercise_id" value="{{ $exercise->id }}">
                                                <td class="px-4 py-2"><input type="number" name="rep"
                                                        placeholder="Rep" class="input input-bordered w-full"
                                                        value="{{ $exercise->pivot->rep }}"
                                                        onchange="saveExercise(this, {{ $exercise->id }}, {{ $dayIndex }}, {{ $index + 1 }})">
                                                </td>
                                                <td class="px-4 py-2"><input type="number" name="break_time"
                                                        placeholder="Break" class="input input-bordered w-full"
                                                        value="{{ $exercise->pivot->break }}"
                                                        onchange="saveExercise(this, {{ $exercise->id }}, {{ $dayIndex }}, {{ $index + 1 }})">
                                                </td>
                                                <td class="px-4 py-2"><input type="number" name="weight"
                                                        placeholder="Weight" class="input input-bordered w-full"
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
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    <nav>
                        <ul class="pagination flex overflow-x-scroll py-5">
                            @for ($i = 1; $i <= count($days); $i++)
                                <li class="mx-1">
                                    <button type="button" class="btn btn-neutral"
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
        <div class="flex justify-between items-center mb-8">
            <div class="text-4xl font-bold mb-2 ml-3 flex items-center z-1">
                <span class="mr-4">Day ${dayCount}</span>
                <label for="my-drawer" class="btn btn-accent drawer-button lg:hidden">Exercice <i class="fa-solid fa-fire-flame-simple"></i></label>
            </div>
            <button type="button" class="btn btn-outline mb-4" onclick="addDay()">Add Day</button>
            <input type="radio" name="selected_day" value="${dayCount}" class="form-radio hidden">
        </div>
        <div class="overflow-y-scroll h-[550px]">
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
                </tbody>
            </table>
        </div>
    `;
            document.getElementById('day-container').appendChild(dayDiv);
            updatePagination();
            showDay(dayCount);
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
                    button.classList.add('bg-black/30', 'text-white');
                } else {
                    button.classList.remove('bg-black/30');
                }
            });
        }

        function updatePagination() {
            const pagination = document.querySelector('.pagination');
            pagination.innerHTML = '';
            for (let i = 1; i <= dayCount; i++) {
                const li = document.createElement('li');
                li.classList.add('mx-1');
                li.innerHTML = `<button type="button" class="btn btn-neutral" onclick="showDay(${i})">Day ${i}</button>`;
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

        function filterExercises() {
            const searchInput = document.getElementById('search').value.toLowerCase();
            const exerciseItems = document.querySelectorAll('.exercise-item');
            exerciseItems.forEach(item => {
                const exerciseName = item.querySelector('span').innerText.toLowerCase();
                if (exerciseName.includes(searchInput)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
    @if (!$program->exists || $days->isEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                addDay();
            });
        </script>
    @endif
@endsection
