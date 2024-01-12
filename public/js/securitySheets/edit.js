// DOM Elements
const observationField = document.getElementById('observation-field');
const startTimes = document.getElementsByClassName('dg-start');
const endTimes = document.getElementsByClassName('dg-end');
const expectedTimes = document.getElementsByClassName('dg-exp-time');
const actualTimes = document.getElementsByClassName('dg-act-time');
const expectedDepths = document.getElementsByClassName('dg-exp-dep');
const actualDepths = document.getElementsByClassName('dg-act-dep');
const generateButton = document.getElementById('button');
const inputsElement = gatherInputsElement();
const popupNotification = document.getElementById('toast-default')
const popupContent = document.getElementById('popup-content');

popupNotification.classList.add('hidden');
changePopupColor('bg-white', 'bg-lime-500');

// Meta data
const diveId = document.getElementById('divingSessionId').getAttribute('content');
const csrfToken = document.getElementById('csrf-token').getAttribute('content')

const pdfLink = `<a class="underline" href="/security-sheets/fiche-securite-${diveId}.pdf" target="_blank">(voir)</a>`;

generateButton.addEventListener('click', generate);

/**
 * Saves the edited data to the database and generate.
 */
function generate(){
    let data = {};

    inputsElement.forEach((element) => {
        fetchField(data, element);
    });

    data['observation'] = observationField.value;

    let json = JSON.stringify(data);
    sendRequest(json, diveId);
}

/**
 * Send the HTTP request to our server.
 * @param {*} json the data to send to the server
 * @param {*} diveId the code of the diving session
 */
function sendRequest(json, diveId){
    fetch('/dives/' + diveId + '/security-sheet/update', {
        method: "POST",
        body: json,
        headers: {
            "Content-type": "application/json; charset=UTF-8",
            "x-csrf-token" : csrfToken
        }
    })
    .then((response) => notify(response));
}

/**
 * Display a notification based on the success of the generation process.
 * If any exception occurs on the server, it will be red.
 * @param {*} response the response sent by the server after the HTTP request
 */
function notify(response){
    if(response['status'] === 200){
        displayNotification(true);
    } else{
        displayNotification(false);
    }    
}

/**
 * Puts all the input elements in the same array.
 * @returns an array containing all the input elements
 */
function gatherInputsElement(){
    let elements = [];
    Array.prototype.push.apply(elements, startTimes);
    Array.prototype.push.apply(elements, endTimes);
    Array.prototype.push.apply(elements, expectedTimes);
    Array.prototype.push.apply(elements, actualTimes);
    Array.prototype.push.apply(elements, expectedDepths);
    Array.prototype.push.apply(elements, actualDepths);
    return elements;
}

/**
 * Fills the given array to build the json with the data of the form.
 * @param {*} array the array to write the data to
 * @param {*} element the input element the data must be written from
 */
function fetchField(array, element){
    let key = getKeyFromClassList(element);
    let id = element.id.match(/\d+/)[0];

    if(! (id in array)){
        array[id] = {};
    }

    array[id][key] = element.value;
}

/**
 * Reads the classList of an input element to retrieve the key (i.e. its the field it's for)
 * @param {*} element the input element
 * @returns the key
 */
function getKeyFromClassList(element){
    let classList = element.classList;
    for(let i = 0; i < classList.length; i++){
        if(classList[i].includes('dg')){
            return classList[i]
        }
    }

    return false;
}

/**
 * Displays a pop-up notification on the page.
 * Its text and color will depend on the success of the generation.
 * If the generation was successful, the notification will as well contain
 * a link to the pdf sheet.
 * @param {*} ok 
 */
function displayNotification(ok){
    popupNotification.classList.remove('opacity-0');
    if(ok){
        changePopupColor('bg-red-600', 'bg-lime-500');
        popupContent.innerHTML = 'Génération réussie ' + pdfLink;
    } else{
        changePopupColor('bg-lime-500', 'bg-red-600');
        popupContent.innerText = 'Génération échouée ';
    }

    popupNotification.classList.remove('hidden');
}

/**
 * Changes the color of the popup-notification
 * @param {*} oldColor the former color of the notification (tailwind class)
 * @param {*} newColor the new color of the notification (tailwind class)
 */
function changePopupColor(oldColor, newColor){
    popupNotification.classList.add(newColor);
    popupNotification.classList.remove(oldColor);

    let button = document.querySelector('#toast-default button');

    console.log(button);

    button.classList.add(newColor);
    button.classList.remove(oldColor);
}