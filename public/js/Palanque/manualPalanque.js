class DropZoneClass {
    counter;
    zoneNumber;

    constructor(zoneNumber) {
        this.counter = 0;
        this.zoneNumber = zoneNumber;
    }

    getCounter() {
        return this.counter;
    }

    getZoneNumber() {
        return this.zoneNumber;
    }

    updateCounterPos(number) {
        this.counter += number;
    }

    updateCounterNeg(number) {
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
let ds_code = document.getElementById("ds_code").textContent;
getDiver(ds_code).then((data) => fillZoneWithAlreadyExistingPalanque(data));

window.onload = () => {
    setZoneSize(DropZone.childNodes);
};

function allowDrop(event) {
    event.preventDefault();
}

function drag(event) {
    event.dataTransfer.setData("draggable", event.target.id);
}

// function drop(event) {
//     event.preventDefault();
//     let index = event.target.id.split("zone")[1];
//     if (isElementInList("item", event.target.id.split(","))) return;

//     let data = event.dataTransfer.getData("draggable");
//     let draggedItem = document.getElementById(data);
//     if (event.target === zoneStart) {
//         zoneList.forEach((element) => {
//             // console.log(element.getZoneNumber());
//             // console.log(draggedItem.parentElement.id.split("zone")[1]);
//             if (
//                 element.getZoneNumber() ==
//                 draggedItem.parentElement.id.split("zone")[1]
//             ) {
//                 element.updateCounterNeg(setDropZoneSize(draggedItem));
//                 console.log("Count" + element.getCounter());
//             }
//         });
//         //console.log("Count" + zoneList[draggedItem.parentElement.id.split('zone')[1]].getCounter());
//         zoneStart.appendChild(draggedItem);
//     } else {
//         zoneA = zoneList[0];
//         zoneList.forEach((element) => {
//             if (element.getZoneNumber() == index) {
//                 zoneA = element;
//             }
//         });
//         console.log(zoneA.getCounter());
//         console.log(zoneA.getCounter() + setDropZoneSize(draggedItem));
//         if (
//             zoneA.getCounter() <= 3 &&
//             zoneA.getCounter() + setDropZoneSize(draggedItem) <= 3
//         ) {
//             console.log("test");
//             if (
//                 draggedItem.parentElement !== zoneStart &&
//                 draggedItem.parentElement !== undefined &&
//                 draggedItem.parentElement !== zoneA
//             ) {
//                 zoneList.forEach((element) => {
//                     if (
//                         element.getZoneNumber() ==
//                         draggedItem.parentElement.id.split("zone")[1]
//                     ) {
//                         console.log("Count" + element.getCounter());
//                         element.updateCounterNeg(setDropZoneSize(draggedItem));
//                     }
//                 });
//             }
//             zoneA.updateCounterPos(setDropZoneSize(draggedItem));
//             //console.log("Count" + zoneList[index].getCounter());
//             event.target.appendChild(draggedItem);
//         }
//     }
// }

function drop(event) {
    event.preventDefault();
    if (isElementInList("item", event.target.id.split(","))) return;

    let data = event.dataTransfer.getData("draggable");
    let draggedItem = document.getElementById(data);
    let index = event.target.id.split("zone")[1];

    if (event.target === zoneStart) {
        zoneList.forEach((element) => {
            if (
                element.getZoneNumber() ==
                draggedItem.parentElement.id.split("zone")[1]
            ) {
                element.updateCounterNeg(setDropZoneSize(draggedItem));
            }
        });
        zoneStart.appendChild(draggedItem);
        return;
    }
    if (draggedItem.parentElement == zoneStart) {
        zoneList.forEach((element) => {
            if (element.getZoneNumber() == index) {
                element.updateCounterPos(setDropZoneSize(draggedItem));
            }
        });
        event.target.appendChild(draggedItem);
        return;
    }
    if (draggedItem.parentElement !== event.target) {
        zoneList.forEach((element) => {
            if (
                element.getZoneNumber() ==
                draggedItem.parentElement.id.split("zone")[1]
            ) {
                element.updateCounterNeg(setDropZoneSize(draggedItem));
            }
        });
        zoneList.forEach((element) => {
            if (element.getZoneNumber() == index) {
                element.updateCounterPos(setDropZoneSize(draggedItem));
            }
        });
        event.target.appendChild(draggedItem);
        return;
    }
}

function setZoneSize(zone) {
    zone.forEach((element) => {
        element.childNodes.forEach((elements) => {
            //console.log(elements);
            if (elements.id.split(",")[1] === "PB") {
                zoneList.forEach((element) => {
                    if (
                        element.getZoneNumber() ==
                        elements.parentElement.id.split("zone")[1]
                    ) {
                        element.updateCounterPos(2);
                    }
                });
            } else {
                zoneList.forEach((element) => {
                    if (
                        element.getZoneNumber() ==
                        elements.parentElement.id.split("zone")[1]
                    ) {
                        element.updateCounterPos(1);
                    }
                });
            }
        });
    });
}

function setDropZoneSize(element) {
    let targetItemsSplit = element.id.split(",");
    for (let i = 0; i < targetItemsSplit.length; i++) {
        if (targetItemsSplit[i] === "PB") return 2;
    }
    return 1;
}

function isElementInList(element, list) {
    for (let i = 0; i < list.length; i++) {
        if (element == list[i]) return true;
    }
    return false;
}

addPalanque.addEventListener("click", function () {
    let palanque = document.createElement("div");
    let palanqueeTitle = document.createElement("h3");
    palanqueeTitle.addEventListener("click", function () {
        let nbZone = this.parentElement.id.split("zone")[1];
        // console.log(palanqueeTitle, parseInt(nbZone)+1);
        removePalanqueZone(parseInt(nbZone) + 1);
    });
    let divContainer = document.createElement("div");
    divContainer.appendChild(palanqueeTitle);
    palanque.setAttribute(
        "class",
        "border text-center bg-gray-200 rounded-lg p-3 pb-20 zone"
    );
    zoneList.forEach((element) => {
        if (element.getZoneNumber() == countZone) {
            countZone++;
        }
    });
    conditionD = false;
    palanque.setAttribute("id", "zone" + countZone);
    palanqueeTitle.innerHTML =
        "Palanquée " +
        (countZone + 1) +
        " - " +
        '<div class="delete-btn cursor-pointer inline underline">Supprimer</div>';
    palanque.setAttribute("ondrop", "drop(event)");
    palanque.setAttribute("ondragover", "allowDrop(event)");
    zoneList.push(new DropZoneClass(countZone));
    divContainer.appendChild(palanque);
    DropZone.appendChild(divContainer);
    countZone++;
    // console.log(zoneList);
});

removePalanque.addEventListener("click", function () {
    let nbZone = prompt(
        "Veuillez entrer le numéro de la palanque à supprimer",
        "1"
    );
    removePalanqueZone(nbZone);
});

function removePalanqueZone(nbZone) {
    countZone--;
    let palanque = document.querySelector(
        "#DropZone > div:nth-child(" + nbZone + ") > div"
    );
    // console.log(
    // document.querySelector(
    // "#DropZone > div:nth-child(" + nbZone + ") > div"
    // )
    // );
    if (palanque.childElementCount > 0) {
        sizeT = palanque.childElementCount;
        for (let i = 0; i < sizeT; i++) {
            zoneStart.appendChild(palanque.childNodes[0]);
        }
    }
    zoneList.forEach((element) => {
        if (element.getZoneNumber() == nbZone) {
            zoneList.splice(zoneList.indexOf(element), 1);
        }
    });
    let palanqueContainer = document.querySelector(
        "#DropZone > div:nth-child(" + nbZone + ")"
    );
    palanqueContainer.parentElement.removeChild(palanqueContainer);
    palanque.parentElement.removeChild(palanque);
    updateZoneList();
}

function updateZoneList() {
    zoneList = [];
    let dropZones = document.querySelectorAll("#DropZone > div");
    let k = 0;
    dropZones.forEach((element) => {
        element.id = "zone" + k;
        // console.log(element);
        if (
            element.innerHTML ===
            "Palanquée " +
                (k + 2) +
                " - " +
                '<div class="cursor-pointer inline underline">Supprimer</div>'
        ) {
            element.innerHTML =
                "Palanquée " +
                (k + 1) +
                " - " +
                '<div class="cursor-pointer inline underline">Supprimer</div>';
        } else {
            element.querySelector("h3").innerHTML =
                "Palanquée " +
                (k + 1) +
                " - " +
                '<div class="cursor-pointer inline underline">Supprimer</div>';
            zoneList.push(new DropZoneClass(k));
            let compteurM = 0;
            let divers = element.querySelectorAll("div > div.h-8");
            // console.log(divers);
            divers.forEach((elementE) => {
                // console.log(elementE);
                // console.log("COunter"+ compteurM);

                if (elementE.id.split(",")[1] === "PB") {
                    compteurM += 2;
                } else {
                    compteurM++;
                }
            });
            // console.log(compteurM);
            zoneList[k].updateCounterPos(compteurM);
            k++;
        }
    });
}

/**
 * To-Do
 *
 * 1. Faire fonctionner la suppression des palanquées en gérant l'ID de ces dernières qui est inconsistent
 */

async function getDiver(ds_code) {
    let response = await fetch(`/api/dives/${ds_code}/divers`);
    let data = await response.json().then((data) => proccessDiverData(data));
    return data;
}

function proccessDiverData(data) {
    //console.log(data);
    for (let i = 0; i < data.length; i++) {
        countDiver++;
        let diver = document.createElement("div");
        diver.setAttribute("class", "h-8 border rounded p-1 m-1 bg-gray-300");
        diver.setAttribute(
            "id",
            "item" +
                data[i].US_ID +
                "," +
                data[i].PRE_CODE +
                ",E" +
                data[i].US_TEACHING_LEVEL +
                "," +
                data[i].US_ID
        );
        diver.setAttribute("draggable", "true");
        diver.setAttribute("ondragstart", "drag(event)");
        diver.innerHTML =
            data[i].US_FIRST_NAME +
            " " +
            data[i].US_NAME.toUpperCase() +
            " - " +
            data[i].PRE_CODE +
            " - E" +
            data[i].US_TEACHING_LEVEL;
        zoneStart.appendChild(diver);
    }
    return data;
}

let validatePalanqueCombinate = {
    "PB": ["E1", "E2", "E3", "E4", "PA-60-GP"],
    "PA": ["E1", "E2", "E3", "E4", "PA-60-GP"],
    "PO": ["E1", "E2", "E3", "E4", "PA-60-GP"],
    "PE-12": ["E2", "E3", "E4", "PA-60-GP"],
    "PE-20": ["E2", "E3", "E4", "PA-60-GP"],
    "PE-40": ["E2", "E3", "E4", "PA-60-GP"],
};

function validateAllCombination() {
    let counterCheck = 0;
    let valid = true;
    zoneList.forEach((elementA) => {
        // element = document.querySelector("#zone" + element.getZoneNumber() + " > div");
        zoneElement = document.querySelector(
            "#zone" + elementA.getZoneNumber() + ".zone"
        );

        // console.log(zoneElement);
        if (zoneElement == null) return;
        if (zoneElement.hasChildNodes()) {
            if (
                zoneElement.childElementCount < 2 ||
                zoneElement.childElementCount > 3
            ) {
                zoneElement.style.backgroundColor = "rgb(254 202 202)";
                console.log("taille");
                valid = false;
                return;
            }
            zoneElement.childNodes.forEach((elementB) => {
                if (
                    elementB.id.split(",")[1] === "PB" &&
                    zoneElement.childElementCount != 2
                ) {
                    zoneElement.style.backgroundColor = "rgb(254 202 202)";
                    console.log("PB");
                    valid = false;
                    return;
                }
            });
            let children = zoneElement.childNodes;
            for (let i = 0; i < children.length; i++) {
                if (children[i].id.split(",")[1] === "PA-60-GP") {
                    counterCheck++;
                    zoneElement.style.backgroundColor = "rgb(229 231 235)";
                    valid = true;
                    return;
                }
            }
            for (let i = 0; i < children.length; i++) {
                if (children[i].id.split(",")[1] === "PB" && children.length > 2) {
                    zoneElement.style.backgroundColor = "rgb(254 202 202)";
                    console.log("PB");
                    valid = false;
                    return;
                }
                let targetItemsSplit = children[i].id.split(",")[2];
                for (targetItemsSplit in validatePalanqueCombinate) {
                    for (let j = 0; j < children.length; j++) {
                        let targetItemsSplit2 = children[j].id.split(",")[2];
                        if (
                            validatePalanqueCombinate[
                                targetItemsSplit
                            ].includes(targetItemsSplit2)
                        ) {
                            counterCheck++;
                            zoneElement.style.backgroundColor =
                                "rgb(229 231 235)";
                            valid = true;
                            return;
                        }
                    }
                    zoneElement.style.backgroundColor = "rgb(254 202 202)";
                    console.log("combi ", targetItemsSplit);
                    valid = false;
                    return;
                }
            }

        } else {
            zoneElement.style.backgroundColor = "rgb(229 231 235)";
            console.log("vide");
            valid = false;
            return;
        }
    });
}

let interval = setInterval(function () {
    updateZoneList();
    validateAllCombination();
    console.log(disableVal);
    disableVal = false;
    document.querySelectorAll("#DropZone > div > div").forEach((element) => {
        if (element.style.backgroundColor === "rgb(254, 202, 202)" || zoneStart.childElementCount > 0) {
            disableVal = true;
            return;
        }
    });
}, 250);

validatePalanque.addEventListener("click", function () {
    if (!disableVal) {
        sendPalanque();
        // clearInterval(interval);
    }
});

function returnValueToPhp(ds_code) {
    let palanque = document.querySelectorAll("div.zone");
    let palanqueList = [];
    for (let i = 0; i < palanque.length; i++) {
        let zoneList = [];
        for (let j = 0; j < palanque[i].childElementCount; j++) {
            let item = palanque[i].childNodes[j];
            zoneList.push(item.id.split(",")[3]);
        }
        palanqueList.push(zoneList);
    }
    palanqueList.push(ds_code);
    return palanqueList;
}

function sendPalanque() {
    let palanqueList = returnValueToPhp(ds_code);
    let palanqueListJson = JSON.stringify(palanqueList);
    let csrfToken = document.getElementById("csrfToken").textContent;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/api/palanques", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("Request successful");
                const responseData = JSON.parse(xhr.responseText);
                console.log("Additional Data:", responseData.additionalData);
                document
                    .getElementById("toast-success")
                    .classList.remove("hidden");
                document
                    .getElementById("toast-success")
                    .classList.remove("opacity-0");
            } else {
                const responseData = JSON.parse(xhr.responseText);
                console.error("Request failed", responseData.errData);
                document
                    .getElementById("toast-danger")
                    .classList.remove("hidden");
                document
                    .getElementById("toast-danger")
                    .classList.remove("opacity-0");
            }
        }
    };
    xhr.send(palanqueListJson);
    console.log("send");
}
function fillZoneWithAlreadyExistingPalanque(diverList) {
    diverList.forEach((element) => {
        let diver = document.getElementById(
            "item" +
                element.US_ID +
                "," +
                element.PRE_CODE +
                ",E" +
                element.US_TEACHING_LEVEL +
                "," +
                element.US_ID
        );
        if (element.DG_NUMBER !== 0 && element.DG_NUMBER !== null) {
            let dgNumber = element.DG_NUMBER - 1;
            let zone = document.getElementById("zone" + dgNumber);
            if (zone) {
                zone.appendChild(diver);
                zoneList.forEach((element) => {
                    if (element.getZoneNumber() == dgNumber) {
                        element.updateCounterPos(setDropZoneSize(diver));
                    }
                });
                if (zoneStart.contains(diver)) zoneStart.removeChild(diver);
            } else {
                let palanqueeTitle = document.createElement("h3");
                palanqueeTitle.addEventListener("click", function () {
                    let nbZone = this.parentElement.id.split("zone")[1];
                    console.log(palanqueeTitle, parseInt(nbZone) + 1);
                    removePalanqueZone(parseInt(nbZone) + 1);
                });
                let divContainer = document.createElement("div");
                divContainer.appendChild(palanqueeTitle);
                let palanque = document.createElement("div");
                palanque.setAttribute(
                    "class",
                    "border text-center bg-gray-200 rounded-lg p-3 pb-20 zone"
                );
                palanque.setAttribute("id", "zone" + dgNumber);
                palanqueeTitle.innerHTML =
                    "Palanquée " +
                    (dgNumber + 1) +
                    " - " +
                    '<div class="cursor-pointer inline underline">Supprimer</div>';
                palanque.setAttribute("ondrop", "drop(event)");
                palanque.setAttribute("ondragover", "allowDrop(event)");
                zoneList.push(new DropZoneClass(dgNumber));
                // console.log(zoneList);
                zoneList.forEach((element) => {
                    if (element.getZoneNumber() == dgNumber) {
                        element.updateCounterPos(setDropZoneSize(diver));
                    }
                });
                divContainer.appendChild(palanque);
                DropZone.appendChild(divContainer);
                palanque.appendChild(diver);
                if (zoneStart.contains(diver)) {
                    zoneStart.removeChild(diver);
                }
                countZone++;
            }
        }
    });
}
