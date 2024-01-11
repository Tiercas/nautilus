<x-layout>
    <x-page-title>Historique des plongées de {{ session('user')->US_FIRST_NAME . " " . session('user')->US_NAME }}</x-page-title>
    <x-page-subtitle> Plongées restantes </x-page-subtitle>
    <div class="shadow-md max-w-full w-1/3 rounded-lg overflow-hidden border-2 mx-auto">
        <table class="text-sm text-left text-gray-500 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Nombre de plongées</th>
            </tr>
            </thead>
            <tbody>
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <td class="px-6 py-4">{{ $usersCount }}</td>
                </tr>
            </tbody>
        </table>        
    </div>

    <x-page-subtitle> A venir </x-page-subtitle>
    <div class="mt-10 shadow-md max-w-full w-1/3 rounded-lg overflow-hidden border-2 mx-auto">
        <table class="text-sm text-left text-gray-500 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Nom</th>
                <th scope="col" class="px-6 py-3">Prénom</th>
                <th scope="col" class="px-6 py-3">Date</th>
            </tr>
            </thead>
            <tbody>
                @foreach($datesA as $dateA)
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                <td class="px-6 py-4">{{ $dateA->US_NAME }}</td>
                    <td class="px-6 py-4">{{ $dateA->US_FIRST_NAME }}</td>
                    <td class="px-6 py-4">{{ $dateA->DS_DATE }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-page-subtitle> Ayant eu lieu </x-page-subtitle>
    <div class="mt-10 shadow-md max-w-full w-1/3 rounded-lg overflow-hidden border-2 mx-auto">
        <table class="text-sm text-left text-gray-500 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Nom</th>
                <th scope="col" class="px-6 py-3">Prénom</th>
                <th scope="col" class="px-6 py-3">Date</th>
            </tr>
            </thead>
            <tbody>
                @foreach($datesB as $dateB)
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                <td class="px-6 py-4">{{ $dateB->US_NAME }}</td>
                    <td class="px-6 py-4">{{ $dateB->US_FIRST_NAME }}</td>
                    <td class="px-6 py-4">{{ $dateB->DS_DATE }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
