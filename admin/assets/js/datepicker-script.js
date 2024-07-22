$(document).ready(function () {
    const applyButton = $('#applyBtn');
    const startDateInput = $('#startDate');
    const endDateInput = $('#endDate');
    const errorMessage = $('#errorMessage');
    const clearBtn = $('#clearBtn');
    const dateRangeRadioCustom = $('#customDateRange');
    const dateRangeRadioAllTime = $('#allTimeDateRange');
    let startDate = new Date(0);
    let endDate = new Date();

    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    function updateUrl() {
        const params = {
            'load_capacity': $('#sel1').val(),
            'body_type': $('#sel2').val(),
            //'start_date': formatDate(startDate),
            //'end_date': formatDate(endDate),
            'start_date': $('#startDateValue').val(),
            'end_date': $('#endDateValue').val(),
            'utm_source': $('select[name="utm_source"]').val(),
            'utm_medium': $('select[name="utm_medium"]').val(),
            'utm_campaign': $('select[name="utm_campaign"]').val()
        };

        let url = window.location.href;

        url = url.replace(/[&?]paged=\d+/, '');
    
        Object.keys(params).forEach(param => {
            const regex = new RegExp(`[&?]${param}=[^&]*`, 'g');
            url = url.replace(regex, '');
        });
    
        url = url.replace(/[?&]$/, '');
    
        const newParams = $.param(params);
        const separator = url.includes('?') ? '&' : '?';
        const newUrl = `${url}${separator}${newParams}`;
    
        window.location.href = newUrl;
    }

    function switchToCustomRange() {
        dateRangeRadioCustom.prop('checked', true);
        validateDates();
    }

    function switchToAllTimeRange() {
        dateRangeRadioAllTime.prop('checked', true);
        startDate = new Date(0);
        endDate = new Date();
    }

    function validateDates() {
        const startDateValue = startDateInput.val();
        const endDateValue = endDateInput.val();
        const startDate = new Date(startDateValue);
        const endDate = new Date(endDateValue);

        if (!startDateValue || !endDateValue) {
            errorMessage.text('Обе даты должны быть указаны');
            applyButton.prop('disabled', true);
        } else if (startDate > endDate) {
            errorMessage.text('Начальная дата не может быть позже конечной даты');
            applyButton.prop('disabled', true);
        } else {
            errorMessage.text('');
            applyButton.prop('disabled', false);
        }
    }

    function resetDateInputs() {
        startDateInput.val('');
        endDateInput.val('');
    }

    clearBtn.on('click', function () {
        resetDateInputs();
        errorMessage.text('');
        switchToAllTimeRange();
        applyButton.prop('disabled', false);
    });

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        language: 'ru'
    }).on('changeDate', function (e) {
        const selectedDate = e.date;
        if ($(this).attr('id') === 'startDate') {
            startDate = selectedDate;
            startDateInput.val(formatDate(startDate));
        } else if ($(this).attr('id') === 'endDate') {
            endDate = selectedDate;
            endDateInput.val(formatDate(endDate));
        }
        validateDates();
        switchToCustomRange();
        $('#startDateValue').val(formatDate(startDate));
        $('#endDateValue').val(formatDate(endDate));
    });

    $('input[name="dateRange"]').on('change', function () {
        const currentDate = new Date();

        switch ($(this).val()) {
            case 'allTime':
                startDate = new Date(0);
                endDate = currentDate;
                break;
            case 'lastMonth':
                startDate = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1, 1);
                endDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), 0);
                break;
            case 'lastWeek':
                const weekStart = currentDate.getDate() - currentDate.getDay() + 1;
                startDate = new Date(currentDate.setDate(weekStart - 7));
                endDate = new Date(currentDate.setDate(weekStart - 1));
                break;
            case 'yesterday':
                startDate = new Date(currentDate);
                startDate.setDate(currentDate.getDate() - 1);
                startDate.setHours(0, 0, 0, 0);

                endDate = new Date(currentDate);
                endDate.setDate(currentDate.getDate() - 1);
                endDate.setHours(23, 59, 59, 999);
                break;
            case 'custom':
                validateDates();
                return;
            default:
                return;
        }

        $('#startDateValue').val(formatDate(startDate));
        $('#endDateValue').val(formatDate(endDate));

        resetDateInputs();
        errorMessage.text('');
        applyButton.prop('disabled', false);
    });

    applyButton.on('click', function () {
        updateUrl();
        errorMessage.text('');
    });
});