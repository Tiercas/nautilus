<x-layout>
  <div class="flex justify-around m-5">
  <div class="p-2 w-32 h-52">
    <h3>Zone 1</h3>
    <div class="border-2 p-4" id="zone1" ondrop="drop(event)" ondragover="allowDrop(event)">
      <div class="w-fit h-8 border-2" id="item,1,PB" draggable="true" ondragstart="drag(event)">Item 1</div>
      <div class="w-fit h-8 border-2" id="item,2" draggable="true" ondragstart="drag(event)">Item 2</div>
      <div class="w-fit h-8 border-2" id="item,3" draggable="true" ondragstart="drag(event)">Item 3</div>
      <div class="w-fit h-8 border-2" id="item,4" draggable="true" ondragstart="drag(event)">Item 4</div>
    </div>
  </div>

  <div class="p-2 w-32 h-52">
    <h3>Zone 2</h3>
    <div class="border-2 p-4" id="zone1" ondrop="drop(event)" ondragover="allowDrop(event)">
    </div>
  </div>
  </div>
<script src=" {{ asset('js/manualPalanque.js') }} "></script>
</x-layout>
