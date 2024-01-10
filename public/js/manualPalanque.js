const zoneStart = document.getElementById("zone1");
function allowDrop(event) {
  event.preventDefault();
}

function drag(event) {
  event.dataTransfer.setData("draggable", event.target.id);
}

function drop(event) {
  event.preventDefault();
  if(isElementInList('item', event.target.id.split(',')))
    return;

  console.log(event.dataTransfer.getData("draggable"));
  let data = event.dataTransfer.getData("draggable");
  let draggedItem = document.getElementById(data);
  if(event.target === zoneStart)
    zoneStart.appendChild(draggedItem);
  else
    if(event.target.childNodes.length - getDropZoneSize(event.target, event.target.children) <= 3){
      event.target.appendChild(draggedItem);
    }else
      zoneStart.appendChild(draggedItem);
}

function getDropZoneSize(targetZone, targetItems){
  for(let i = 0; i < targetItems.length; i++){
    let targetItemsSplit = targetItems[i].id.split(',');
    for(let j = 0; j < targetItemsSplit.length; j++){
      if(targetItemsSplit[j] === 'PB')
        return 2;
    }
  }
  return 3;
}

function isElementInList(element, list){
  for(let i = 0; i < list.length; i++){
    if(element == list[i])
      return true;
  }
  return false;
}