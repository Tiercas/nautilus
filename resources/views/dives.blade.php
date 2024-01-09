<x-layout>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Space+Grotesk&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Montserrat&family=Space+Grotesk&display=swap" rel="stylesheet">

    <h1 class="text-4xl" style="font-family: 'Space Grotesk', sans-serif; font-weight: bold;">S'inscrire à une plongée</h1>
    <hr style="width: 60%; height: 3px; background-color: black; margin-top: 20px; margin-bottom: 80px;">
    <div class="" style="font-family: 'Montserrat', sans-serif;">
        <table class="">
            <thead class="text-left" style="border-bottom: 2px solid black; font-weight: bold;">
            <tr>
                <th scope="col" class="px-6 py-3">Date</th>
                <th scope="col" class="px-6 py-3">Plage horaire</th>
                <th scope="col" class="px-6 py-3">Profondeur</th>
                <th scope="col" class="px-6 py-3">Lieu</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
            </thead>
            <tbody class="">
            @foreach ($dives as $dive)
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <td class="px-6 py-4">{{ $dive->DS_DATE }}</td>
                    <td class="px-6 py-4">{{ $dive->CAR_SCHEDULE }}</td>
                    <td class="px-6 py-4">{{ $dive->DL_DEPTH }}m</td>
                    <td class="px-6 py-4">{{ $dive->DL_NAME }}</td>
                    <td class="px-6 py-4"><x-button>S'inscrire</x-button><x-button>Voir les inscrits</x-button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
