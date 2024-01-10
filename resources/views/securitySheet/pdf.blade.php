<h1>FICHE DE SÉCURITÉ</h1>

<table id="first-table">
    <tr>
        <td>Date</td>
        <td>{{$dive->DS_DATE}}</td>
    </tr>
    <tr>
        <td>Directeur de plongée</td>
        <td>{{$director->US_FIRST_NAME}} {{$director->US_NAME}}</td>
    </tr>
    <tr>
        <td>Site de plongée</td>
        <td>{{$location->DL_NAME}}</td>
    </tr>
</table>

<table>
    <tr>
        <td>Sécurité de surface</td>
        <td>{{$surfaceSecurity->US_FIRST_NAME}} {{$surfaceSecurity->US_NAME}}</td>
    </tr>
    <tr>
        <td>
            Observation
            <br>> météo et marée
        </td>
        <td>{{$dive->DS_OBSERVATION_FIELD}}</td>
    </tr>
</table>

@foreach ($divingGroups as $divingGroup)
    @php
    $groupNum = Str::substr($divingGroup['group']->DG_NUMBER, 2);
    @endphp

    <x-security-sheets.diving-group-table groupNum="{{$groupNum}}">
        <!-- Start and ending hours -->
        <tr>
            <td>Heure de départ</td>
            <td>{{$divingGroup['group']->DG_BEGINNING_OF_DIVING_HOUR}}</td>
            <td>Heure de retour</td>
            <td>{{$divingGroup['group']->DG_END_OF_DIVING_HOUR}}</td>
        </tr>

        <!-- Expected time and depth -->
        <tr>
            <td>Temps prévu</td>
            <td>{{$divingGroup['group']->DG_MAX_DURATION}} min</td>
            <td>Profondeur prévue</td>
            <td>[il manque la profondeur prévue :(]</td>
        </tr>

        <!-- Actual time and depth -->
        <tr>
            <td>Temps réalisé</td>
            <td>{{$divingGroup['group']->DG_EFFECTIVE_DIVING_DURATION}} min</td>
            <td>Profondeur réalisée</td>
            <td>{{$divingGroup['group']->DG_MAX_EFFECTIVE_DEPTH}} m</td>
        </tr>

        <!-- Members table header -->
        <tr>
            <td colspan="2"><strong>Nom Prénom</strong></td>
            <td>Aptitudes</td>
            <td><strong>Fonction</strong></td>
        </tr>

        @foreach ($divingGroup['divers'] as $diver)
            <!-- A row for a single diver -->
            <tr>
                <td colspan="2">
                    {{$diver->US_NAME}} {{$diver->US_FIRST_NAME}}
                </td>
                <td>{{$diver->PRE_CODE}}</td>
                <td>
                    @if($diver->US_ID === 5)
                        <!--dd($diver->roles)-->
                    @endif

                    @if($diver->hasRole('DIR'))
                        Directeur de plongée
                    @else
                        Plongeur
                    @endif
                </td>
            </tr>
        @endforeach
    </x-security-sheets.diving-group-table>
@endforeach