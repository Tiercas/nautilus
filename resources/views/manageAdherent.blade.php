<x-layout>
    <x-page-title>Gestion des adhérents</x-page-title>

    <h2 class="underline">Accéder aux plongées par période :</h2>
    <a href="{{ route('alldivings') }}">
        <button class="bg-blue-500 hover:bg-blue-700 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
            Plongées par période
        </button>
    </a>
    <hr class="my-4">
    <form action="{{ route('updateMembersRole') }}" method="POST">
        @csrf <!-- {{ csrf_field() }} -->
        <button type="submit" class="invisible bg-blue-500 sticky top-4 hover text-white font-bold py-2 px-4 rounded mx-auto mb-4 block">
            Enregistrer les modifications
        </button>
        <div class="shadow-md max-w-full rounded-lg overflow-hidden border-2">
            <table class="text-sm text-left text-gray-500 w-full">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Prénom NOM</th>
                        <th scope="col" class="px-6 py-3">Plongeur</th>
                        <th scope="col" class="px-6 py-3">Sécurité surface</th>
                        <th scope="col" class="px-6 py-3">Pilote</th>
                        <th scope="col" class="px-6 py-3">Directeur de plongée</th>
                        <th scope="col" class="px-6 py-3">Nombre de plongées</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users[0] as $i => $value)
                        <tr class="odd:bg-white even:bg-gray-50 border-b">
                            <td class="px-6 py-4">{{ $users[0][$i][1] . ' ' . strtoupper($users[0][$i][2]) }}</td>
                            <td class="px-6 py-4">
                                <input type="checkbox" id="checkbox{{ $users[0][$i][0] }}"
                                    name="checkbox_{{ $users[0][$i][0] }}_DIV" value="DIV"
                                    @if (array_search('DIV', $users[1][$i]) !== false) checked @endif>
                            </td>
                            <td class="px-6 py-4">
                                <input type="checkbox" id="checkbox{{ $users[0][$i][0] }}"
                                    name="checkbox_{{ $users[0][$i][0] }}_SEC" value="SEC"
                                    @if (array_search('SEC', $users[1][$i]) !== false) checked @endif>
                            </td>
                            <td class="px-6 py-4">
                                <input type="checkbox" id="checkbox{{ $users[0][$i][0] }}"
                                    name="checkbox_{{ $users[0][$i][0] }}_PIL" value="PIL"
                                    @if (array_search('PIL', $users[1][$i]) !== false) checked @endif>
                            </td>
                            <td class="px-6 py-4">
                                <input type="checkbox" id="checkbox{{ $users[0][$i][0] }}"
                                    name="checkbox_{{ $users[0][$i][0] }}_DIR" value="DIR"
                                    @if (array_search('DIR', $users[1][$i]) !== false) checked @endif>
                            </td>
                            <td class="px-6 py-4">
                                {{$usersDives[$i]}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </form>
    <script>
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var submitButton = document.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                submitButton.disabled = false;
                submitButton.classList.remove('invisible');
            });
        });
        window.addEventListener('beforeunload', function(e) {
            if (submitButton.disabled === false && e.target.activeElement !== submitButton) {
                e.preventDefault();
                e.returnValue = '';
            }
        });
    </script>
</x-layout>
