<x-layout>
    <x-page-title>Plongées restantes</x-page-title>
    <div class="shadow-md max-w-full rounded-lg overflow-hidden border-2">
        <table class="text-sm text-left text-gray-500 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Noms et Prénoms</th>
                <th scope="col" class="px-6 py-3">Nombre de plongées</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <td class="px-6 py-4">{{ $dive->DS_DATE }}</td>
                    <td class="px-6 py-4">{{ $dive->CAR_SCHEDULE }}</td>
                    <td class="px-6 py-4">{{ $dive->DL_DEPTH }}</td>
                    <td class="px-6 py-4">{{ $dive->DL_NAME }}</td>
                    <td class="px-6 py-4"><x-button>S'inscrire</x-button><x-button>Voir les inscrits</x-button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
