<x-layout>

    <link rel="stylesheet" href="../css/app.css">

    <div style="display : flex; flex-direction: row">
        <div style="width: 50%; margin-right: 50px; height: 100%; display:flex; align-items: center; flex-direction: column">
            @if(!isset($precedent))
                <img src="{{ asset('/images/Diver1.png') }}" alt="Diver illustration">
            @else
                <p>Plongées crées</p>
                <table>
                    <tr>
                        <th>Date et heure</th>
                        <th>Nombre maximum d'inscrits</th>
                        <th>Site</th>
                        <th>Niveau requis</th>
                    </tr>
                    @foreach ($precedent as $dive)
                        <tr>
                            <td>{{ $dive->DS_DATE }}</td>
                            <td>{{ $dive->DS_MAX_DIVERS }}</td>
                            <td>{{ $dive->DL_NAME }}</td>
                            <td>{{ $dive->PRE_CODE }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
        <form action="/create/dive" method="POST" style="width: 70%;font-size: 20px;">
            @csrf
            <h1 class="text-4xl"
                style="font-family: 'Space Grotesk', sans-serif; font-weight: bold; margin-bottom: 30px;">Création d'une
                plongée</h1>
            <div style="display: flex;">
                <div style="width: 58%; margin-bottom: 40px;margin-top: 40px;">
                    <h2>Nombres d'inscrits</h2>
                    <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px; width : 50%">
                    <div style="display: flex; margin-bottom: 15px">
                        <div style="margin-right: 20px;">
                            <label for="maxInput">Minimum : </label>
                            <input type="number" name="max" id="maxInput" min="0" placeholder="0"
                                style="width: 40px;border: 2px solid black;border-radius: 7px;-moz-appearance: textfield;text-align: center;">

                        </div>
                        <div>
                            <label for="minInput">Maximum : </label>
                            @if(isset($precedent))
                                <input type="number" name="max" id="maxInput" min="0" placeholder="0"
                                    style="width: 42px;border: 2px solid black;border-radius: 7px;-moz-appearance: textfield;text-align: center;" value="{{ $precedent->DS_MAX_DIVERS }}">
                            @else
                            <input type="number" name="max" id="maxInput" min="0" placeholder="0"
                                style="width: 42px;border: 2px solid black;border-radius: 7px;-moz-appearance: textfield;text-align: center;">
                            @endif
                        </div>
                    </div>
                    <label for="levelInput">Niveau requis : </label>
                    <select name="level" id="levelInput" style="width: 260px; margin-bottom: 15px;">
                        @foreach ($levels as $level)
                            <option value="{{ $level->PRE_CODE }}">{{ $level->PRE_CODE }}</option>
                        @endforeach
                    </select>
                    <label for="levelInput">Niveau : </label>
                        @if(isset($precedent))
                            <input type="number" name="level" id="levelInput" min=1 max=4 style="width: 40px;border: 2px solid black;border-radius: 7px;-moz-appearance: textfield;text-align: center;" placeholder="0" value="{{$precedent->DS_LEVEL}}">
                        @else
                            <input type="number" name="level" id="levelInput" min=1 max=4 style="width: 40px;border: 2px solid black;border-radius: 7px;-moz-appearance: textfield;text-align: center;" placeholder="0">
                        @endif
                    <br>
                    <label for="maxDepth">Profondeur maximum : </label>
                    <input type="number" min=1 name="maxDepth" id="maxDepth" style="width: 40px;border: 2px solid black;border-radius: 7px;-moz-appearance: textfield;text-align: center;" placeholder="0">
                </div>
                <div style="width: 40%;margin-bottom: 40px;margin-top: 40px;">
                    <h2>Créneau</h2>
                    <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px; width : 100%">
                    <div style="display: flex;flex-direction: column;">
                        <div>
                            <label for="dayInput">Jour : </label>
                            @if(isset($precedent))
                                <input type="date" name="day" id="dayInput"
                                    style="border: 2px solid black;border-radius: 10px;padding: 7px;" value="{{ $precedent->DS_DATE }}">
                            @else
                                <input type="date" name="day" id="dayInput"
                                    style="border: 2px solid black;border-radius: 10px;padding: 7px;">
                            @endif
                        </div>
                        <div style="margin-top: 15px;">
                            <label for="hourInput">Heure de début</label>
                            <select name="hour" id="hour" style="width: 160px; margin-bottom: 15px;">
                                <option value="Matin">Matin</option>
                                <option value="Apres-midi">Après midi</option>
                                <option value="Soir">Soir</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="height: 3px;background-color: black;margin-bottom: 30px;margin-top: 5px; width : 50%;">
            <div style="display: flex; margin-bottom: 50px;">
                <div style="width: 50%">
                    <label for="locationInput" style="margin-right: 20px;">Site : </label>
                    <select name="location" id="locationInput" style="width: 200px;">
                        @foreach ($locations as $location)
                            @if(isset($precedent))
                                @if($location->DL_ID == $precedent->DL_ID)
                                    <option value="{{ $location->DL_ID }}" selected>{{ $location->DL_NAME }}</option>
                                @else
                                    <option value="{{ $location->DL_ID }}">{{ $location->DL_NAME }}</option>
                                @endif
                            @else
                                <option value="{{ $location->DL_ID }}">{{ $location->DL_NAME }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div style="width: 50%">
                    <label for="boatInput" style="margin-right: 20px;">Bateau : </label>
                    <select name="boat" id="boatInput" style="width: 200px;">
                        @foreach ($boats as $boat)
                            @if(isset($precedent))
                                @if($location->BO_ID == $precedent->BO_ID)
                                    <option value="{{ $boat->BO_ID }}" selected>{{ $boat->BO_NAME }}</option>
                                @else
                                    <option value="{{ $boat->BO_ID }}">{{ $boat->BO_NAME }}</option>
                                @endif
                            @else
                                <option value="{{ $boat->BO_ID }}">{{ $boat->BO_NAME }}</option>
                            @endif

                        @endforeach
                    </select>
                </div>
            </div>
            <div style="display: flex; margin-bottom: 50px;">
                <div style="display: flex;flex-direction: column;width: 30%; margin-right: 2%; margin-bottom: 30px;">
                    <label for="securityInput">Sécurité de surface</label>
                    <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px;">
                    <select name="security" id="securityInput">
                        @foreach ($users as $user)
                            @if ($user->hasRole('SEC'))
                                <option value="{{ $user->US_ID }}" />{{ $user->US_NAME }} {{ $user->US_FIRST_NAME }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div style="display: flex;flex-direction: column;width: 30%; margin-right: 2%;">
                    <label for="managerInput">Directeur</label>
                    <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px;">
                    <select name="manager" id="managerInput">
                        @foreach ($users as $user)
                            @if ($user->hasRole('DIR'))
                                <option value="{{ $user->US_ID }}" />{{ $user->US_NAME }} {{ $user->US_FIRST_NAME }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div style="display: flex;flex-direction: column;width: 30%; margin-right: 2%;">
                    <label for="pilotInput">Pilote</label>
                    <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px;">
                    <select name="pilot" id="pilotInput">
                        @foreach ($users as $user)
                            @if ($user->hasRole('PIL'))
                                <option value="{{ $user->US_ID }}" />{{ $user->US_NAME }} {{ $user->US_FIRST_NAME }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex -mx-3" style="margin-top: 50px;">
                <div class="w-full px-3 mb-5">
                    <input
                        class="clickable block w-full max-w-xs mx-auto bg-yellow-400 hover:bg-yellow-500 focus:bg-yellow-500 text-black rounded-lg px-3 py-3 font-semibold"
                        type="submit" value="CREER">
                </div>
            </div>
            @if(isset($precedent))
                <div id="toast-default" class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                    <div class="ms-3 text-sm font-normal">Plongée crée !</div>
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-default" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            @endif
        </form>
    </div>
</x-layout>
