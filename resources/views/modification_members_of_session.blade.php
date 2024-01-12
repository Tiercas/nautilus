<x-layout>
    <link rel="stylesheet" href="/css/drop-down.css">
    <x-page-title>Modification de la plongée du {{$sessionplongee['DS_DATE']}}, à {{$sessionplongee['DL_NAME']}}, {{$sessionplongee['CAR_SCHEDULE']}}</x-page-title>
    <div class="shadow-md max-w-full rounded-lg overflow-hidden border-2">
        <table class="text-sm text-left text-gray-500 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-4">Prénom</th>
                <th scope="col" class="px-6 py-4">Nom</th>
                <th scope="col" class="px-6 py-4">Rôle</th>
                <th scope="col" class="px-6 py-4">Prérogative</th>
            </tr>
            </thead>
            <tbody>
            
            @foreach ($persons as $person)
            
            
                @csrf
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <td class="px-6 py-4">{{ $person['US_NAME'] }}</td>
                    <td class="px-6 py-4">{{ $person['US_FIRST_NAME'] }}</td>
                    <td class="px-6 py-4">{{$person['ROL_LABEL']}}</td>
                    <td class="px-6 py-4">{{$person['PRE_CODE']}}</td>


                    @if($person['ROL_LABEL'] == 'Plongeur')
                        <form method="POST" action='/modificationdives/members/{{$sessionplongee['DS_CODE']}}/deletiondiver/{{$person['US_ID']}}'>
                            @csrf
                            <td class="px-6 py-4">
                                <a>
                                    <x-button type="submit" color="bg-red-500" colorHover="hover:bg-red-600">
                                        supprimer
                                    </x-button>
                                </a>
                            </td>
                        </form>
                    @endif
                    

                </tr>
            
            @endforeach
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    
                </tr>
            </tbody>
        </table>
    </div>
    <div>
    </div>
    @if($full == false)
        <div class="mt-3 shadow-md max-w-fit w-1/6 mx-left rounded-lg overflow-hidden border-2">
            <a href="/modificationdives/members/{{$sessionplongee['DS_CODE']}}/ajoutadherent/{{$sessionplongee['PRE_CODE']}}" class="text-blue-500 underline">
                <x-button color="red" colorHover="hover:bg-green-800">
                    Ajouter un plongeur
                </x-button>
            </a>
        </div>
    @endif
    @if($full == true)
        <div class="mt-3 shadow-md max-w-fit w-1/6 mx-left rounded-lg overflow-hidden border-2">
            <a href="/modificationdives/members/{{$sessionplongee['DS_CODE']}}/ajoutadherent/{{$sessionplongee['PRE_CODE']}}" class="text-blue-500 underline">
                <x-button disabledVal="true" color="bg-gray-400" colorHover="hover:bg-gray-400">
                    Ajouter un plongeur
                </x-button>
            </a>
        </div>
    @endif
    <script type="text/javascript" src="/js/drop-down.js"></script>
</x-layout>
