    document.addEventListener('DOMContentLoaded', function () {
        var currentDate = new Date();
        var Hour = this.document.getElementById("SelectHour");
        var maxDate = new Date(currentDate.getFullYear(), 11, 1);
        var formattedMaxDate = maxDate.toISOString().split('T')[0];
        var dayInput = document.getElementById('dayInput');
        dayInput.max = formattedMaxDate;
    });

    document.getElementById('dayInput').addEventListener('change', function () {
        var selectedDate = new Date(this.value);
        var dayOfWeek = selectedDate.getDay(); // 0 = Dimanche, 1 = Lundi, ..., 6 = Samedi

        var selectHour = document.getElementById('SelectHour');

        // Réinitialisez les options
        selectHour.options[1].disabled = false; // Après-midi
        selectHour.options[2].disabled = false; // Soir

        // Si la date sélectionnée est un dimanche (jour 0), désactivez les options Après-midi et Soir
        if (dayOfWeek === 0) {
            selectHour.options[1].disabled = true; // Après-midi
            selectHour.options[2].disabled = true; // Soir
        }
    });
