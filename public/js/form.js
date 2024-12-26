$('#formAccountSettings').submit(function (event) {
  event.preventDefault();  // Prevent the default form submission
  $.ajax({
    url: $(this).attr('action'),
    type: 'POST',
    data: new FormData(this),
    processData: false,
    contentType: false,
    success: function (response) {
      // Handle success
    },
    error: function (response) {
      // Handle error
    }
  });
});
