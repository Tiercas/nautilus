<page>
    <style>
        h1{
            text-align: center;
        }

        table, th, td{
            border: solid black 1px;
            border-collapse: collapse;
        }

        table{
            margin-bottom: 5px;
        }

        td{
            padding: 2px;
        }

        .members-header{
            background-color: lightgrey;
        }

        .diving-group-header{
            background-color: #afafaf;
        }
    </style>

    <h1>FICHE DE SÉCURITÉ</h1>

    <table>
        <colgroup>
            <col width="135">
            <col width="225">
        </colgroup>
        <tr>
            <td><strong>Date</strong></td>
            <td>{{$dive->DS_DATE}}</td>
        </tr>
        <tr>
            <td><strong>Directeur de plongée</strong></td>
            <td>{{$director->US_FIRST_NAME}} {{$director->US_NAME}}</td>
        </tr>
        <tr>
            <td><strong>Site de plongée</strong></td>
            <td>{{$location->DL_NAME}}</td>
        </tr>
    </table>

    <table>
        <colgroup>
            <col width="135">
            <col width="592">
        </colgroup>
        <tr>
            <td><strong>Sécurité de surface</strong></td>
            <td>{{$surfaceSecurity->US_FIRST_NAME}} {{$surfaceSecurity->US_NAME}}</td>
        </tr>
        <tr>
            <td><strong>Pilote</strong></td>
            <td>{{$driver->US_FIRST_NAME}} {{$driver->US_NAME}}</td>
        </tr>
        <tr>
            <td><strong>
                Observation
                <br>> météo et marée
            </strong></td>
            <td>{{$dive->DS_OBSERVATION_FIELD}}</td>
        </tr>
    </table>

    @php
    $i = 0;
    @endphp

    @foreach ($divingGroups as $divingGroup)
        <x-security-sheets.diving-group-table groupNum="{{$divingGroup['group']->DG_NUMBER}}">
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
                <td>
                    @unless(is_null($divingGroup['group']->DG_MAX_DURATION))
                        {{$divingGroup['group']->DG_MAX_DURATION}} min
                    @endunless
                </td>
                <td>Profondeur prévue</td>
                <td>
                    @unless(is_null($divingGroup['group']->DG_MAX_DEPTH))
                        {{$divingGroup['group']->DG_MAX_DEPTH}} m
                    @endunless
                </td>
            </tr>

            <!-- Actual time and depth -->
            <tr>
                <td>Temps réalisé</td>
                <td>
                    @unless(is_null($divingGroup['group']->DG_EFFECTIVE_DIVING_DURATION))
                        {{$divingGroup['group']->DG_EFFECTIVE_DIVING_DURATION}} min
                    @endunless
                </td>
                <td>Profondeur réalisée</td>
                <td>
                    @unless(is_null($divingGroup['group']->DG_MAX_EFFECTIVE_DEPTH))
                        {{$divingGroup['group']->DG_MAX_EFFECTIVE_DEPTH}} m
                    @endunless
                </td>
            </tr>

            <!-- Members table header -->
            <tr class="members-header">
                <td colspan="2"><strong>Prénom Nom</strong></td>
                <td>Aptitudes</td>
                <td><strong>Fonction</strong></td>
            </tr>

            @foreach ($divingGroup['divers'] as $diver)
                <!-- A row for a single diver -->
                <tr>
                    <td colspan="2">
                        {{$diver->US_NAME}} {{$diver->US_FIRST_NAME}}
                    </td>
                    <td>
                        {{$diver->PRE_CODE}}
                        @if($diver->US_TEACHING_LEVEL > 0)
                            / E{{$diver->US_TEACHING_LEVEL}}
                        @endif
                    </td>
                    <td>
                        {{$dive->getRoleForUser($diver)}}
                    </td>
                </tr>
            @endforeach
        </x-security-sheets.diving-group-table>

        @php
            $i++;
        @endphp

        <!-- 
            Inserting a page break by closing the page tag and opening a new one 
            (there's a closing tag at the end of the file). 
        -->
        @if($i % 5 == 0)
            </page><page>
        @endif
    @endforeach
</page>