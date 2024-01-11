<x-layout>
    <link rel="stylesheet" href="/css/drop-down.css">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <x-page-title>Sessions de plongées</x-page-title>
    <div class="shadow-md max-w-full rounded-lg overflow-hidden border-2">
        <table class="text-sm text-left text-gray-500 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Date</th>
                    <th scope="col" class="px-6 py-3">Session</th>
                    <th scope="col" class="px-6 py-3">Fichier de sécurité</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sessions as $session)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-6 py-4">{{ $session->DS_DATE }}</td>
                        <td class="px-6 py-4">{{ $session->DS_CODE }}</td>
                        @if($session->DS_FILE_FILLED == 1)
                            <td class="px-6 py-4">Pas rempli</td>
                        @elseif($session->DS_FILE_FILLED == 0)
                            <td class="px-6 py-4">Rempli</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
