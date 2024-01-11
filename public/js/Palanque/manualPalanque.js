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

let countZone = 2;
let countDiver = 5;
let zoneList = [new DropZoneClass(0), new DropZoneClass(1), new DropZoneClass(2)];
let counterCheck = 0;

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
  console.log(draggedItem);
  if(event.target === zoneStart){
    zoneList[draggedItem.parentElement.id.split('zone')[1]].updateCounterNeg(setDropZoneSize(draggedItem));
    zoneStart.appendChild(draggedItem);
  }else
    if(zoneList[index].getCounter() < 3 && zoneList[index].getCounter() + setDropZoneSize(draggedItem) <= 3){
      zoneList[index].updateCounterPos(setDropZoneSize(draggedItem));
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
  palanque.setAttribute("class", "border-2 p-4 zone");
  palanque.setAttribute("id", "zone " + (countZone));
  palanque.setAttribute("ondrop", "drop(event)");
  palanque.setAttribute("ondragover", "allowDrop(event)");
  zoneList.push(new DropZoneClass(countZone));
  DropZone.appendChild(palanque);
});

removePalanque.addEventListener("click", function(){
  let palanque = document.getElementById("zone" + (countZone));
  countZone--;
  if(palanque.hasChildNodes()){
    let children = palanque.childNodes;
    for(let i = 0; i < children.length; i++){
      zoneStart.appendChild(children[i]);
    }
  }
  zoneList.splice(zoneList.length - 1, 1);
  DropZone.removeChild(palanque);
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
    diver.setAttribute("id", 'item' + countDiver +',' + data[i].PRE_CODE + ',E' + data[i].US_TEACHING_LEVEL + ',' + data[i].US_ID);
    diver.setAttribute("draggable", "true");
    diver.setAttribute("ondragstart", "drag(event)");
    diver.innerHTML = data[i].US_FIRST_NAME + " " + data[i].US_NAME + " " + data[i].PRE_CODE + " " + data[i].US_TEACHING_LEVEL;
    zoneStart.appendChild(diver);
  }
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
  zoneList.forEach(element => {
    element = document.getElementById("zone" + element.getZoneNumber());
    if(element.hasChildNodes()){
      if(element.childElementCount < 2)
        return false;
      let children = element.childNodes;
      for(let i = 0; i < children.length; i++){
        let targetItemsSplit = children[i].id.split(',')[1];
        for(targetItemsSplit in validatePalanqueCombinate){
          for(let j = 0; j < children.length; j++){
            let targetItemsSplit2 = children[j].id.split(',')[1];
            console.log(targetItemsSplit2);
            if(validatePalanqueCombinate[targetItemsSplit].includes(targetItemsSplit2)){
              console.log("ok");
              if(element.style.backgroundColor === 'red')
                element.style.backgroundColor = 'white';
              return true;
              //TODO VERIF E1 -6metres
            }
          }
          console.log("ko");
          element.style.backgroundColor = 'red';
          return false;
        }
      }
    }
  });
}


let interval = setInterval(() => {
  validateAllCombination();
}, 5000);


validatePalanque.addEventListener("click", function(){
  sendPalanque();
  clearInterval(interval);
});

function returnValueToPhp(ds_code) {
  let palanque = document.querySelectorAll("div.zone");
  console.log(palanque);
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
  console.log(palanqueList);
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

        // Log the additional data in the console
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

getDiver('DS1');
