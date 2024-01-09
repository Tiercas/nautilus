<x-layout>
    <h1>Liste des plongées</h1>
    @dump($dives)
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Plage horaire</th>
                <th>Niveau requis</th>
                <th>Lieu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dives as $dive)
                <tr>
                    <td>{{ $dive->DS_DATE }}</td>
                    <td>{{ $dive->CAR_SCHEDULE }}</td>
                    <td>{{ $dive->DL_DEPTH }}</td>
                    <td>{{ $dive->DL_NAME }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
