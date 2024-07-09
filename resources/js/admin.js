//DatePicker (flowbite)
import Datepicker from 'flowbite-datepicker/Datepicker';
import ru from "flowbite-datepicker/locales/ru";

const datepickerEl = document.getElementById('created_at');

Object.assign(Datepicker.locales, ru);
        new Datepicker(datepickerEl, {
            language: 'ru',
            autohide: true,
            todayHighlight: true,
        });

datepickerEl.addEventListener('changeDate', (event) => {
    window.livewire.emit('dateSelected', event.detail.date);
});
