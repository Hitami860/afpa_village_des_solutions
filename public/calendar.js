document.addEventListener('DOMContentLoaded', function () {


    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      events: "/calendar/date",
      selectable: true,
      
    });
    calendar.render();
  })
