    document.addEventListener('DOMContentLoaded', function () {
        var currentDate = new Date();
        var maxDate = new Date(currentDate.getFullYear(), 11, 1);
        var formattedMaxDate = maxDate.toISOString().split('T')[0];
        var dayInput = document.getElementById('dayInput');
        dayInput.max = formattedMaxDate;
    });
