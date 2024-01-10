<x-layout>
    <link rel="stylesheet" href="/css/drop-down.css">
    <x-page-title>Ajouter des adhérents</x-page-title>
    <div class="shadow-md max-w-full w-1/3 rounded-lg overflow-hidden border-2 mx-auto">
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
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-6 py-4">{{ $adherent->US_NAME }}</td>
                        <td class="px-6 py-4">{{ $adherent->US_FIRST_NAME }}</td>
                        <td class="px-6 py-4">{{ $adherent->US_LICENCE_ID }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>