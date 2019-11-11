let $doctor, $date, $specialty, $hours;
let iRadio;

const noHoursAlert = `
<div class="alert alert-danger" role="alert">
    <strong>Lo sentimos!</strong> No se encontraron horas disponible para el médico en el día seleccionado
</div>
`

$(function (){
    $specialty = $('#specialty');
    $doctor = $('#doctor');
    $date = $('#date');
    $hours = $('#hours');

    $specialty.change(()=> {
        const specialtyId = $specialty.val();
        const url = `/specialties/${specialtyId}/doctors`;
        $.getJSON(url, onDoctorsLoaded);
    });

    $doctor.change(loadHours);
    $date.change(loadHours);
});

function onDoctorsLoaded(doctors){
    let htmlOptions = '';
    doctors.forEach(function (doctor){
        htmlOptions += `<option value="${doctor.id}">${doctor.name}</option>`;
    });
    $doctor.html(htmlOptions);
    loadHours(); //side-effect
}

function loadHours() {
    const selectedDate = $date.val();
    const doctorId = $doctor.val();
    const url = `/schedule/hours?date=${selectedDate}&doctor_id=${doctorId}`;
    $.getJSON(url, displayHours);
}

function displayHours(data) {

    if(!data.morning && !data.afternoon){
       $hours.html(noHoursAlert);
        return;
    }

    let htmlHours = '';
    iRadio = 0;

    htmlHours += `<select class="form-control selectpicker" name="interval" data-live-search="true">`;

    if(data.morning) {
        const morning_intervals = data.morning;
        htmlHours += `<optgroup label="Turno mañana">`;
        morning_intervals.forEach(interval => {
            htmlHours += getRadioHtml(interval);
        });
        htmlHours += `</optgroup>`;
    }

    if(data.afternoon) {
        const afternoon_intervals = data.afternoon;
        htmlHours += `<optgroup label="Turno tarde">`;
        afternoon_intervals.forEach(interval => {
            htmlHours += getRadioHtml(interval);
        });
        htmlHours += `</optgroup>`;
    }

    htmlHours += `</select>`;
    $hours.html(htmlHours);
}

function getRadioHtml(interval){
    const text = `${interval.start} - ${interval.end}`;
    return `<option value="${text}">${text}</option>`;
}
