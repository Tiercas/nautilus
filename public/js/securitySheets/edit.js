// DOM Elements
const observationField = document.getElementById('observation-field');
const startTimes = document.getElementsByClassName('dg-start');
const endTimes = document.getElementsByClassName('dg-end');
const expectedTimes = document.getElementsByClassName('dg-exp-time');
const actualTimes = document.getElementsByClassName('dg-act-time');
const expectedDepths = document.getElementsByClassName('dg-exp-dep');
const actualDepths = document.getElementsByClassName('dg-act-dep');

const inputsElement = gatherInputsElement();

const generateButton = document.getElementById('button');

const diveId = document.getElementById('divingSessionId').getAttribute('content');

generateButton.addEventListener('click', generate);

function generate(){
    

    let group = {
        'start' : startTimes[5].value,
        'end' : endTimes[5].value,
        'exp-time' : expectedTimes[5].value,
        'act-time' : actualTimes[5].value,
        'exp-dep' : expectedDepths[5].value,
        'act-dep' : actualDepths[5].value
    };

    console.log(JSON.stringify(group));
}

function gatherInputsElement(){
    let elements = [];
    Array.prototype.push.apply(elements, startTimes);
    Array.prototype.push.apply(elements, endTimes);
    Array.prototype.push.apply(elements, expectedTimes);
    Array.prototype.push.apply(elements, actualTimes);
    Array.prototype.push.apply(elements, expectedDepths);
    Array.prototype.push.apply(elements, actualDepths);
    console.log(elements.length);
    return elements;
}