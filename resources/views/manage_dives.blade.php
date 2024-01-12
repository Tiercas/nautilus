<x-layout>
    <link rel="stylesheet" href="/css/drop-down.css">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

    <x-page-title>Liste des plongées</x-page-title>
    <div class="shadow-md max-w-full rounded-lg overflow-hidden border-2">
        <table class="text-sm text-left text-gray-500 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Date</th>
                <th scope="col" class="px-6 py-3">Plage horaire</th>
                <th scope="col" class="px-6 py-3">Profondeur</th>
                <th scope="col" class="px-6 py-3">Lieu</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($dives as $dive)
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <td class="px-6 py-4">{{ $dive->DS_DATE }}</td>
                    <td class="px-6 py-4">{{ $dive->CAR_SCHEDULE }}</td>
                    <td class="px-6 py-4">{{ $dive->DL_DEPTH }}m</td>
                    <td class="px-6 py-4">{{ $dive->DL_NAME }}</td>
                    <td class="px-8 py-4">
                        <a href='/dive/update/{{$dive->DS_CODE}}'>
                            <x-button color="bg-green-700" colorHover="hover:bg-green-800">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                            </x-button>
                        </a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>

    <!-- <div id="toast-default"
    class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
            role="alert" style="background-color: var(--badDarker);color: white;">
            <div class="ms-3 text-sm font-normal"><i class="fa-solid fa-triangle-exclamation" style="margin-right: 10px"></i> Attention, une erreur !</div>
            <button type="button" style="background-color: var(--badDarker);color: white;"
            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-default" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div> -->
    <script type="text/javascript" src="/js/drop-down.js"></script>
</x-layout>
