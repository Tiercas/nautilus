<x-layout>
    <x-page-title>Gestion des adhérents</x-page-title>
    <form action="{{ route('updateMembersRole') }}" method="POST">
        @csrf <!-- {{ csrf_field() }} -->
        <div class="shadow-md max-w-full rounded-lg overflow-hidden border-2">
            <table class="text-sm text-left text-gray-500 w-full">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Prénom NOM</th>
                    <th scope="col" class="px-6 py-3">Plongeur</th>
                    <th scope="col" class="px-6 py-3">Sécurité surface</th>
                    <th scope="col" class="px-6 py-3">Pilote</th>
                    <th scope="col" class="px-6 py-3">Directeur de plongée</th>
                </tr>
                </thead>
                <tbody>
                @for ($i = 1; $i < count($users[0]); $i++)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-6 py-4">{{ $users[0][$i][1] . " " . $users[0][$i][2] }}</td>
                        <td class="px-6 py-4">
                            <input type="checkbox" id="checkbox{{ $users[0][$i][0] }}" name="checkbox_{{ $users[0][$i][0] }}_DIV" value="DIV" @if(array_search('DIV', $users[1][$i]) !== false) checked @endif>
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" id="checkbox{{ $users[0][$i][0] }}" name="checkbox_{{ $users[0][$i][0] }}_SEC" value="SEC" @if(array_search('SEC', $users[1][$i]) !== false) checked @endif>
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" id="checkbox{{ $users[0][$i][0] }}" name="checkbox_{{ $users[0][$i][0] }}_PIL" value="PIL" @if(array_search('PIL', $users[1][$i]) !== false) checked @endif>
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" id="checkbox{{ $users[0][$i][0] }}" name="checkbox_{{ $users[0][$i][0] }}_DIR" value="DIR" @if(array_search('DIR', $users[1][$i]) !== false) checked @endif>
                        </td>
                    </tr>
                @endfor
                </tbody>
            </table>

        </div>
        <div class="text-right">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                Valider
            </button>
        </div>
    </form>
</x-layout>

