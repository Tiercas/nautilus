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
                @foreach ($user_role as $user)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-6 py-4">{{ $user[2] }}</td>
                        <td class="px-6 py-4">
                            <input type="checkbox" id="checkbox{{ $user[0] }}" name="checkbox{{ $user[0] }}" value="checkbox{{ $user[0] }}_DIV @if(array_search('DIV', $user[1])) checked @endif">
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" id="checkbox{{ $user[0] }}" name="checkbox{{ $user[0] }}" value="checkbox{{ $user[0] }}_SEC @if(array_search('SEC', $user[1])) checked @endif">
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" id="checkbox{{ $user[0] }}" name="checkbox{{ $user[0] }}" value="checkbox{{ $user[0] }}_PIL @if(array_search('PIL', $user[1])) checked @endif">
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" id="checkbox{{ $user[0] }}" name="checkbox{{ $user[0] }}" value="checkbox{{ $user[0] }}_DIR @if(array_search('DIR', $user[1])) checked @endif">
                        </td>
                    </tr>
                @endforeach
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

