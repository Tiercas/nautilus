<x-layout>
    <x-page-title>Historique des plongées</x-page-title>
    <div class="shadow-md max-w-full w-2/3 rounded-lg overflow-hidden border-2 mx-auto">
        @if(is_array($sessions))
            <table class="text-sm text-left text-gray-500 w-full">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nom</th>
                        <th scope="col" class="px-6 py-3">Prénom</th>
                        <th scope="col" class="px-6 py-3">Session</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sessions as $session)
                        <tr class="odd:bg-white even:bg-gray-50 border-b">
                            <td class="px-6 py-4">{{ $session->US_NAME }}</td>
                            <td class="px-6 py-4">{{ $session->US_FIRST_NAME }}</td>
                            <td class="px-6 py-4">{{ $session->DS_CODE }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
        @endif
    </div>
</x-layout>
