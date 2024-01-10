<meta name="csrf-token" content="{{ $token }}">
<x-layout>
  <div class="flex justify-around m-5">
  <div class="p-2 grid grid-cols-5">
    <h3>Zone 1</h3>
    <div class="border-2 p-4" id="zoneStart" ondrop="drop(event)" ondragover="allowDrop(event)">
    <div class="w-fit h-8 border-2" id="item1,PA" draggable="true" ondragstart="drag(event)">PA</div>
    <div class="w-fit h-8 border-2" id="item2,PB" draggable="true" ondragstart="drag(event)">PB</div>
    <div class="w-fit h-8 border-2" id="item3,PO" draggable="true" ondragstart="drag(event)">PO</div>
    <div class="w-fit h-8 border-2" id="item4,PA-12" draggable="true" ondragstart="drag(event)">PA-12</div>
    <div class="w-fit h-8 border-2" id="item5,PE-20" draggable="true" ondragstart="drag(event)">PE-20</div>
    <div class="w-fit h-8 border-2" id="item6,PE-40" draggable="true" ondragstart="drag(event)">PE-40</div>
    <div class="w-fit h-8 border-2" id="item7,PA-40" draggable="true" ondragstart="drag(event)">PA-40</div>
    <div class="w-fit h-8 border-2" id="item8,PA-60" draggable="true" ondragstart="drag(event)">PA-60</div>
    <div class="w-fit h-8 border-2" id="item9,PE-60" draggable="true" ondragstart="drag(event)">PE-60</div>
    <div class="w-fit h-8 border-2" id="item10,E1" draggable="true" ondragstart="drag(event)">E1</div>
    <div class="w-fit h-8 border-2" id="item11,E2" draggable="true" ondragstart="drag(event)">E2</div>
    <div class="w-fit h-8 border-2" id="item12,E3" draggable="true" ondragstart="drag(event)">E3</div>
    <div class="w-fit h-8 border-2" id="item13,E4" draggable="true" ondragstart="drag(event)">P4</div>
    </div>
  </div>

  <div class="p-2 grid grid-cols-2 md:grid-cols-3 gap-4" id="DropZone">
    <div class="border-2 p-4 zone" id="zone0" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div class="border-2 p-4 zone" id="zone1" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div class="border-2 p-4 zone" id="zone2" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
  </div>
  </div>
  <button type='button' id="addPal">Add P</button>
  <button type='button' id="removePal">Remove P</button>
  <button type='button' id="validatePal">Val</button>
<script src=" {{ asset('js/Palanque/manualPalanque.js') }} "></script>
</x-layout>
