<x-layout>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/create_div.css') }}">

    <div style="display : flex; flex-direction: row">
        <div style="width: 50%; margin-right: 50px; height: 100%; display:flex; align-items: center; flex-direction: column">
            <img src="{{ asset('/images/Diver1.png') }}" alt="Diver illustration">
        </div>

        <form action="/dive/update/{{$dive->DS_CODE}}" method="POST" style="width: 70%;">
            <h1 class="text-4xl"
            style="font-family: 'Space Grotesk', sans-serif; font-weight: bold; margin-bottom: 30px;">Modification d'une
            plongée</h1>
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
                            <div>
                                <input disabled type="date" name="day" id="dayInput"
                                    style="border: 2px solid black;border-radius: 10px;padding: 7px;" value="{{$dive->DS_DATE}}">
                            </div>
                            <div style="margin-top: 15px;">
                                <select name="hour" id="hour" style="width: 100px; margin-bottom: 15px; margin-left: 20px;" disabled>
                                    <option value="Matin">Matin</option>
                                    <option value="Apres-midi">Après midi</option>
                                    <option value="Soir">Soir</option>
                                </select>
                            </div>
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
                            <select name="location" id="locationInput" style="width: 200px;">
                                @foreach ($locations as $location)
                                    @if ($location->DL_ID == $dive->DL_ID)
                                        <option value="{{ $location->DL_ID }}" selected>{{ $location->DL_NAME }}</option>
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
                            <label for="maxInput">Maximum :</label>
                        </div>
                        <div class="divideFlexBig Column">
                            @if (isset($precedent))
                                <input required type="number" name="max" id="maxInput" min="0" placeholder="0"
                                    style="width: 20%;-moz-appearance: textfield;text-align: center;"
                                    value="{{ $precedent->DS_MAX_DIVERS }}">
                            @else
                                <input required type="number" name="max" id="maxInput" min="0"
                                    placeholder="0" value="{{$dive->DS_MAX_DIVERS}}"
                                    style="width: 20%;-moz-appearance: textfield;text-align: center;">
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
                            <select name="boat" id="boatInput" style="width: 200px;">
                                @foreach ($boats as $boat)
                                    @if ($boat->BO_ID == $dive->BO_ID)
                                        <option value="{{ $boat->BO_ID }}" selected>{{ $boat->BO_NAME }}</option>
                                    @else
                                        <option value="{{ $boat->BO_ID }}">{{ $boat->BO_NAME }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <select name="level" id="levelInput" style="width: 230px; margin-bottom: 15px;">
                                @foreach ($levels as $level)
                                    @if($level->PRE_CODE == $dive->PRE_CODE)
                                        <option value="{{ $level->PRE_CODE }}" selected>{{ $level->PRE_CODE }}</option>
                                    @else
                                        <option value="{{ $level->PRE_CODE }}">{{ $level->PRE_CODE }}</option>
                                    @endif
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
                            <select name="security" id="securityInput">
                                @foreach ($users as $user)
                                    @if ($user->hasRole('SEC'))
                                        @if ($user->US_ID == $dive->US_ID)
                                            <option value="{{ $user->US_ID }}" selected />{{ $user->US_NAME }} {{ $user->US_FIRST_NAME }}</option>
                                        @else
                                            <option value="{{ $user->US_ID }}" />{{ $user->US_NAME }} {{ $user->US_FIRST_NAME }}</option>
                                        @endif
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
                            <select name="manager" id="managerInput">
                                @foreach ($users as $user)
                                    @if ($user->hasRole('DIR'))
                                        @if ($user->US_ID == $dive->US_ID)
                                            <option value="{{ $user->US_ID }}" selected />{{ $user->US_NAME }} {{ $user->US_FIRST_NAME }}</option>
                                        @else
                                           <option value="{{ $user->US_ID }}" />{{ $user->US_NAME }} {{ $user->US_FIRST_NAME }}</option>
                                        @endif
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
                            <select name="pilot" id="pilotInput">
                                @foreach ($users as $user)
                                    @if ($user->hasRole('PIL'))
                                        @if ($user->US_ID == $dive->US_ID)
                                            <option value="{{ $user->US_ID }}" selected />{{ $user->US_NAME }} {{ $user->US_FIRST_NAME }}</option>
                                        @else
                                            <option value="{{ $user->US_ID }}" />{{ $user->US_NAME }} {{ $user->US_FIRST_NAME }}</option>
                                        @endif
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
                        type="submit" value="Mettre à jour">
                </div>
                <form method="POST" action="/dive/disable/{{$dive->DS_CODE}}">
                    @csrf
                    <div class="w-full px-3 mb-5">
                        <input
                            class="clickableDelete clickable block w-full max-w-xs mx-auto bg-red-400 hover:bg-red-500 focus:bg-red-500 text-black rounded-lg px-3 py-3 font-semibold"
                            type="submit" value="Supprimer">
                    </div>
                </form>
            </div>
        </form>
    </div>

    <script src="{{ asset('/js/create_div.js') }}"></script>
</x-layout>
