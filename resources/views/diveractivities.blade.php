<x-layout>
    @if (!session()->has('user'))
        Vous devez être connecté pour accéder à cette page.
    @else
        <x-page-title hrSize="70%">Historique des plongées de
            {{ session('user')->US_FIRST_NAME . ' ' . session('user')->US_NAME }}</x-page-title>

        <div class="shadow-md max-w-full w-1/3 rounded-lg overflow-hidden border-2 mx-auto">
            <table class="text-sm text-left text-gray-500 w-full">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-12 py-3">Nombre de plongées</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-12 py-4">{{ $usersCount }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p style="font-size: 35px"> A venir </p>
        <hr style="height: 3px;background-color: black;margin-bottom: 30px;margin-top: 5px; width : 20%;">
        <table style="text-align: left; width: 100%; margin-bottom: 50px;">
            <thead class="text-xs text-gray-700 bg-gray-50" style="border-bottom: 1px solid black; font-size: 15px;">
                <tr>
                    <th scope="col" class="px-12 py-3">Date</th>
                    <th scope="col" class="px-12 py-3">Heure</th>
                    <th scope="col" class="px-12 py-3">Rôle</th>
                    <th scope="col" class="px-12 py-3">Lieu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datesA as $dateA)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-12 py-4">{{ $dateB->DS_DATE }}</td>
                        <td class="px-12 py-4">{{ $dateB->CAR_SCHEDULE }}</td>
                        <td class="px-12 py-4">{{ $dateB->ROL_LABEL }}</td>
                        <td class="px-12 py-4">{{ $dateB->DL_NAME }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        

        <p style="font-size: 35px"> Ayant eu lieu </p>
        <hr style="height: 3px;background-color: black;margin-bottom: 30px;margin-top: 5px; width : 20%">
        <table style="text-align: left; width: 100%;  margin-bottom: 50px;">
            <thead class="text-xs text-gray-700 bg-gray-50" style="border-bottom: 1px solid black; font-size: 15px;">
                <tr>
                    <th scope="col" class="px-12 py-3">Date</th>
                    <th scope="col" class="px-12 py-3">Heure</th>
                    <th scope="col" class="px-12 py-3">Rôle</th>
                    <th scope="col" class="px-12 py-3">Lieu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datesB as $dateB)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-12 py-4">{{ $dateB->DS_DATE }}</td>
                        <td class="px-12 py-4">{{ $dateB->CAR_SCHEDULE }}</td>
                        <td class="px-12 py-4">{{ $dateB->ROL_LABEL }}</td>
                        <td class="px-12 py-4">{{ $dateB->DL_NAME }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-layout>
