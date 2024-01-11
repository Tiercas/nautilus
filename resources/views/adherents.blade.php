<x-layout>
    <link rel="stylesheet" href="/css/drop-down.css">
    <x-page-title>Modification de la plongée du {{$sessionplongee['DS_DATE']}}, à {{$sessionplongee['DL_NAME']}}, {{$sessionplongee['CAR_SCHEDULE']}}</x-page-title>

    <form method="GET">
        <input type="text" name="searchbar" placeholder="Cherchez un utilisateur ici"></input>
        <x-button type="submit">Rechercher</x-button>
    </form>

    <div class="shadow-md max-w-full rounded-lg overflow-hidden border-2">
        <table class="text-sm text-left text-gray-500 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4">Prénom</th>
                    <th scope="col" class="px-6 py-4">Nom</th>
                    <th scope="col" class="px-6 py-4">N° Licence</th>
                </tr>
            </thead>
            <tbody>
                @foreach($adherents as $adherent)
                    <form method="POST" action="/modificationdives/members/{{$sessionplongee['DS_CODE']}}/ajoutadherent/{{$adherent['US_ID']}}">
                    @csrf
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-6 py-4">{{ $adherent['US_NAME']}}</td>
                        <td class="px-6 py-4">{{ $adherent['US_FIRST_NAME'] }}</td>
                        <td class="px-6 py-4">{{ $adherent['US_LICENCE_ID']}}</td>
                        <td class="px-6 py-4">
                            <a>
                                <x-button type="submit" color="bg-green-500" colorHover="hover:bg-green-600">
                                    Ajouter
                                </x-button>
                            </a>
                        </td>
                    </tr>
                    </form>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>