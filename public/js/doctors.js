document.getElementById('doctor').addEventListener('change', function () {
  // Get the selected doctor option
  var selectedOption = this.options[this.selectedIndex];
  var imageUrl = selectedOption.getAttribute('data-image');

  // Get the image container and image element
  var imageContainer = document.getElementById('doctor-image-container');
  var doctorImage = document.getElementById('doctor-image');

  // Check if an image URL is available
  if (imageUrl) {
    doctorImage.src = imageUrl; // Set the image source
    imageContainer.style.display = 'block'; // Show the image container
  } else {
    imageContainer.style.display = 'none'; // Hide the image container if no image is available
  }
});