<x-layout>

    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/create_div.css') }}">

    <div style="display : flex; flex-direction: row">
        <div
            style="width: 50%; margin-right: 50px;display:flex; align-items: center; flex-direction: column;overflow: auto;">
            @if (isset($previousDives))
                <div id="Historique">
                    <p style="font-size: 35px">Historique de plongées crées</p>
                    <hr
                        style="height: 3px;background-color: black;margin-left: 10%;margin-bottom: 15px;margin-top: 5px; width : 80%">
                    <table class="arrayhistory">
                        <tr class="history">
                            <th>Date</th>
                            <th class="thresize">Max personnes</th>
                            <th style="width: 25%;">Site</th>
                            <th>Niveau</th>
                            <th>Actions</th>
                        </tr>
                        @foreach ($previousDives as $dive)
                            <tr class="historyLine">
                                <td>{{ $dive->DS_DATE }}</td>
                                <td>{{ $dive->DS_MAX_DIVERS }}</td>
                                @foreach ($locations as $location)
                                    @if ($location->DL_ID == $dive->DL_ID)
                                        <td>{{ $location->DL_NAME }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $dive->PRE_CODE }}</td>
                                <td>
                                    <form action="/dive/delete/{{ $dive->DS_CODE }}" method="POST">@csrf<button
                                            type="submit" class="clickable clickableRed"><i
                                                class="fa-solid fa-xmark"></i></button></form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @else
                <img src="{{ asset('/images/Diver1.png') }}" alt="Diver illustration" id="imageDiver">
            @endif
        </div>
        <form action="/create/dive" method="POST" style="width: 70%;">
            @csrf
            <x-page-title hrSize="70%">Création d'une plongée</x-page-title>
            <div class="Line">
                <div class="divideFlex Column">
                    <h2>Créneau</h2>
                    <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px; width : 40%">
                    <div class="aligne">
                        <div class="divideFlexSmall Column">
                            <label for="dayInput">Jour : </label>
                            <label for="hourInput">Heure de début :</label>
                        </div>
                        <div class="divideFlexBig Column">
                            @if (isset($precedent))
                                <input class="inputTime" required type="date" name="day" id="dayInput"
                                    value="{{ $precedent->DS_DATE }}">
                            @else
                                <input class="inputTime" required type="date" name="day" id="dayInput"
                                    min="<?php echo date('Y-m-d'); ?>" max="" />
                            @endif
                            <select required name="hour" id="hour" style="width: 160px; margin-bottom: 15px;">
                                <option value="Matin">Matin</option>
                                <option value="Apres-midi">Après midi</option>
                                <option value="Soir">Soir</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="divideFlex Column">
                    <h2>Lieu</h2>
                    <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px; width : 40%">
                    <div class="aligne">
                        <div class="divideFlexSmall Column">
                            <label for="locationInput" style="margin-right: 20px;">Site :</label>
                        </div>
                        <div class="divideFlexBig Column">
                            <select required name="location" id="locationInput">
                                @foreach ($locations as $location)
                                    @if (isset($precedent))
                                        @if ($location->DL_ID == $precedent->DL_ID)
                                            <option value="{{ $location->DL_ID }}" selected>{{ $location->DL_NAME }}
                                            </option>
                                        @else
                                            <option value="{{ $location->DL_ID }}">{{ $location->DL_NAME }}</option>
                                        @endif
                                    @else
                                        <option value="{{ $location->DL_ID }}">{{ $location->DL_NAME }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="Line">
                <div class="divideFlex Column">
                    <h2>Nombre de personnes</h2>
                    <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px; width : 60%">
                    <div class="aligne">
                        <div class="divideFlexSmall Column">
                            <label for="minInput">Minimum :</label>
                            <label for="maxInput">Maximum :</label>
                        </div>
                        <div class="divideFlexBig Column">
                            <input required type="number" name="min" id="minInput" min="0" placeholder="0"
                                style="width: 20%;-moz-appearance: textfield;text-align: center;">
                            @if (isset($precedent))
                                <input required type="number" name="max" id="maxInput" min="0"
                                    placeholder="0" style="width: 20%;-moz-appearance: textfield;text-align: center;"
                                    value="{{ $precedent->DS_MAX_DIVERS }}">
                            @else
                                <input required type="number" name="max" id="maxInput" min="0"
                                    placeholder="0" style="width: 20%;-moz-appearance: textfield;text-align: center;">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="divideFlex Column">
                    <h2>Transport et niveau</h2>
                    <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px; width : 60%">
                    <div class="aligne">
                        <div class="divideFlexSmall Column">
                            <label for="boatInput">Bateau :</label>
                            <label for="levelInput">Niveau requis :</label>
                        </div>
                        <div class="divideFlexBig Column">
                            <select required name="boat" id="boatInput">
                                @foreach ($boats as $boat)
                                    @if (isset($precedent))
                                        @if ($location->BO_ID == $precedent->BO_ID)
                                            <option value="{{ $boat->BO_ID }}" selected>{{ $boat->BO_NAME }}
                                            </option>
                                        @else
                                            <option value="{{ $boat->BO_ID }}">{{ $boat->BO_NAME }}</option>
                                        @endif
                                    @else
                                        <option value="{{ $boat->BO_ID }}">{{ $boat->BO_NAME }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <select required name="level" id="levelInput">
                                @foreach ($levels as $level)
                                    <option value="{{ $level->PRE_CODE }}">{{ $level->PRE_CODE }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="Line">
                <div class="divideFlex Column">
                    <h2>Sécurité de Surface</h2>
                    <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px; width : 60%">
                    <div class="aligne">
                        <div class="divideFlexBig Column">
                            <select required name="security" id="securityInput">
                                @foreach ($users as $user)
                                    @if ($user->hasRole('SEC'))
                                        <option value="{{ $user->US_ID }}" />{{ $user->US_NAME }}
                                        {{ $user->US_FIRST_NAME }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="divideFlex Column">
                    <h2>Directeur</h2>
                    <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px; width : 60%">
                    <div class="aligne">
                        <div class="divideFlexBig Column">
                            <select required name="manager" id="managerInput">
                                @foreach ($users as $user)
                                    @if ($user->hasRole('DIR'))
                                        <option value="{{ $user->US_ID }}" />{{ $user->US_NAME }}
                                        {{ $user->US_FIRST_NAME }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="divideFlex Column">
                    <h2>Pilote</h2>
                    <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px; width : 60%">
                    <div class="aligne">
                        <div class="divideFlexBig Column">
                            <select required name="pilot" id="pilotInput">
                                @foreach ($users as $user)
                                    @if ($user->hasRole('PIL'))
                                        <option value="{{ $user->US_ID }}" />{{ $user->US_NAME }}
                                        {{ $user->US_FIRST_NAME }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex -mx-3" style="margin-top: 50px;">
                <div class="w-full px-3 mb-5">
                    <input
                        class="clickable block w-full max-w-xs mx-auto bg-yellow-400 hover:bg-yellow-500 focus:bg-yellow-500 text-black rounded-lg px-3 py-3 font-semibold"
                        type="submit" value="CREER">
                </div>
            </div>
            @if (isset($error))
                <div id="toast-default"
                    class="flex items-center p-6 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                    role="alert" style="background-color: var(--badDarker);color: white;">
                    <div class="ms-3 text-sm font-normal"><i class="fa-solid fa-triangle-exclamation"
                            style="margin-right: 10px"></i> Attention, {{ $error }} !</div>
                    <button type="button" style="background-color: var(--badDarker);color: white;"
                        class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                        data-dismiss-target="#toast-default" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
            @if (isset($precedent))
                <div id="toast-default"
                    class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                    role="alert">
                    <div class="ms-3 text-sm font-normal">Plongée crée !</div>
                    <button type="button"
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
            @endif
        </form>
    </div>

    <script src="https://kit.fontawesome.com/8708952b61.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/js/create_dive.js"></script>
</x-layout>
