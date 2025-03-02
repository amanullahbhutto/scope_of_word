const monthNames = ["January", "February", "March", "April", "May", "June", 
    "July", "August", "September", "October", "November", "December"];

let date = new Date();
let currentMonth = date.getMonth();
let currentYear = date.getFullYear();

const monthElement = document.getElementById('month');
const daysElement = document.getElementById('days');

function renderCalendar() {
date.setDate(1);

const firstDayIndex = date.getDay();
const lastDay = new Date(currentYear, currentMonth + 1, 0).getDate();
const prevLastDay = new Date(currentYear, currentMonth, 0).getDate();
const lastDayIndex = new Date(currentYear, currentMonth + 1, 0).getDay();
const nextDays = 7 - lastDayIndex - 1;

monthElement.innerHTML = `${monthNames[currentMonth]} ${currentYear}`;
daysElement.innerHTML = "";

// Previous month days
for (let x = firstDayIndex; x > 0; x--) {
const day = document.createElement('div');
day.classList.add('inactive');
day.textContent = prevLastDay - x + 1;
daysElement.appendChild(day);
}

// Current month days
for (let i = 1; i <= lastDay; i++) {
const day = document.createElement('div');
day.textContent = i;
daysElement.appendChild(day);
}

// Next month days
for (let j = 1; j <= nextDays; j++) {
const day = document.createElement('div');
day.classList.add('inactive');
day.textContent = j;
daysElement.appendChild(day);
}
}

document.getElementById('prev').addEventListener('click', () => {
currentMonth--;
if (currentMonth < 0) {
currentMonth = 11;
currentYear--;
}
date.setMonth(currentMonth);
renderCalendar();
});

document.getElementById('next').addEventListener('click', () => {
currentMonth++;
if (currentMonth > 11) {
currentMonth = 0;
currentYear++;
}
date.setMonth(currentMonth);
renderCalendar();
});

renderCalendar();
