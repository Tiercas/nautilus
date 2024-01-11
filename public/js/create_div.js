document.addEventListener('DOMContentLoaded', function () {
    function checkButtons() {
        var deleteButtons = document.querySelectorAll('.clickableRed');
        var historiqueContainer = document.getElementById('Historique');
        var DiverImage = document.getElementById('imageDiver');

        if (deleteButtons.length > 0) {
            historiqueContainer.style.display = 'block';
            DiverImage.style.display = 'none';
        } else {
            historiqueContainer.style.display = 'none';
            DiverImage.style.display = 'block';
        }
    }

    checkButtons();

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('clickableRed')) {
            setTimeout(checkButtons, 100);
        }
    });
});