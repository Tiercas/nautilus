let buttons = document.getElementsByClassName('diveDropdownButton');

console.log(buttons.length)

for(let i = 0; i < buttons.length; i++){
    button = buttons[i]
    button.addEventListener('click', (evt) => {
        toggleDropDownMenu(evt);
    });
}

function toggleDropDownMenu(evt){
    let button = evt.currentTarget
    let sessionCode = button.id.split('-')[1];
    console.log('dropdown'+sessionCode);
    let disclosure = document.getElementById('dropdown'+sessionCode);
    disclosure.classList.toggle('hidden');
}