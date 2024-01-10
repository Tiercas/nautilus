<x-layout>
    <link rel="stylesheet" href="../css/app.css">

    <div style="display : flex; flex-direction: row">
        <div style="width: 50%; margin-right: 50px; height: 100%; display:flex; align-items: center; flex-direction: column">
            <img src="{{ asset('/images/Diver1.png') }}" alt="Diver illustration">
        </div>
        <form action="/dive/update/{{$dive->DS_CODE}}" method="POST" style="width: 70%;font-size: 20px;">
            @csrf
            <h1 class="text-4xl"
                style="font-family: 'Space Grotesk', sans-serif; font-weight: bold; margin-bottom: 30px;">Modification d'une
                plongée</h1>
            <div style="display: flex">
                <div style="width: 50%">
                    <label for="locationInput" style="margin-right: 20px;">Site : </label>
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
                <div style="width: 50%">
                    <label for="boatInput" style="margin-right: 20px;">Bateau : </label>
                    <select name="boat" id="boatInput" style="width: 200px;">
                        @foreach ($boats as $boat)
                            @if ($boat->BO_ID == $dive->BO_ID)
                                <option value="{{ $boat->BO_ID }}" selected>{{ $boat->BO_NAME }}</option>
                            @else
                                <option value="{{ $boat->BO_ID }}">{{ $boat->BO_NAME }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div style="display: flex;">
                <div style="width: 58%; margin-bottom: 40px;margin-top: 40px;">
                    <h2>Nombres d'inscrits</h2>
                    <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px; width : 50%">
                    <div style="display: flex; margin-bottom: 15px">
                        <div style="margin-right: 20px;">
                            <label for="maxInput">Minimum : </label>
                            <input type="number" name="max" id="maxInput" min="0" placeholder="0" value="0"
                                style="width: 40px;border: 2px solid black;border-radius: 7px;-moz-appearance: textfield;text-align: center;">
                        </div>
                        <div>
                            <label for="minInput">Maximum : </label>
                            <input type="number" name="max" id="maxInput" min="0" placeholder="0" value="{{$dive->DS_MAX_DIVERS}}"
                                style="width: 42px;border: 2px solid black;border-radius: 7px;-moz-appearance: textfield;text-align: center;">
                        </div>
                    </div>
                    <label for="levelInput">Niveau requis : </label>
                    <select name="level" id="levelInput" style="width: 200px; margin-bottom: 15px; width : 150px">
                        @foreach ($levels as $level)
                            @if($level->PRE_CODE == $dive->PRE_CODE)
                                <option value="{{ $level->PRE_CODE }}" selected>{{ $level->PRE_CODE }}</option>
                            @else
                                <option value="{{ $level->PRE_CODE }}">{{ $level->PRE_CODE }}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="levelInput">Niveau : </label>
                    <input type="number" name="level" id="levelInput" min=1 max=4 style="width: 40px;border: 2px solid black;border-radius: 7px;-moz-appearance: textfield;text-align: center;" placeholder="0" value="{{$dive->DS_LEVEL}}">
                    <br>

                    <label for="maxDepth">Profondeur maximum : </label>
                    <input type="number" name="maxDepth" min=1 id="maxDepth" style="width: 40px;border: 2px solid black;border-radius: 7px;-moz-appearance: textfield;text-align: center;" placeholder="0" value="{{$dive->DS_MAX_DEPTH}}">
                </div>
                <div style="width: 40%;margin-bottom: 40px;margin-top: 40px;">
                    <h2>Créneau</h2>
                    <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px; width : 100%">
                    <div style="display: flex;flex-direction: column;">
                        <div>
                            <label for="dayInput">Jour : </label>
                            <input type="date" name="day" id="dayInput"
                                style="border: 2px solid black;border-radius: 10px;padding: 7px;" value="{{$dive->DS_DATE}}">
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
            <div style="display: flex;">
                <div style="display: flex;flex-direction: column;width: 30%; margin-right: 2%; margin-bottom: 30px;">
                    <label for="securityInput">Sécurité de surface</label>
                    <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px;">
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
                <div style="display: flex;flex-direction: column;width: 30%; margin-right: 2%;">
                    <label for="managerInput">Directeur</label>
                    <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px;">
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
                <div style="display: flex;flex-direction: column;width: 30%; margin-right: 2%;">
                    <label for="pilotInput">Pilote</label>
                    <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px;">
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
                            class="clickable block w-full max-w-xs mx-auto bg-red-400 hover:bg-red-500 focus:bg-red-500 text-black rounded-lg px-3 py-3 font-semibold"
                            type="submit" value="Supprimer">
                    </div>
                </form>
            </div>
    </form>
    </div>
</x-layout>