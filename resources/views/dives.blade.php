
<x-layout>
    <x-page-title>Liste des plongées</x-page-title>
    <div class="shadow-md max-w-full rounded-lg overflow-hidden border-2">
        <table class="text-sm text-left text-gray-500 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Date</th>
                <th scope="col" class="px-6 py-3">Plage horaire</th>
                <th scope="col" class="px-6 py-3">Profondeur</th>
                <th scope="col" class="px-6 py-3">Lieu</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($dives as $dive)
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <td class="px-6 py-4">{{ $dive->DS_DATE }}</td>
                    <td class="px-6 py-4">{{ $dive->CAR_SCHEDULE }}</td>
                    <td class="px-6 py-4">{{ $dive->DL_DEPTH }}m</td>
                    <td class="px-6 py-4">{{ $dive->DL_NAME }}</td>
                    <td class="px-8 py-4">
                        @if (Session::has('Success'))
                            <div class="alert alert-info">{{ Session::get('Success') }}</div>
                        @endif
                        <a href='/dives/{{$dive->DS_CODE}}' class="bg-green-400 hover:bg-green-500 focus:bg-green-500 text-black rounded-lg px-10 py-1.5">S'inscrire</a>
                        <button class="bg-yellow-400 hover:bg-yellow-500 focus:bg-yellow-500 text-black rounded-lg px-5 py-1.5">Voir les inscrits</button>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
