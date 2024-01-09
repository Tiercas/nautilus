<x-layout>
    <x-page-title>Liste des plongées</x-page-title>
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
                    <td><x-button>S'inscrire</x-button></td>
                    <td><x-button>Voir les inscrits</x-button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
