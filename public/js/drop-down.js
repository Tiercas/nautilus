let buttons = document.getElementsByClassName('diveDropdownButton');

for(let i = 0; i < buttons.length; i++){
    button = buttons[i]
    button.addEventListener('click', (evt) => {
        toggleDropDownMenu(evt);
    });
}

function toggleDropDownMenu(evt){
    let button = evt.currentTarget
    let sessionCode = button.id.split('-')[1];
    let disclosure = document.getElementById('dropdown'+sessionCode);
    disclosure.classList.toggle('hidden');
}