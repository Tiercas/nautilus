<x-layout>
    <link rel="stylesheet" href="/css/drop-down.css">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <div>
        <div id="Historique">
            <x-page-title hrSize="30%">Liste des plongées</x-page-title>
            <table style="text-align: left">
                <thead class="text-xs text-gray-700 bg-gray-50" style="border-bottom: 1px solid black; font-size: 15px;">
                    <tr>
                        <th scope="col" class="px-12 py-3">Date</th>
                        <th scope="col" class="px-12 py-3">Plage horaire</th>
                        <th scope="col" class="px-12 py-3">Profondeur</th>
                        <th scope="col" class="px-12 py-3">Lieu</th>
                        <th scope="col" class="px-12 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dives as $dive)
                        <tr class="odd:bg-white even:bg-gray-50">
                            <td class="px-12 py-4">{{ $dive->DS_DATE }}</td>
                            <td class="px-12 py-4">{{ $dive->CAR_SCHEDULE }}</td>
                            <td class="px-12 py-4">{{ $dive->DL_DEPTH }}m</td>
                            <td class="px-12 py-4">{{ $dive->DL_NAME }}</td>
                            <td class="px-12 py-4">
                                <x-button diveId="dropdownButton-{{ $dive->DS_CODE }}">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                        <path
                                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                                    </svg>
                                </x-button>
                                <a href='/dives/{{ $dive->DS_CODE }}'>
                                    @if ($userPre->PRE_MAX_DEPTH > $dive->DS_MAX_DEPTH)
                                        <x-button color="bg-green-700" colorHover="hover:bg-green-800">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M1 5.917 5.724 10.5 15 1.5" />
                                            </svg>
                                        </x-button>
                                    @endif
                                </a>
                                @if ($userPre->PRE_MAX_DEPTH <= $dive->DS_MAX_DEPTH)
                                    <div class="text-red-400">
                                        <p>Vous n'avez pas le niveau requis</p>
                                    </div>
                                @endif
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
                        <x-drop-down id="dropdown{{ $dive->DS_CODE }}">
                            @php
                                $participants = $dive->getParticipants();
                            @endphp
                            <div class="drop-down">
                                @foreach ($participants as $user)
                                    <p class = "drop-down-items">{{ $user->US_NAME }} {{ $user->US_FIRST_NAME }} <span class = "text-gray-500">- {{ $user->PRE_CODE }}</span></p>
                                @endforeach
                            </div>
                        </x-drop-down>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <script type="text/javascript" src="/js/drop-down.js"></script>
</x-layout>
