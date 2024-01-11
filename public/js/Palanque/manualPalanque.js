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

  updateCounterPos(number){
    this.counter += number;
  }

  updateCounterNeg(number){
    this.counter -= number;
  }
}

const zoneStart = document.getElementById("zoneStart");
const DropZone = document.getElementById("DropZone");
const removePalanque = document.getElementById("removePal");
const addPalanque = document.getElementById("addPal");
const validatePalanque = document.getElementById("validatePal");

let countZone = 0;
let countDiver = 0;
let zoneList = [];
let counterCheck = 0;
let disableVal = true;

getDiver("DS1").then(data => fillZoneWithAlreadyExistingPalanque(data));

window.onload = () => {
  setZoneSize(DropZone.childNodes);
}

function allowDrop(event) {
  event.preventDefault();
}

function drag(event) {
  event.dataTransfer.setData("draggable", event.target.id);
}

function drop(event) {
  event.preventDefault();
  let index = event.target.id.split('zone')[1];
  if(isElementInList('item', event.target.id.split(',')))
    return;

  let data = event.dataTransfer.getData("draggable");
  let draggedItem = document.getElementById(data);
  if(event.target === zoneStart){
    zoneList[draggedItem.parentElement.id.split('zone')[1]].updateCounterNeg(setDropZoneSize(draggedItem));
    console.log("Count" + zoneList[draggedItem.parentElement.id.split('zone')[1]].getCounter());
    zoneStart.appendChild(draggedItem);
  }else
    if(zoneList[index].getCounter() <= 3 && zoneList[index].getCounter() + setDropZoneSize(draggedItem) <= 3){
      if(draggedItem.parentElement !== zoneStart && draggedItem.parentElement !== undefined
        && draggedItem.parentElement !== zoneList[index])
        zoneList[draggedItem.parentElement.id.split('zone')[1]].updateCounterNeg(setDropZoneSize(draggedItem));
      zoneList[index].updateCounterPos(setDropZoneSize(draggedItem));
      console.log("Count" + zoneList[index].getCounter());
      event.target.appendChild(draggedItem);
    }
    // else{
    //   zoneStart.appendChild(draggedItem);
    //   zoneList[index].updateCounterNeg(setDropZoneSize(draggedItem));
    //   console.log("Count" + zoneList[index].getCounter());
    // }
}

function setZoneSize(zone){
  zone.forEach(element => {
    element.childNodes.forEach(elements => {
      console.log(elements);
      if(elements.id.split(',')[1] === 'PB')
        zoneList[element.id.split('zone')[1] ].updateCounterPos(2);
      else
        zoneList[element.id.split('zone')[1] ].updateCounterPos(1);
    });
  });
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
  let palanque = document.createElement("div");
  palanque.setAttribute("class", "border-2 p-4 zone");
  palanque.setAttribute("id", "zone" + countZone);
  palanque.setAttribute("ondrop", "drop(event)");
  palanque.setAttribute("ondragover", "allowDrop(event)");
  zoneList.push(new DropZoneClass(countZone));
  DropZone.appendChild(palanque);
  countZone++;
});

removePalanque.addEventListener("click", function(){
  countZone--;
  let palanque = document.getElementById("zone" + countZone);
  if(palanque.childElementCount > 0){
    sizeT = palanque.childElementCount;
    for(let i = 0; i < sizeT; i++){
      zoneStart.appendChild(palanque.childNodes[0]);
    }
  }
  zoneList.splice(zoneList.length - 1, 1);
  palanque.parentElement.removeChild(palanque);
});

async function getDiver(ds_code){
  let response = await fetch(`/api/dives/${ds_code}/divers`);
  let data = await response.json().then(data => proccessDiverData(data));
  return data;
}

function proccessDiverData(data){
  for(let i = 0; i < data.length; i++){
    countDiver++;
    let diver = document.createElement("div");
    diver.setAttribute("class", "w-fit h-8 border-2");
    diver.setAttribute("id", 'item' + data[i].US_ID +',' + data[i].PRE_CODE + ',E' + data[i].US_TEACHING_LEVEL + ',' + data[i].US_ID);
    diver.setAttribute("draggable", "true");
    diver.setAttribute("ondragstart", "drag(event)");
    diver.innerHTML = data[i].US_FIRST_NAME + " " + data[i].US_NAME + " " + data[i].PRE_CODE + " " + data[i].US_TEACHING_LEVEL;
    zoneStart.appendChild(diver);
  }
  return data;
}

let validatePalanqueCombinate = {
  'PB': ['E1', 'E2', 'E3', 'E4', 'PA-60-GP'],
  'PA': ['E1', 'E2', 'E3', 'E4', 'PA-60-GP'],
  'PO': ['E1', 'E2', 'E3', 'E4', 'PA-60-GP'],
  'PE-12': ['E2', 'E3', 'E4', 'PA-60-GP'],
  'PE-20': ['E2', 'E3', 'E4', 'PA-60-GP'],
  'PE-40': ['E2', 'E3', 'E4', 'PA-60-GP']
};

function validateAllCombination(){
  let counterCheck = 0;
  zoneList.forEach(element => {
    element = document.getElementById("zone" + element.getZoneNumber());
    if(element.hasChildNodes()){
      if(element.childElementCount < 2 || element.childElementCount > 3){
        element.style.backgroundColor = 'red';
        return false;
      }
      let children = element.childNodes;
      for(let i = 0; i < children.length; i++){
        for(let j = 0; j < children.length; j++){
          if(children[j].id.split(',')[1] === 'PA-60-GP'){
            counterCheck++;
            if(element.style.backgroundColor === 'red')
              element.style.backgroundColor = 'white';
            return true;
          }
        }
      }
      for(let i = 0; i < children.length; i++){
        {
          let targetItemsSplit = children[i].id.split(',')[2];
          for(targetItemsSplit in validatePalanqueCombinate){
            for(let j = 0; j < children.length; j++){
              let targetItemsSplit2 = children[j].id.split(',')[2];
              if(validatePalanqueCombinate[targetItemsSplit].includes(targetItemsSplit2)){
                counterCheck++;
                if(element.style.backgroundColor === 'red')
                  element.style.backgroundColor = 'white';
                return true;
              }
            }
            element.style.backgroundColor = 'red';
            return false;
          }
        }
        
      }
    }else {
      element.style.backgroundColor = 'white';
      return false;
    }
  });
  if(DropZone.childElementCount === counterCheck){
    disableVal = false;
    return true;
  }else {
    disableVal = true;
    return false;
  }
}



let interval = setInterval(function(){
  validateAllCombination();
}, 250);

validatePalanque.addEventListener("click", function(){
  if(!disableVal){
    sendPalanque();
    clearInterval(interval);
  }
    
});

function returnValueToPhp(ds_code) {
  let palanque = document.querySelectorAll("div.zone");
  let palanqueList = [];
  for (let i = 0; i < palanque.length; i++) {
    let zoneList = [];
    for (let j = 0; j < palanque[i].childElementCount; j++) {
      let item = palanque[i].childNodes[j];
      zoneList.push(item.id.split(',')[3]);
    }
    palanqueList.push(zoneList);
  }
  palanqueList.push(ds_code);
  return palanqueList;
}

function sendPalanque() {
  let palanqueList = returnValueToPhp("DS1");
  let palanqueListJson = JSON.stringify(palanqueList);
  let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  let xhr = new XMLHttpRequest();
  xhr.open('POST', '/api/palanques', true);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        console.log("Request successful");
        const responseData = JSON.parse(xhr.responseText);
        console.log("Additional Data:", responseData.additionalData);
      } else {
        const responseData = JSON.parse(xhr.responseText);
        console.error("Request failed", responseData.errData);
      }
    }
  };
  xhr.send(palanqueListJson);
  console.log("send");
}
function fillZoneWithAlreadyExistingPalanque(diverList) {
  diverList.forEach(element => {
    let diver = document.getElementById('item' + element.US_ID + ',' + element.PRE_CODE + ',E' + element.US_TEACHING_LEVEL + ',' + element.US_ID);
    if (element.DG_NUMBER !== 0 && element.DG_NUMBER !== null) {
      let dgNumber = element.DG_NUMBER - 1;
      let zone = document.getElementById("zone" + dgNumber);
      if (zone) {
        zone.appendChild(diver);
        if(zoneStart.contains(diver))
          zoneStart.removeChild(diver);
      }else{
        let palanque = document.createElement("div");
        palanque.setAttribute("class", "border-2 p-4 zone");
        palanque.setAttribute("id", "zone" + dgNumber);
        palanque.setAttribute("ondrop", "drop(event)");
        palanque.setAttribute("ondragover", "allowDrop(event)");
        zoneList.push(new DropZoneClass(dgNumber));
        DropZone.appendChild(palanque);
        palanque.appendChild(diver);
        if(zoneStart.contains(diver))
          zoneStart.removeChild(diver);
        countZone++;
      }
    }
  });
}
