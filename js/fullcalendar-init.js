document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const modal = document.getElementById('eventModal');
    const modalTitle = document.getElementById('eventTitle');
    const modalDesc = document.getElementById('eventDescription');
    const closeBtn = document.querySelector('.modal .close');
    const joinBtn = document.querySelector('#joinEventBtn');
    const isAdmin = calendarEl.dataset.admin === "true"; // Set this in calendar.php
  
    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      selectable: isAdmin,
      editable: isAdmin,
      eventDisplay: 'block',
  
      events: 'events.php', // Fetch from PHP backend
  
      dateClick: function (info) {
        if (isAdmin) {
          const title = prompt('Enter Event Title:');
          const description = prompt('Enter Event Description:');
          if (title) {
            fetch('events.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({
                action: 'add',
                title: title,
                start: info.dateStr,
                description: description
              })
            }).then(() => calendar.refetchEvents());
          }
        }
      },
  
      eventClick: function (info) {
        info.jsEvent.preventDefault();
        modalTitle.textContent = info.event.title;
        modalDesc.textContent = info.event.extendedProps.description;
        joinBtn.onclick = function () {
          alert("You've joined: " + info.event.title);
          modal.style.display = 'none';
        };
        modal.style.display = 'block';
      },
  
      eventDrop: function (info) {
        if (isAdmin) {
          fetch('events.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
              action: 'update',
              id: info.event.id,
              start: info.event.startStr
            })
          });
        }
      },
  
      eventRemove: function (info) {
        if (isAdmin && confirm('Delete this event?')) {
          fetch('events.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
              action: 'delete',
              id: info.event.id
            })
          }).then(() => calendar.refetchEvents());
        }
      }
    });
  
    calendar.render();
  
    closeBtn.onclick = () => modal.style.display = 'none';
    window.onclick = event => {
      if (event.target === modal) modal.style.display = 'none';
    };
  });
  