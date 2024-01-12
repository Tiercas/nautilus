<script defer src="{{ asset('js/securitySheets/edit.js') }}">
</script>

<meta id="divingSessionId" content="{{$dive->DS_CODE}}">
<meta id="csrf-token" content="{{csrf_token()}}">

<x-layout>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/edit.css') }}">

    <x-page-title>Fiche de sécurité</x-page-title>
    
    <div class="aligne mb-4">
        <x-popup bgPopup="''">
            <div id="popup-content" class="text-base"></div>
        </x-popup>
    </div>

    <div class="aligne" style="margin-bottom: 40px">
        <button id="button" class="clickable"
            style="padding: 10px; border-radius: 10px; width:60%; height: 80px; font-size: 35px">Générer de nouveau</button>
    </div>

    <div class="aligne Column">
        <p style="font-size: 35px">Information sur la plongée</p>
        <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px; width : 40rem">
        <table style="text-align: left;border: 1px solid black;">
            <thead style="border-bottom: 1px solid black; font-size: 15px;background-color: var(--yellow);">
                <tr>
                    <th scope="col" class="px-12 py-4">Date</th>
                    <th scope="col" class="px-12 py-4">Site de plongée</th>
                    <th scope="col" class="px-12 py-4">Observation météo et marée</th>
                    <th scope="col" class="px-12 py-4">Directeur de plongée</th>
                    <th scope="col" class="px-12 py-4">Sécurité de surface</th>
                    <th scope="col" class="px-12 py-4">Pilote</th>
                </tr>
            </thead>
            <tbody>
                <tr class="odd:bg-white even:bg-gray-50">
                    <td class="px-12 py-4">{{ $dive->DS_DATE }}</td>
                    <td class="px-12 py-4">{{ $location->DL_NAME }}</td>
                    <td class="px-12 py-4">
                        <input id="observation-field" class="bg-[#e6e6e6] border border-black"
                            type="text" value="{{ $dive->DS_OBSERVATION_FIELD }}"
                            style="border-radius: 10px;background-color: var(--yellow);
                            border-color: var(--yellow);display: flex;align-items: center;justify-content: center;
                            font-size: 20px;padding: 10px;width: 100%;text-align: center;"> 
                    </td>
                    <td class="px-12 py-4">{{ $director->US_FIRST_NAME }} {{ $director->US_NAME }}</td>
                    <td class="px-12 py-4">{{ $surfaceSecurity->US_FIRST_NAME }} {{ $surfaceSecurity->US_NAME }}</td>
                    <td class="px-12 py-4">{{ $driver->US_FIRST_NAME }} {{ $driver->US_NAME }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    @foreach ($divingGroups as $divingGroup)
        <x-security-sheets.table>
            @php
                $groupNumber = $divingGroup['group']->DG_NUMBER;
            @endphp

            <div class="aligne Column">
                <p style="font-size: 35px; margin-top: 50px;">Palanquée n° {{ $groupNumber }}</p>
                <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px; width : 40rem">
            </div>
            <table style="text-align: left;border: 1px solid black;">
                <thead style="border-bottom: 1px solid black; font-size: 15px;background-color: var(--yellow);">
                    <tr>
                        <th scope="col" class="px-12 py-4" style="background-color: var(--yellow);">Palanquée n°
                            {{ $groupNumber }}</th>
                        <th scope="col" class="px-12 py-4" style="background-color: var(--yellow);"></th>
                        <th scope="col" class="px-12 py-4" style="background-color: var(--yellow);"></th>
                        <th scope="col" class="px-12 py-4" style="background-color: var(--yellow);"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="px-12 py-4">Heure de départ</td>
                        <td class="px-12 py-4"><input id="dg{{ $groupNumber }}-start"
                                class="dg-start border-2 border-solid border-gray-500" type="time"
                                style="border-radius: 10px;background-color: var(--yellow);border-color: var(--yellow);
                                    display: flex;align-items: center;justify-content: center;
                                    font-size: 20px;padding: 10px;width: 50%;text-align: center;"
                                value="{{ substr($divingGroup['group']->DG_BEGINNING_OF_DIVING_HOUR, 0, 5) }}">
                        </td>
                        <td class="px-12 py-4">Heure de retour</td>
                        <td class="px-12 py-4">
                            <input id="dg{{ $groupNumber }}-end" class="dg-end border-2 border-solid border-gray-500"
                                type="time"
                                style="border-radius: 10px;background-color: var(--yellow);border-color: var(--yellow);
                                    display: flex;align-items: center;justify-content: center;
                                    font-size: 20px;padding: 10px;width: 50%;text-align: center;"
                                value="{{ substr($divingGroup['group']->DG_END_OF_DIVING_HOUR, 0, 5) }}">
                        </td>
                    </tr>

                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="px-12 py-4">Temps prévu (minutes)</td>
                        <td class="px-12 py-4">
                            <input id="dg{{ $groupNumber }}-exp-time" class="dg-exp-time" type="number"
                                value = "{{ $divingGroup['group']->DG_MAX_DURATION }}"
                                style="font-size: 20px;width: 50%;-moz-appearance: textfield;text-align: center;background-color: var(--yellow);padding: 10px;border-radius: 10px;">
                        </td>
                        <td class="px-12 py-4">Temps réalisé (minutes)</td>
                        <td class="px-12 py-4">
                            <input id="dg{{ $groupNumber }}-act-time" class="dg-act-time" type="number"
                                value = "{{ $divingGroup['group']->DG_EFFECTIVE_DIVING_DURATION }}"
                                style="font-size: 20px;width: 50%;-moz-appearance: textfield;text-align: center;background-color: var(--yellow);padding: 10px;border-radius: 10px;">
                        </td>
                    </tr>

                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="px-12 py-4">Profondeur prévue (mètres)</td>
                        <td class="px-12 py-4">
                            <input id="dg{{ $groupNumber }}-exp-dep" class="dg-exp-dep" type="number"
                                value = "{{ $divingGroup['group']->DG_MAX_DEPTH }}"
                                style="font-size: 20px;width: 50%;-moz-appearance: textfield;text-align: center;background-color: var(--yellow);padding: 10px;border-radius: 10px;">
                        </td>
                        <td class="px-12 py-4">Profondeur réalisée (mètres)</td>
                        </td>
                        <td class="px-12 py-4">
                            <input
                                style="font-size: 20px;width: 50%;-moz-appearance: textfield;text-align: center;background-color: var(--yellow);padding: 10px;border-radius: 10px;"
                                id="dg{{ $groupNumber }}-act-dep" class="dg-act-dep" type="number"
                                value = "{{ $divingGroup['group']->DG_MAX_EFFECTIVE_DEPTH }}">
                        </td>
                    </tr>
                </tbody>
            </table>

            <table style="text-align: left;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; width: 100%">
                <thead style="font-size: 15px;background-color: var(--yellow);">
                    <tr>
                        <th scope="col" class="px-12 py-4" style="background-color: var(--yellow);">
                        </th>
                        <th scope="col" class="px-12 py-4" style="background-color: var(--yellow);">
                            <p style="font-size: 30px; text-align: center;">Liste des participants</p>
                        <th scope="col" class="px-12 py-4" style="background-color: var(--yellow);"></th>
                    </tr>
                </thead>
                <thead style="border-bottom: 1px solid black; font-size: 15px;background-color: var(--yellow);">
                    <tr>
                        <th scope="col" class="px-12 py-4" style="background-color: var(--yellow);">Prénom et Nom
                        </th>
                        <th scope="col" class="px-12 py-4" style="background-color: var(--yellow);">Aptitude</th>
                        <th scope="col" class="px-12 py-4" style="background-color: var(--yellow);">Fonction</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($divingGroup['divers'] as $diver)
                        <tr class="odd:bg-white even:bg-gray-50">
                            <td class="px-12 py-4">{{ $diver->US_NAME }} {{ $diver->US_FIRST_NAME }}</td>
                            <td class="px-12 py-4"> {{ $diver->PRE_CODE }}
                                @if ($diver->US_TEACHING_LEVEL > 0)
                                    / E{{ $diver->US_TEACHING_LEVEL }}
                                @endif
                            </td>
                            <td class="px-12 py-4">{{ $dive->getRoleForUser($diver) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table>
        </x-security-sheets.table>
    @endforeach
</x-layout>
