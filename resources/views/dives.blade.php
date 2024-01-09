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
                <th scope="col" class="px-8 py-3">Date</th>
                <th scope="col" class="px-8 py-3">Plage horaire</th>
                <th scope="col" class="px-8 py-3">Niveau requis</th>
                <th scope="col" class="px-8 py-3">Lieu</th>
                <th scope="col" class="px-8 py-3">Actions</th>
            </tr>
            </thead>
            <tbody class="">
            @foreach ($dives as $dive)
                <tr class="">
                    <td class="px-8 py-4">{{ $dive->DS_DATE }}</td>
                    <td class="px-8 py-4">{{ $dive->CAR_SCHEDULE }}</td>
                    <td class="px-8 py-4">{{ $dive->DL_DEPTH }}</td>
                    <td class="px-8 py-4">{{ $dive->DL_NAME }}</td>
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
