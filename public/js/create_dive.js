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
        var dayOfWeek = selectedDate.getDay();

        var selectHour = document.getElementById('SelectHour');

        selectHour.options[1].disabled = false;
        selectHour.options[2].disabled = false;

        if (dayOfWeek === 0) {
            selectHour.options[1].disabled = true;
            selectHour.options[2].disabled = true;
        }
    });
