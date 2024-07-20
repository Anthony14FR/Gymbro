<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Queue & Jobs</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-200">

<div class="mx-auto max-w-screen-xl px-4 py-16 my-6">
    <div class="grid grid-cols lg:grid-cols-3 gap-2 mb-6">
        <div class="col-span-2 bg-white p-4 shadow rounded-md">
            <form action="{{url('send-mail')}}" method="post">
                @csrf
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="email">Mail To</label>
                    <input
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            id="email" placeholder="name@flowbite.com" type="email" name="mail_to" />
                    @error('mail_to')<small class="text-red-600 font-medium">{{$message}}</small>@enderror
                </div>
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="subject">Subject</label>
                    <input
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            id="subject" placeholder="Subject..." type="text" name="subject" />
                    @error('subject')<small class="text-red-600 font-medium">{{$message}}</small>@enderror
                </div>
                <div class="mb-5">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Message</label>
                    <textarea
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="message" rows="4" placeholder="Leave a message..." name="message"></textarea>
                    @error('message')<small class="text-red-600 font-medium">{{$message}}</small>@enderror
                </div>
                <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                    Send Message
                </button>
            </form>
        </div>
    </div>

    <div class="bg-blue-50 p-4 shadow rounded-md mb-6">
        <div class="flex justify-between items-center">
            <div class="mb-4 text-sm uppercase font-bold text-blue-700">
                Jobs
            </div>
            <div
                    class="mb-4 text-sm font-medium bg-blue-200 border border-blue-700 text-blue-900 px-3 py-1 rounded-md flex items-center">
                php artisan queue:work
            </div>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-white uppercase bg-blue-500">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Queue
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Payload
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Attempts
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Reserved At
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Available At
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created At
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($jobs as $job)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4">{{$job->queue}}</td>
                        <td class="px-6 py-4">{{$job->payload}}</td>
                        <td class="px-6 py-4">{{$job->attempts}}</td>
                        <td class="px-6 py-4">{{$job->reserved_at}}</td>
                        <td class="px-6 py-4">{{$job->available_at}}</td>
                        <td class="px-6 py-4">{{$job->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-red-50 p-4 shadow rounded-md mb-6">
        <div class="flex justify-between items-center">
            <div class="mb-4 text-sm uppercase font-bold text-red-700">
                Failed Jobs
            </div>
            <div
                    class="mb-4 text-sm font-medium bg-red-200 border border-red-700 text-red-900 px-3 py-1 rounded-md flex items-center">
                php artisan queue:retry all
            </div>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-white uppercase bg-red-500">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        UUID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Connection
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Queue
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Payload
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Exception
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Failed At
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($failedJobs as $failedJob)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4">{{$failedJob->uuid}}</td>
                        <td class="px-6 py-4">{{$failedJob->connection}}</td>
                        <td class="px-6 py-4">{{$failedJob->queue}}</td>
                        <td class="px-6 py-4">{{$failedJob->payload}}</td>
                        <td class="px-6 py-4">{{$failedJob->exception}}</td>
                        <td class="px-6 py-4">{{$failedJob->failed_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>