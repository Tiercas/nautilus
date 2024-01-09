<x-layout>
    <x-page-title>Plongées réalisées</x-page-title>
    <div class="shadow-md max-w-full rounded-lg overflow-hidden border-2">
        <table class="text-sm text-left text-gray-500 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Nombre de plongées réalisées</th>
                <th scope="col" class="px-6 py-3">Prénom</th>
                <th scope="col" class="px-6 py-3">Nom</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($datas as $data)
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <td class="px-6 py-4">{{ $data->aggregate }}</td>
                    <td class="px-6 py-4">{{ $data->US_FIRST_NAME }}</td>
                    <td class="px-6 py-4">{{ $data->US_NAME }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
