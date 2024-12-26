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
    drop: function(info) {
      // Handle the drop event here (e.g., save event data)
      alert("Event dropped: " + info.event.title);
    }
  });
});