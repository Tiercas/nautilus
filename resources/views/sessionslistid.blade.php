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

                        @php
                            $dateTimestamp = strtotime($session->DS_DATE);
                            $dateUnAnPlusTotTimestamp = strtotime('-1 year', $dateTimestamp);
                        @endphp

                        @if($dateTimestamp <= time() && $dateTimestamp >= $dateUnAnPlusTotTimestamp)                            
                            <td class="px-6 py-4 flex items-center italic justify-between"> Archivé
                                <span class="flex items-center">
                                    <!-- Second Icon -->
                                    <x-redirect-button
                                        link="/dives/{{$session->DS_CODE}}/security-sheet/generate">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                          </svg>                                          
                                    </x-redirect-button>
                            
                                    <!-- Third Icon -->
                                    <x-redirect-button
                                        link="/dives/{{$session->DS_CODE}}/security-sheet/test">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                        </svg>  
                                    </x-redirect-button>
                                </span>
                            </td>
                        @elseif($session->DS_FILE_FILLED == 0)
                        <td class="px-6 py-4 flex items-center justify-between">
                            <span class="flex items-center">
                                <!-- Text and First Icon -->
                                <span class="mr-2">Pas rempli</span>
                                <x-redirect-button
                                        link="/dives/{{$session->DS_CODE}}/security-sheet/edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                          </svg>                                          
                                    </x-redirect-button>
                            </span>
                        
                            <span class="flex items-center">
                                <!-- Second Icon -->
                                <x-redirect-button
                                        link="/dives/{{$session->DS_CODE}}/security-sheet/generate">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                          </svg>                                          
                                    </x-redirect-button>
                        
                                <!-- Third Icon -->
                                <x-redirect-button
                                        link="/dives/{{$session->DS_CODE}}/security-sheet/test">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                        </svg>  
                                </x-redirect-button>
                            </span>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
