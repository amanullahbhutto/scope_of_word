const monthElement = document.getElementById('month');
const daysElement = document.getElementById('days');
const prevButton = document.getElementById('prev');
const nextButton = document.getElementById('next');

let currentDate = new Date();

const events = [
    { date: new Date(2024, 10, 4), type: 'fixed' },
    { date: new Date(2024, 10, 12), type: 'possible' },
    { date: new Date(2024, 10, 22), type: 'special' },
    { date: new Date(2024, 10, 25), type: 'meeting' }
];

function renderCalendar() {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();

    monthElement.textContent = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });
    daysElement.innerHTML = '';

    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);

    for (let i = 0; i < firstDay.getDay(); i++) {
        const blankDay = document.createElement('div');
        daysElement.appendChild(blankDay);
    }

    for (let day = 1; day <= lastDay.getDate(); day++) {
        const dayElement = document.createElement('div');
        dayElement.textContent = day;
        dayElement.classList.add('day');

        const currentDay = new Date(year, month, day);
        const event = events.find(e => e.date.toDateString() === currentDay.toDateString());
        if (event) {

            if (event.type === 'fixed') {
                dayElement.classList.add('fixed-box');
            } else if (event.type === 'possible') {
                dayElement.classList.add('possible-box');
            } else if (event.type === 'special') {
                dayElement.classList.add('special-box');
            } else if (event.type === 'meeting') {
                dayElement.classList.add('meeting-box-calendar');
            }
        }

        daysElement.appendChild(dayElement);
    }
}

prevButton.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
});

nextButton.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
});

renderCalendar();