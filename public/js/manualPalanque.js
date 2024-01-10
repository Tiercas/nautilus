class DropZoneClass{
  counter;
  zoneNumber;

  constructor(zoneNumber){
    this.counter = 0;
    this.zoneNumber = zoneNumber;
  }

  getCounter(){
    return this.counter;
  }

  getZoneNumber(){
    return this.zoneNumber;
  }

  updateCounter(number){
    this.counter += number;
  }
}

const zoneStart = document.getElementById("zoneStart");
const DropZone = document.getElementById("DropZone");
const removePalanque = document.getElementById("removePal");
const addPalanque = document.getElementById("addPal");
let countZone = 3;
let zoneList = [new DropZoneClass(zone1), new DropZoneClass(zone2), new DropZoneClass(zone3)];
function allowDrop(event) {
  event.preventDefault();
}

function drag(event) {
  event.dataTransfer.setData("draggable", event.target.id);
}

function drop(event) {
  event.preventDefault();
  console.log(zoneList);
  if(isElementInList('item', event.target.id.split(',')))
    return;

  let data = event.dataTransfer.getData("draggable");
  let draggedItem = document.getElementById(data);
  if(event.target === zoneStart){
    zoneStart.appendChild(draggedItem);
    zoneList[event.target].getCounter -= setDropZoneSize(draggedItem);
  }else
    if(count < 3 && count + setDropZoneSize(draggedItem) <= 3){
      zoneList[event.target].updateCounter(setDropZoneSize(draggedItem));
      event.target.appendChild(draggedItem);
    }else
      zoneStart.appendChild(draggedItem);
}

function setDropZoneSize(element){
  let targetItemsSplit = element.id.split(',');
  for(let i = 0; i < targetItemsSplit.length; i++){
    if(targetItemsSplit[i] === 'PB')
      return 2;
  }
  return 1;
}

function isElementInList(element, list){
  for(let i = 0; i < list.length; i++){
    if(element == list[i])
      return true;
  }
  return false;
}

addPalanque.addEventListener("click", function(){
  countZone++;
  let palanque = document.createElement("div");
  palanque.setAttribute("class", "border-2 p-4");
  palanque.setAttribute("id", "zone" + (countZone));
  palanque.setAttribute("ondrop", "drop(event)");
  palanque.setAttribute("ondragover", "allowDrop(event)");
  zoneList.push(new DropZoneClass("zone"+countZone));
  DropZone.appendChild(palanque);
});

removePalanque.addEventListener("click", function(){
  let palanque = document.getElementById("zone" + (countZone));
  countZone--;
  DropZone.removeChild(palanque);
});