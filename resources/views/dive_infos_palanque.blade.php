
<link href='https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.css' rel='stylesheet' />

<x-layout>
    <x-page-title>Plongée du {{ $dive->DS_DATE }} - {{ $dive->DL_NAME }}</x-page-title>
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
                <li>Bateau : {{ $dive->BO_NAME }}</li>
                <li>Observation : {{ $dive->DS_OBSERVATION_FIELD }}</li>
                <li>Nombre de plongeurs : {{ $dive->DS_DIVERS_COUNT }}</li>
            </ul>
            @if(preg_match("/[0-9]*\.[0-9]*/", $dive->DL_LONGITUDE) == 1 && preg_match("/[0-9]*\.[0-9]*/", $dive->DL_LATITUDE) == 1)
                <div id='map' class="shadow rounded-lg w-full mt-4 aspect-video"></div>
                <script src='https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.js'></script>
                <style>
                    div.mapboxgl-ctrl-bottom-right {
                        display: none;
                    }
                </style>
                <script>
                    mapboxgl.accessToken = 'pk.eyJ1IjoiZ290Y2hldXIiLCJhIjoiY2xyOGFyMnlhMHlxMTJqcHF3NHVsdWJiaiJ9.0tkuFzJwXUn1XwTAwaLHng';
                    const map = new mapboxgl.Map({
                        container: 'map',
                        style: 'mapbox://styles/gotcheur/clr8b55yw001v01pebzatbczl',
                        center: [{{ $dive->DL_LONGITUDE }}, {{ $dive->DL_LATITUDE }}],
                        zoom: 12
                    });
                    const diveLocation = new mapboxgl.Marker()
                        .setLngLat([{{ $dive->DL_LONGITUDE }}, {{ $dive->DL_LATITUDE }}])
                        .addTo(map);
                    map.addControl(new mapboxgl.NavigationControl());
                    map.addControl(new mapboxgl.ScaleControl());
                </script>
            @endif
            <p class="text-xl font-bold my-2">{{ $dive->DL_NAME }} • {{ $dive->DS_MAX_DEPTH }}m</p>
        </div>
        <div class="flex-1 border-r">
            <h3 class="text-xl font-bold">Plongeurs</h3>
        </div>
        <div class="flex-1">
            <h3 class="text-xl font-bold">Palanquées</h3>
        </div>
    </div>
</x-layout>
