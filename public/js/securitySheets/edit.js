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

// Meta data
const diveId = document.getElementById('divingSessionId').getAttribute('content');
const csrfToken = document.getElementById('csrf-token').getAttribute('content')

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

//TODO display the notification on the screen
function notify(response){
    console.table(response);
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