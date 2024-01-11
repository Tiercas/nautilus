<x-layout>
    <link href='https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.css' rel='stylesheet' />
    <textarea name="csrfToken" id="csrfToken" class="hidden">@csrf</textarea>
    <x-page-title>Plongée du {{ $dive->DS_DATE }} - {{ $dive->DL_NAME }}</x-page-title>
    <div class="text-right mb-4">
        <a href="javascript:history. back()"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Revenir en arrière
        </a>
    </div>

    <div class="flex flex-col md:flex-row gap-2 rounded-lg border shadow">
        <div class="flex-1 p-4">
            <h3 class="text-xl font-bold mb-2">Plongée</h3>
            <ul class="space-y-2 list-disc list-inside">
                <li>Date : {{ $dive->DS_DATE }} ({{ $dive->CAR_SCHEDULE }})</li>
                <li>Responsables :
                    <ul class="ps-5 mt-2 space-y-1 list-disc list-inside">
                        <li>Directeur de plongée : {{ $director->US_FIRST_NAME . " " . strtoupper($director->US_NAME) }}
                        </li>
                        <li>Sécurité de surface : {{ $security->US_FIRST_NAME . " " . strtoupper($security->US_NAME) }}
                        </li>
                    </ul>
                </li>
                <li>Nombre de plongeurs : {{ $dive->DS_DIVERS_COUNT }}</li>
                <li>Bateau : {{ $dive->BO_NAME }}</li>
                <!--<li>Observation : {{ $dive->DS_OBSERVATION_FIELD }}</li>-->
            </ul>
            @if(preg_match("/[0-9]*\.[0-9]*/", $dive->DL_LONGITUDE) == 1 && preg_match("/[0-9]*\.[0-9]*/",
            $dive->DL_LATITUDE) == 1)
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
                //map.addControl(new mapboxgl.ScaleControl());
                //map.addControl(new mapboxgl.FullscreenControl());
                map.on('idle', function () {
                    map.resize()
                })
            </script>
            @endif
            <p class="text-xl font-bold my-2">{{ $dive->DL_NAME }}@if (isset($dive->DS_MAX_DEPTH)) • {{
                $dive->DS_MAX_DEPTH }}m @endif</p>
        </div>
        <div class="flex-1 p-4">
            <h3 class="text-xl font-bold mb-2">Plongeurs</h3>
            <div class="sticky top-6">
                <p class="text-center italic">Déplacez les plongeurs vers les palanquées correspondantes</p>
                <div id="zoneStart" ondrop="drop(event)" ondragover="allowDrop(event)" class="text-center w-full p-4 pb-20 min-h-16 border rounded-lg bg-gray-200">

                </div>
            </div>

        </div>
        <div class="flex-1 p-4">
            <h3 class="text-xl font-bold mb-2">Palanquées</h3>
            <div class="grid grid-cols-2 md:grid-cols-1 gap-4" id="DropZone">

            </div>

            <div class="my-3 flex justify-center gap-2">
                <button type='button' id="removePal" class="mt-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6  h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                    </svg>
                </button>
                <button type='button' id="validatePal" class="mt-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Valider</button>
                <button type='button' id="addPal" class="mt-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="toast-success" class="hidden fixed right-8 bottom-8 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">Enregistrement de la palanquée effectué</div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
</x-layout>
<script src=" {{ asset('js/Palanque/manualPalanque.js') }} "></script>
