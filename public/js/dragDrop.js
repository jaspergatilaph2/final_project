$(document).ready(function() {
  // Make the events draggable
  $('#external-events .external-event').each(function() {
    var eventObject = {
      title: $.trim($(this).text()), // Set the event title
      className: $(this).data('class') // Set the event class
    };

    // Store the event data
    $(this).data('eventObject', eventObject);

    // Make it draggable using jQuery UI
    $(this).draggable({
      zIndex: 999,
      revert: true, // When dropped, it will revert back to the original position
      revertDuration: 0
    });
  });

  // Initialize the calendar
  $('#calendar').fullCalendar({
    droppable: true, // Enable dropping events
    editable: true, // Allow event modifications
    eventSources: [
      {
        url: '/appointments', // Fetch events from Laravel
        method: 'GET',
        success: function(response) {
          // Ensure the correct format is used
          if (response.appointments) {
            $('#calendar').fullCalendar('addEventSource', response.appointments);
          } else {
            console.error("Invalid response format:", response);
          }
        },
        error: function() {
          alert('Error fetching appointments');
        }
      }
    ],
    drop: function(info) {
      alert("Event dropped: " + info.event.title);
    }
  });
});