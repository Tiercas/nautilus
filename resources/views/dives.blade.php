<x-layout>
    <h1>Liste des plongées</h1>
    <ul>
        @foreach ($dives as $dive)
            <li>{{ $dive->date }} - {{ $dive->site }}</li>
        @endforeach
    </ul>
</x-layout>

