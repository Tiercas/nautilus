<x-layout>
    <link rel="stylesheet" href="/css/drop-down.css">
    <x-page-title>Modification des plongées</x-page-title>
    <div class="shadow-md max-w-full rounded-lg overflow-hidden border-2">
        <table class="text-sm text-left text-gray-500 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Prénom</th>
                <th scope="col" class="px-6 py-3">Nom</th>
                <th scope="col" class="px-6 py-3">Profondeur</th>
                <th scope="col" class="px-6 py-3">Lieu</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($dives as $dive)
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <td class="px-6 py-4">{{ $dive['ds_date'] }}</td>
                    <td class="px-6 py-4">{{ $dive['car_schedule'] }}</td>
                    <td class="px-6 py-4">{{ $dive['dl_depth'] }}m</td>
                    <td class="px-6 py-4">{{ $dive['dl_name'] }}</td>
                    <td class="px-8 py-4">
                        <a href='\modificationdives'>
                            <x-button color="#ec9f21" colorHover="hover:bg-green-800">
                                Modifier
                            </x-button>
                        </a>
                        <a href="\modificationdives\members\{{$dive['ds_code']}}">
                            <x-button>
                                Adhérents
                            </x-button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script type="text/javascript" src="/js/drop-down.js"></script>
</x-layout>
