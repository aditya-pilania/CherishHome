<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Event Calendar</title>
  <!-- jQuery (needed for AJAX calls) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- FullCalendar CSS & JS -->
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
</head>

  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    #calendar { max-width: 900px; margin: 0 auto; }
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0; top: 0;
      width: 100%; height: 100%;
      overflow: auto; background-color: rgba(0,0,0,0.5);
    }
    .modal-content {
      background-color: #fff; margin: 15% auto; padding: 20px;
      border: 1px solid #888; width: 50%; border-radius: 10px;
    }
    .close { float: right; font-size: 28px; font-weight: bold; cursor: pointer; }
    .btn { background-color: #2185d0; color: white; padding: 10px 20px; border: none; cursor: pointer; }
  </style>

<body>

  <h2 style="text-align:center;">Event & Program Calendar</h2>
  <div id='calendar'></div>

  <!-- Modal for Event Info -->
  <div id="eventModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h3 id="eventTitle"></h3>
      <p id="eventDescription"></p>
      <button class="btn" onclick="joinEvent()">Join Event</button>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
  const calendarEl = document.getElementById('calendar');
  const calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events: function(fetchInfo, successCallback, failureCallback) {
      // Fetch events from PHP backend
      $.ajax({
        url: 'fetch_events.php', // Make sure this is the correct path
        dataType: 'json',
        success: function(data) {
          if (data.length > 0) {
            successCallback(data); // Pass events to FullCalendar
          } else {
            failureCallback('No events available'); // If no events are returned
          }
        },
        error: function(xhr, status, error) {
          failureCallback('Failed to fetch events: ' + error); // Error handling
        }
      });
    },
    eventClick: function(info) {
      info.jsEvent.preventDefault();
      document.getElementById('eventTitle').textContent = info.event.title;
      document.getElementById('eventDescription').textContent = info.event.extendedProps.description;
      
      // Store the event ID for later use
      currentEventId = info.event.id;

      document.getElementById('eventModal').style.display = 'block';
    }
  });
  calendar.render();

  // Modal logic for closing the modal
  const modal = document.getElementById('eventModal');
  const span = document.getElementsByClassName('close')[0];
  span.onclick = function() {
    modal.style.display = 'none';
  }
  window.onclick = function(event) {
    if (event.target === modal) {
      modal.style.display = 'none';
    }
  }
});

// Global variable to store the event ID
let currentEventId = null;

// Function to redirect to the join event form
function joinEvent() {
  if (currentEventId) {
    // Redirecting to join_event.php with the event ID as a query parameter
    window.location.href = 'join_event.php?event_id=' + currentEventId;
  } else {
    alert('Event ID not found!');
  }
}

  </script>

</body>
</html>
