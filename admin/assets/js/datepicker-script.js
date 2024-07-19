$(document).ready(function () {
    const applyButton = $('#applyBtn');
    const startDateField = $('#startDate');
    const endDateField = $('#endDate');
    const fields = [startDateField, endDateField];

    function formatDate(date, type = 'short') {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');

        if (type === 'full') {
            return `${date.toLocaleString('ru', { year: "numeric", month: "long", day: "numeric" })}`;
        }

        return `${year}-${month}-${day}`;
    }

    function updateUrlWithDates(startDate, endDate) {
        const dateUrl = `${window.location.pathname}${window.location.search}&${$.param({ 'start_date': formatDate(startDate), 'end_date': formatDate(endDate) })}`;
        window.location.href = dateUrl;
    };


    function validateDate(startDate, endDate) {
        return startDate <= endDate;
    }

    function areFieldsPopulated(fieldList) {
        return fieldList.every(field => field.val() !== '');
    }

    function toggleApplyButton() {
        areFieldsPopulated(fields) ? applyButton.show() : applyButton.hide();
    }

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        language: 'ru'
    });

    $('input[name="dateRange"]').change(function () {
        const currentDate = new Date();

        let startDate, endDate, rangeText;

        switch ($(this).val()) {
            case 'allTime':
                startDate = new Date(1900, 0, 1);
                endDate = currentDate;
                rangeText = 'Весь период';
                break;
            case 'lastMonth':
                startDate = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1, 1);
                endDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), 0);
                rangeText = 'Прошлый месяц';
                break;
            case 'lastWeek':
                const weekStart = currentDate.getDate() - currentDate.getDay() + 1;
                startDate = new Date(currentDate.setDate(weekStart - 7));
                endDate = new Date(currentDate.setDate(weekStart - 1));
                rangeText = 'Прошлая неделя';
                break;
            case 'last24Hours':
                startDate = new Date(currentDate.getTime() - (24 * 60 * 60 * 1000));
                endDate = currentDate;
                rangeText = 'Последние 24 часа';
                break;
            default:
                return;
        }

        updateUrlWithDates(startDate, endDate);
    });

    $('#clearBtn').click(function () {
        fields.forEach(field => field.val(''));
        $('#errorMessage').text('');
        toggleApplyButton();
    });

    applyButton.click(function () {
        const startDate = startDateField.datepicker('getDate');
        const endDate = endDateField.datepicker('getDate');

        if (!validateDate(startDate, endDate)) {
            $('#errorMessage').text('Конечная дата не может быть раньше начальной');
            return;
        }

        updateUrlWithDates(startDate, endDate);

        $('#errorMessage').text('');
    });

    toggleApplyButton();

    $('.datepicker').on('change', toggleApplyButton);
});

