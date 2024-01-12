<x-layout>

    <link rel="stylesheet" href="/css/drop-down.css">
    <link rel="stylesheet" href="/css/button-filter.css">
            <x-page-title>Liste des plongées</x-page-title>

            <div class="container">
                <input type="checkbox" id="toggle" unchecked />
                <label class="button" for="toggle">
                    <svg class="change-my-color" xmlns="http://www.w3.org/2000/svg" height="19" width="19" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z"/></svg>
                <div class="nav">
                    <form action="{{ route('dives_filter') }}" method="POST">
                        @csrf
                    <ul>
                        <li>
                            <label for="location_filter" class="sr-only">Choisir un lieux</label>
                            <select id="location_filter" name="location_filter" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent appearance-none focus:outline-none focus:ring-0 focus:border-orange-600 peer">
                                <option selected value="default">Lieux</option>
                                @foreach ($locations as $dive)
                                    <option value="{{$dive->DL_NAME}}">{{$dive->DL_NAME}}</option>
                                @endforeach
                            </select>
                        </li>
                        <li>
                            <label for="creneau_filter" class="sr-only">Choisir un créneau</label>
                            <select id="creneau_filter" name="creneau_filter" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent appearance-none focus:outline-none focus:ring-0 focus:border-orange-600 peer">
                                <option selected value="default">Créneau</option>
                                <option value="matin">Matin</option>
                                <option value="apres-midi">Après-midi</option>
                                <option value="soir">Soir</option>
                            </select>
                        </li>
                        <li>
                            <label for="level_filter" class="sr-only">Choisir un niveau</label>
                            <select id="level_filter" name="level_filter" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent appearance-none focus:outline-none focus:ring-0 focus:border-orange-600 peer">
                                <option selected value="default">Niveau</option>
                                @foreach ($levels as $level)
                                    <option value="{{$level->PRE_MAX_DEPTH}}">{{$level->PRE_MAX_DEPTH}}</option>
                                @endforeach
                            </select>
                        </li>
                        <li>
                            <label class="hidden" for="start">Date de départ</label>
                            <input type="date" id="date_filter" name="date_filter"/>
                        </li>
                        <!--<li>
                            <label class="hidden" for="participant_filter">Participant</label>
                            <select id="participant_filter" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent appearance-none focus:outline-none focus:ring-0 focus:border-orange-600 peer">
                                <option selected>Niveau</option>
                                @foreach ($dives as $dive)
                                    <option value="{{$dive->CAR_SCHEDULE}}">{{$dive->DL_DEPTH}}</option>
                                @endforeach
                            </select>
                        </li>-->
                        <li class="hover:bg-transparent bg-transparent">
                            <button type="submit" class="w-full py-2.5 px-4 text-sm bg-gray-300 rounded-md focus:outline-none focus:bg-gray-400">
                                Rechercher
                            </button>
                        </li>
                    </ul>
                    </form>
                </div>
                </label>
            </div>

            <div class="shadow-md max-w-full rounded-lg overflow-hidden border-2">
                <table class="text-sm text-left text-gray-500 w-full">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-12 py-3">Date</th>
                        <th scope="col" class="px-12 py-3">Plage horaire</th>
                        <th scope="col" class="px-12 py-3">Profondeur</th>
                        <th scope="col" class="px-12 py-3">Lieu</th>
                        <th scope="col" class="px-12 py-3">Capacité</th>
                        <th scope="col" class="px-12 py-3">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($dives) == 0)
                        <tr class="odd:bg-white even:bg-gray-50 border-b">
                            <td class="px-6 py-4 text-center" colspan="5">Aucune plongée n'est disponible</td>
                        </tr>
                    @endif
                    @foreach ($dives as $dive)
                        @php
                            $participants = $dive->getParticipants();
                        @endphp
                        <tr class="odd:bg-white even:bg-gray-50">
                            <td class="px-12 py-4">{{ $dive->DS_DATE }}</td>
                            @if( $dive->CAR_SCHEDULE=='Matin')
                                <td class="px-12 py-4">9h</td>
                            @elseif ( $dive->CAR_SCHEDULE=='Apres-midi')
                                <td class="px-12 py-4">14h</td>
                            @else
                                <td class="px-12 py-4">18h</td>
                            @endif
                            <td class="px-12 py-4">{{ $dive->DL_DEPTH }}m</td>
                            <td class="px-12 py-4">{{ $dive->DL_NAME }}</td>
                                @if(isset($dive->DS_MAX_DIVERS))
                                    <td class="px-12 py-4 flex">
                                        {{ $dive->DS_DIVERS_COUNT }}/{{ $dive->DS_MAX_DIVERS }}
                                        <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>
                                    </td>
                                @else
                                    <td class="px-12 py-4 flex">
                                        {{ $dive->DS_DIVERS_COUNT }}/?
                                        <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>
                                    </td>
                                
                                @endif
                                
                            <td class="px-12 py-4">
                                <x-button diveId="dropdownButton-{{ $dive->DS_CODE }}">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                        <path
                                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                                    </svg>
                                </x-button>
                                    @if (in_array($user, $participants))
                                    <a href='/unsubscribe/{{ $dive->DS_CODE }}'>
                                        <x-button color="bg-red-700" colorHover="hover:bg-red-800">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3l10 10M13 3L3 13" />
                                            </svg>
                                        </x-button>
                                    </a>
                                    @else
                                        @if ($userPre->PRE_MAX_DEPTH > $dive->DS_MAX_DEPTH)
                                            <a href='/dives/{{ $dive->DS_CODE }}'>
                                                <x-button color="bg-green-700" colorHover="hover:bg-green-800">
                                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M1 5.917 5.724 10.5 15 1.5" />
                                                    </svg>
                                                </x-button>
                                            </a>
                                        @endif
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
