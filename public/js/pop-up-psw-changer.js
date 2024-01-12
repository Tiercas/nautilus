function openForm() {
    document.getElementById("popupForm").style.display = "block";
    document.getElementById("popupForm").style.zIndex = "100000000";
   

    if(!document.getElementById('fullPageDiv')){
        const fullPageDiv = document.createElement('div');
        fullPageDiv.id = 'fullPageDiv';
        fullPageDiv.style.width = "100vw";
        fullPageDiv.style.zIndex = "1000001";
        fullPageDiv.style.position = "absolute";
        fullPageDiv.style.height = "100vh";
        fullPageDiv.style.backgroundColor = "rgba(0, 0, 0, 0.4)";
        document.body.appendChild(fullPageDiv);
    }
}

function closeForm() {
    if(document.getElementById('fullPageDiv')){
        document.body.removeChild(document.getElementById('fullPageDiv'));
    }

    document.getElementById("popupForm").style.display = "none";
}