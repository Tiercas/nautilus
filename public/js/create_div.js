if(document.querySelector('.clickableDelete')){
  var deleteButton = document.querySelector('.clickableDelete');
    function checkHistoryLines() {
        var historyLines = document.querySelectorAll('.historyLine');
        var Historique = document.getElementById("Historique");
        if (historyLines.length > 0) {
            Historique.style.display = 'table';
        } else {
            Historique.style.display = 'none';
        }
    }
    deleteButton.addEventListener('click', checkHistoryLines);
}