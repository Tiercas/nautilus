<x-layout>

    <link rel="stylesheet" href="../css/app.css">

    <x-page-title>Créer une plongée</x-page-title>
    <div style="display : flex; flex-direction: row">
        <div style="width: 50%;">
            <img src="{{ asset('resources/img/Diver1.png') }}" alt="Illustration de plongueur">
        </div>
        <form action="/create/dive" method="POST">
            <h1 class="text-4xl" style="font-family: 'Space Grotesk', sans-serif; font-weight: bold;">Création d'une plongée</h1>
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
            <div>
                <div class="flex -mx-3">
                    <div class="w-full px-3 mb-5">
                        <label for="" class="text-xs font-semibold px-1">Mail</label>
                        <div class="flex">
                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                            <input type="email" id="mail" name="mail" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="johnsmith@example.com">
                        </div>
                    </div>
                </div>
                <div class="flex -mx-3">
                    <div class="w-full px-3 mb-12">
                        <label for="" class="text-xs font-semibold px-1">Mot de passe</label>
                        <div class="flex">
                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-lock-outline text-gray-400 text-lg"></i></div>
                            <input type="password" id="password" name="password" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="************">
                        </div>
                    </div>
                </div>
                <div class="flex -mx-3">
                    <div class="w-full px-3 mb-5">
                        <input class="clickable block w-full max-w-xs mx-auto bg-yellow-400 hover:bg-yellow-500 focus:bg-yellow-500 text-black rounded-lg px-3 py-3 font-semibold" type="submit" value="CREER">
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layout>
