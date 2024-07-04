<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercises List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">List of Exercises by Muscle</h1>

    @foreach ($muscles as $muscle)
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-blue-600">{{ $muscle->name }})</h2>
            <ul class="list-disc list-inside mt-4">
                @foreach ($muscle->exercises as $exercise)
                    <li class="bg-white p-4 rounded-lg shadow mb-2">
                        <div class="flex items-center">
                            <img src="{{ $exercise->image }}" alt="{{ $exercise->name }}" class="w-32 h-32 mb-4">
                            <div>
                                <h3 class="text-xl font-bold">{{ $exercise->name }}</h3>
                                <a href="{{ $exercise->image }}" class="text-blue-500 hover:underline" target="_blank">Watch Video</a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>

</body>
</html>
