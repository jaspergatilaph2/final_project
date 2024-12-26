$(document).ready(function () {
  $('#profile-update-form').on('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    var formData = new FormData(this); // Collect form data including files

    $.ajax({
      url: $(this).attr('action'), // URL from form's action attribute
      type: 'POST', // Form method
      data: formData,
      contentType: false, // Don't set content type, as it will be multipart
      processData: false, // Don't process the data
      success: function (response) {
        // Handle success (e.g., show a success message)
        alert('Profile updated successfully!');
        // Optionally, update the UI with the new data
      },
      error: function (xhr) {
        // Handle error (e.g., show error messages)
        var errors = xhr.responseJSON.errors;
        var errorMessage = '';
        for (var key in errors) {
          if (errors.hasOwnProperty(key)) {
            errorMessage += errors[key].join(', ') + '\n';
          }
        }
        alert('Error: \n' + errorMessage);
      }
    });
  });
});