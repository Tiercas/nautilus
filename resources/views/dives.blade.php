<x-layout>
    <link rel="stylesheet" href="/css/drop-down.css">
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
                        <a href='/dives/{{$dive->DS_CODE}}'>
                            @if($userPre->PRE_MAX_DEPTH>$dive->DS_MAX_DEPTH)
                                <x-button color="bg-green-700" colorHover="hover:bg-green-800">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                    </svg>
                                </x-button>
                            @endif
                        </a>
                        <x-button diveId="dropdownButton-{{$dive->DS_CODE}}">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                <path
                                    d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                            </svg>
                        </x-button>
                        @if ($errors->any())
                            <div class="text-red-400">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        @if (Session::has('DS_CODE') && Session::get('DS_CODE') == $dive->DS_CODE)
                                            <li>{{ $error }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (Session::has('Success') && Session::get('DS_CODE') == $dive->DS_CODE)
                            <div class="text-green-500">{{ Session::get('Success') }}</div>
                        @endif
                    </td>
                </tr>
                <x-drop-down id="dropdown{{$dive->DS_CODE}}">
                    @php
                    $participants = $dive->getParticipants();
                    @endphp
                    <div class="drop-down">
                    @foreach($participants as $user)
                        <p class = "drop-down-items">{{$user->US_NAME}} {{$user->US_FIRST_NAME}}</p>
                    @endforeach
                    </div>
                </x-drop-down>
            @endforeach
            </tbody>
        </table>
    </div>

    <div id="toast-default"
    class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
            role="alert" style="background-color: var(--badDarker);color: wheat;">
            <div class="ms-3 text-sm font-normal"><i class="fa-solid fa-triangle-exclamation" style="margin-right: 10px"></i> Attention, une erreur !</div>
            <button type="button" style="background-color: var(--badDarker);color: wheat;"
            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-default" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    <script type="text/javascript" src="/js/drop-down.js"></script>
</x-layout>
