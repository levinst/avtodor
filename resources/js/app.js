import './bootstrap';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse'

Alpine.plugin(collapse)

window.Alpine = Alpine;

Alpine.start();

//DatePicker (flowbite)
// import Datepicker from 'flowbite-datepicker/Datepicker';
// import ru from "flowbite-datepicker/locales/ru";

// const datepickerEl = document.getElementById('created_at');

// Object.assign(Datepicker.locales, ru);
//         new Datepicker(datepickerEl, {
//             language: 'ru',
//             autohide: true,
//             todayHighlight: true,
//         });

// datepickerEl.addEventListener('changeDate', (event) => {
//     window.livewire.emit('dateSelected', event.detail.date);
// });

//Кнопка НАВЕРХ
document.addEventListener('DOMContentLoaded', function () {
    let btn = document.querySelector('#toTop');
    window.addEventListener('scroll', function () {
        // Если прокрутили дальше 599px, показываем кнопку
        if (pageYOffset > 100) {
            btn.classList.add('show');
            // Иначе прячем
        } else {
            btn.classList.remove('show');
        }
    });

    // При клике прокручиываем на самый верх
    btn.onclick = function (click) {
        click.preventDefault();
        scrollTo(0, 0);
    }
});
