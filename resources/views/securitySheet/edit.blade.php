<script defer src="{{asset('js/securitySheets/edit.js')}}"></script>

<meta id="divingSessionId" content="{{$dive->DS_CODE}}">

<x-layout>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/edit.css') }}">
    
    <x-page-title>Fiche de sécurité</x-page-title>


    <table style="text-align: left;border: 1px solid black;">
        <thead style="border-bottom: 1px solid black; font-size: 15px;background-color: var(--yellow);">
            <tr>
                <th scope="col" class="px-12 py-3">Date</th>
                <th scope="col" class="px-12 py-3">Directeur de plongée</th>
                <th scope="col" class="px-12 py-3">Site de plongée</th>
            </tr>
        </thead>
        <tbody>
            <tr class="odd:bg-white even:bg-gray-50">
                <td class="px-12 py-4">{{ $dive->DS_DATE }}</td>
                <td class="px-12 py-4">{{$director->US_FIRST_NAME}} {{$director->US_NAME}}</td>
                <td class="px-12 py-4">{{$location->DL_NAME}}</td>
            </tr>
        </tbody>
    </table>
    
    <button diveId="button" class="clickable" style="padding: 10px; border-radius: 10px;">Regénérer</button>

    <x-security-sheets.table>
        <tr>
            <x-security-sheets.cell><strong>Sécurité de surface</strong></x-security-sheets.cell>
            <x-security-sheets.cell>{{$surfaceSecurity->US_FIRST_NAME}} {{$surfaceSecurity->US_NAME}}</x-security-sheets.cell>
        </tr>
        <tr>
            <x-security-sheets.cell><strong>Pilote</strong></x-security-sheets.cell>
            <x-security-sheets.cell>{{$driver->US_FIRST_NAME}} {{$driver->US_NAME}}</x-security-sheets.cell>
        </tr>
        <tr>
            <x-security-sheets.cell><strong>
                Observation
                <br> météo et marée
            </strong></x-security-sheets.cell>
            <x-security-sheets.cell>
                <input id="observation-field" class="bg-[#e6e6e6] border border-black" type="text" value="{{$dive->DS_OBSERVATION_FIELD}}">
            </x-security-sheets.cell>
        </tr>
    </x-security-sheets.table>
    
    @foreach ($divingGroups as $divingGroup)
        <x-security-sheets.table>
            @php
                $groupNumber = $divingGroup['group']->DG_NUMBER;
            @endphp

            <!-- Table's header -->
            <x-security-sheets.header><x-security-sheets.cell colspan="4"><strong>
                PALANQUEE n° {{$groupNumber}}
            </strong></x-security-sheets.cell></x-security-sheets.header>
            <!-- Start and ending hours -->
            <tr>
                <x-security-sheets.cell>Heure de départ</x-security-sheets.cell>
                <x-security-sheets.cell>
                    <input id="dg{{$groupNumber}}-start" class="dg-start border-2 border-solid border-gray-500" type="time" value="{{substr($divingGroup['group']->DG_BEGINNING_OF_DIVING_HOUR, 0, 5)}}">
                </x-security-sheets.cell>
                <x-security-sheets.cell>Heure de retour</x-security-sheets.cell>
                <x-security-sheets.cell>
                    <input id="dg{{$groupNumber}}-end" class="dg-end border-2 border-solid border-gray-500" type="time" value="{{substr($divingGroup['group']->DG_END_OF_DIVING_HOUR, 0, 5)}}">
                </x-security-sheets.cell>
            </tr>
    
            <!-- Expected time and depth -->
            <tr>
                <x-security-sheets.cell>Temps prévu (minutes)</x-security-sheets.cell>
                <x-security-sheets.cell>
                    <input id="dg{{$groupNumber}}-exp-time" class="dg-exp-time" type="number" value = "{{$divingGroup['group']->DG_MAX_DURATION}}">
                </x-security-sheets.cell>
                <x-security-sheets.cell>Profondeur prévue (mètres)</x-security-sheets.cell>
                <x-security-sheets.cell>
                    <input id="dg{{$groupNumber}}-exp-dep" class="dg-exp-dep" type="number" value = "{{$divingGroup['group']->DG_MAX_DEPTH}}">
                </x-security-sheets.cell>
            </tr>
    
            <!-- Actual time and depth -->
            <tr>
                <x-security-sheets.cell>Temps réalisé (minutes)</x-security-sheets.cell>
                <x-security-sheets.cell>
                    <input id="dg{{$groupNumber}}-act-time" class="dg-act-time" type="number" value = "{{$divingGroup['group']->DG_EFFECTIVE_DIVING_DURATION}}">
                </x-security-sheets.cell>
                <x-security-sheets.cell>Profondeur réalisée (mètres)</x-security-sheets.cell>
                <x-security-sheets.cell>
                    <input id="dg{{$groupNumber}}-act-dep" class="dg-act-dep" type="number" value = "{{$divingGroup['group']->DG_MAX_EFFECTIVE_DEPTH}}">
                </x-security-sheets.cell>
            </tr>
    
            <!-- Members table header -->
            <x-security-sheets.divers-header>
                <x-security-sheets.cell colspan="2"><strong>Prénom Nom</strong></x-security-sheets.cell>
                <x-security-sheets.cell>Aptitudes</x-security-sheets.cell>
                <x-security-sheets.cell><strong>Fonction</strong></x-security-sheets.cell>
            </x-security-sheets.divers-header>
    
            @foreach ($divingGroup['divers'] as $diver)
                <!-- A row for a single diver -->
                <tr>
                    <x-security-sheets.cell colspan="2">
                        {{$diver->US_NAME}} {{$diver->US_FIRST_NAME}}
                    </x-security-sheets.cell>
                    <x-security-sheets.cell>
                        {{$diver->PRE_CODE}}
                        @if($diver->US_TEACHING_LEVEL > 0)
                            / E{{$diver->US_TEACHING_LEVEL}}
                        @endif
                    </x-security-sheets.cell>
                    <x-security-sheets.cell>
                        {{$dive->getRoleForUser($diver)}}
                    </x-security-sheets.cell>
                </tr>
            @endforeach
        </x-security-sheets.table>
    @endforeach
</x-layout>