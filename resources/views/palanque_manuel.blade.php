<meta name="csrf-token" content="{{ $token }}">
<x-layout>
  <div class="flex justify-around m-5">
  <div class="grid grid-cols-1">
    <h3>Zone 1</h3>
    <div class="border-2" id="zoneStart" ondrop="drop(event)" ondragover="allowDrop(event)">
    </div>
  </div>

  <div class="p-2 grid grid-cols-2 md:grid-cols-3 gap-4" id="DropZone">
  </div>
  </div>
  <button type='button' id="addPal">Add P</button>
  <button type='button' id="removePal">Remove P</button>
  <button type='button' id="validatePal">Val</button>
<script src=" {{ asset('js/Palanque/manualPalanque.js') }} "></script>
</x-layout>
