<x-layout>
    <x-page-title>Créer une plongée</x-page-title>
    <h1>Création d'une plongée</h1>
    <form action="/create/dive" method="POST">
        <div>
            <label for="locationInput">Site : </label>
            <select name="location" id="locationInput">
                @foreach ($locations as $location)
                    <option value="{{ $location->DL_ID }}">{{ $location->DL_NAME }}</option>
                @endforeach
            </select>
            <label for="boatInput">Bateau : </label>
            <select name="boat" id="boatInput">
                @foreach ($boats as $boat)
                    <option value="{{ $boat->BO_ID }}">{{ $boat->BO_NAME }}</option>
                @endforeach
            </select>
        </div>
        <h2>Nombres d'inscrits</h2>
        <div>
            <label for="maxInput">Nombre maximum d'inscrits : </label>
            <input type="number" name="max" id="maxInput">
            <label for="minInput">Nombre minimum d'inscrits : </label>
            <input type="number" name="max" id="maxInput">
            <label for="levelInput">Niveau requis : </label>
            <select name="level" id="levelInput">
                @foreach ($levels as $level)
                    <option value="{{ $level->PRE_CODE }}">{{ $level->PRE_CODE }}</option>
                @endforeach
            </select>
        </div>
        <h2>Créneau</h2>
        <div>
            <label for="dayInput">Jour : </label>
            <input type="date" name="day" id="dayInput">
            <label for="hourInput">Heure de début</label>
            <input type="time" name="hour" id="hourInput">
        </div>
        <div>
            <label for="securityInput">Sécurité de surface : </label>
            <select name="security" id="securityInput">
                @foreach ($users as $user)
                    @if($user->hasRole('SEC'))
                        <option value="{{$user->US_ID}}"/>{{$user->US_NAME}} {{$user->US_FIRST_NAME}}</option>
                    @endif
                @endforeach
            </select>
            <label for="securityInput">Sécurité de surface : </label>
            <select name="security" id="securityInput">
                @foreach ($users as $user)
                    @if($user->hasRole('SEC'))
                        <option value="{{$user->US_ID}}"/>{{$user->US_NAME}} {{$user->US_FIRST_NAME}}</option>
                    @endif
                @endforeach
            </select>
            <label for="managerInput">Directeur : </label>
            <select name="manager" id="managerInput">
                @foreach ($users as $user)
                    @if($user->hasRole('DIR'))
                        <option value="{{$user->US_ID}}"/>{{$user->US_NAME}} {{$user->US_FIRST_NAME}}</option>
                    @endif
                @endforeach
            </select>
            <label for="pilotInput">Pilote : </label>
            <select name="manager" id="pilotInput">
                @foreach ($users as $user)
                    @if($user->hasRole('PIL'))
                        <option value="{{$user->US_ID}}"/>{{$user->US_NAME}} {{$user->US_FIRST_NAME}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <input type="submit" value="Créer">
    </form>
</x-layout>
