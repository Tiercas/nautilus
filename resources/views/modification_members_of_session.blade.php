{{$persons}}
<x-layout>
    <link rel="stylesheet" href="/css/drop-down.css">
    <x-page-title>Modification de la plongée du {{$sessionplongee[0]['DS_DATE']}}, à {{$sessionplongee[0]['DL_NAME']}}, {{$sessionplongee[0]['CAR_SCHEDULE']}}</x-page-title>
    <div class="shadow-md max-w-full rounded-lg overflow-hidden border-2">
        <table class="text-sm text-left text-gray-500 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-4">Prénom</th>
                <th scope="col" class="px-6 py-4">Nom</th>
                <th scope="col" class="px-6 py-4">Rôle</th>
                <th scope="col" class="px-6 py-4">Date d'inscription</th>
            </tr>
            </thead>
            <tbody>
            
            @foreach ($persons as $person)
            <form method="POST" action='/modificationdives/members/{{$sessionplongee[0]['DS_CODE']}}/deletion/{{$person['US_ID']}}'>
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <td class="px-6 py-4">{{ $person['us_name'] }}</td>
                    <td class="px-6 py-4">{{ $person['us_first_name'] }}</td>
                    <td class="px-6 py-4">
                    @if($person['ROL_CODE'] == 'DIV')
                        Plongeur
                    @elseif($person['ROL_CODE'] == 'DIR')
                        Directeur
                    @elseif($person['ROL_CODE'] == 'PIL')
                        Pilote
                    @elseif($person['ROL_CODE'] == 'SEC')
                        Sécurité de surface
                    @endif
                    </td>
                    <td class="px-6 py-4">{{$person['US_SUB_DATE']}}</td>
                    <td class="px-6 py-4">
                        <a>
                            <x-button type="submit" color="bg-red-500" colorHover="hover:bg-red-600">
                                supprimer
                            </x-button>
                        </a>
                    </td>
                </tr>
            </form>
            @endforeach
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mt-3 shadow-md max-w-fit w-1/6 mx-left rounded-lg overflow-hidden border-2">
        <a href='/modificationdives/members/{{$sessionplongee[0]['DS_CODE']}}'>
            <x-button color="red" colorHover="hover:bg-green-800">
                Ajouter un adhérent
            </x-button>
        </a>
    </div>
    <script type="text/javascript" src="/js/drop-down.js"></script>
</x-layout>
