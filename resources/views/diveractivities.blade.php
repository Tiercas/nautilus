<x-layout>
    @if (!session()->has('user'))
        Vous devez être connecté pour accéder à cette page.
    @else
        <x-page-title hrSize="70%">Plongées de
            {{ session('user')->US_FIRST_NAME . ' ' . session('user')->US_NAME }} | Plongées restantes : {{$usersCount}}</x-page-title>


        <x-page-subtitle> A venir </x-page-subtitle>
        <div class="mt-10 shadow-md max-w-full w-1/3 rounded-lg overflow-hidden border-2 mx-auto">
            <table class="text-sm text-left text-gray-500 w-full">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Lieu</th>
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3">Heure</th>
                        <th scope="col" class="px-6 py-3">Rôle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datesA as $dateA)
                        <tr class="odd:bg-white even:bg-gray-50 border-b">
                            <td class="px-6 py-4">{{ $dateA->DL_NAME }}</td>
                            <td class="px-6 py-4">{{ $dateA->DS_DATE }}</td>
                            @if($dateA->CAR_SCHEDULE == 'Matin')
                                <td class="px-6 py-4">9:00 - 12:00</td>
                            @elseif($dateA->CAR_SCHEDULE == 'Apres-midi')
                                <td class="px-6 py-4">13:00 - 17:00</td>
                            @elseif($dateA->CAR_SCHEDULE == 'Soir')
                                <td class="px-6 py-4">18:00 - 21:00</td>
                            @endif
                            <td class="px-6 py-4">{{ $dateA->ROL_LABEL }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <x-page-subtitle> Ayant eu lieu </x-page-subtitle>
        <div class="mt-10 mb-10 shadow-md max-w-full w-1/3 rounded-lg overflow-hidden border-2 mx-auto">
            <table class="text-sm text-left text-gray-500 w-full">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Lieu</th>
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3">Heure</th>
                        <th scope="col" class="px-6 py-3">Rôle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datesB as $dateB)
                        <tr class="odd:bg-white even:bg-gray-50 border-b">
                            <td class="px-6 py-4">{{ $dateB->DL_NAME }}</td>
                            <td class="px-6 py-4">{{ $dateB->DS_DATE }}</td>
                            @if($dateB->CAR_SCHEDULE == 'Matin')
                                <td class="px-6 py-4">9:00 - 12:00</td>
                            @elseif($dateB->CAR_SCHEDULE == 'Apres-midi')
                                <td class="px-6 py-4">13:00 - 17:00</td>
                            @elseif($dateB->CAR_SCHEDULE == 'Soir')
                                <td class="px-6 py-4">18:00 - 21:00</td>
                            @endif
                            <td class="px-6 py-4">{{ $dateB->ROL_LABEL }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-layout>
