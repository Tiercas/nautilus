<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
<x-layout>
    <x-page-title>Plongée du {{ $dive->DS_DATE }} - {{ $dive->DL_NAME }}</x-page-title>
    @dump($dive)
    @dump($divers)
    <div class="flex flex-col md:flex-row gap-2 rounded-lg border shadow">
        <div class="flex-1 border-r p-4">
            <h3 class="text-xl font-bold mb-2">Plongée</h3>
            <ul class="space-y-2 list-disc list-inside">
                <li>Date : {{ $dive->DS_DATE }} ({{ $dive->CAR_SCHEDULE }})</li>
                <li>Responsables :
                    <ul class="ps-5 mt-2 space-y-1 list-disc list-inside">
                        <li>Directeur de plongée : {{ $director->US_FIRST_NAME . " " . strtoupper($director->US_NAME) }}</li>
                        <li>Sécurité de surface : {{ $security->US_FIRST_NAME . " " . strtoupper($security->US_NAME) }}</li>
                    </ul>
                </li>
                <li>Profondeur max : {{ $dive->DS_MAX_DEPTH }}m</li>
                <li>Observation : {{ $dive->DS_OBSERVATION_FIELD }}</li>
                <li>Nombre de plongeurs : {{ $dive->DS_DIVERS_COUNT }}</li>
            </ul>
            <div id='map' style='width: 400px; height: 300px;'></div>
            <script>
                mapboxgl.accessToken = 'pk.eyJ1IjoiZ290Y2hldXIiLCJhIjoiY2xyOGFyMnlhMHlxMTJqcHF3NHVsdWJiaiJ9.0tkuFzJwXUn1XwTAwaLHng';
                const map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/gotcheur/clr8b55yw001v01pebzatbczl',
                    center: [{{ $dive->DL_LATITUDE }}, {{ $dive->DL_LONGITUDE }}],
                    zoom: 9
                });
            </script>
        </div>
        <div class="flex-1 border-r">
            <h3 class="text-xl font-bold">Plongeurs</h3>
        </div>
        <div class="flex-1">
            <h3 class="text-xl font-bold">Palanquées</h3>
        </div>
    </div>
</x-layout>
