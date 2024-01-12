<x-layout>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <x-page-title>Gestion de mes plongées en tant que directeur</x-page-title>
    <div class="shadow-md max-w-full rounded-lg overflow-hidden border-2">
        <table class="text-sm text-left text-gray-500 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Date</th>
                    <th scope="col" class="px-6 py-3">Plage horaire</th>
                    <th scope="col" class="px-6 py-3">Profondeur</th>
                    <th scope="col" class="px-6 py-3">Lieu</th>
                    <th scope="col" class="px-12 py-3">Capacité</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dives as $dive)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-6 py-4">{{ $dive->DS_DATE }}</td>
                        @if ($dive->CAR_SCHEDULE == 'Matin')
                            <td class="px-12 py-4">9h</td>
                        @elseif ($dive->CAR_SCHEDULE == 'Apres-midi')
                            <td class="px-12 py-4">14h</td>
                        @else
                            <td class="px-12 py-4">18h</td>
                        @endif
                        <td class="px-6 py-4">{{ $dive->DL_DEPTH }}m</td>
                        <td class="px-6 py-4">{{ $dive->DL_NAME }}</td>
                        <td class="px-12 py-4 flex">
                            {{ $dive->DS_DIVERS_COUNT }}/{{ $dive->DS_MAX_DIVERS }}
                            <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" height="20" width="20"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z" />
                            </svg>
                        </td>
                        <td class="px-8 py-4">
                            <div class="Line">
                                <a href="{{ route('dives_show', ['id' => $dive->DS_CODE]) }}">
                                    <button style="margin-right: 5px;font-size: 35px;"
                                        class="clickableBlue aligne m-1 bg-gray-400 hover:bg-gray-500 
                                    text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                        <i class="fa-solid fa-clipboard-list" aria-hidden="true"></i>
                                    </button>
                                </a>
                                <a href="/modificationdives/members/{{ $dive['DS_CODE'] }}">
                                    <button diveId="dropdownButton-{{ $dive->DS_CODE }}"
                                        style="margin-right: 5px;background-color: var(--yellow);font-size: 35px;"
                                        class="clickable aligne m-1 bg-gray-400 hover:bg-gray-500 
                                    text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                        <i class="fa-solid fa-users"></i>
                                    </button>
                                </a>
                                <a href="/dive/update/{{ $dive['DS_CODE'] }}">
                                    <button diveId="dropdownButton-{{ $dive->DS_CODE }}"
                                        style="margin-right: 5px;font-size: 35px;"
                                        class="clickablePink aligne m-1 bg-gray-400 hover:bg-gray-500 
                                    text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
<script type="text/javascript" src="/js/drop-down.js"></script>
