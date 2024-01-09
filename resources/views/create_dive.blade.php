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
        </div>
    </form>
</x-layout>
