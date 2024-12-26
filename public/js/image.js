// Preview the selected image
function previewImage(event) {
  const file = event.target.files[0];
  if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
          // Set the new image as the source for the avatar
          document.getElementById('uploadedAvatar').src = e.target.result;
      };
      reader.readAsDataURL(file);
  }
}

// Reset the image preview to the default avatar
function resetImagePreview() {
  document.getElementById('upload').value = ''; // Clear the file input
  const defaultAvatar = "{{ $user->avatar ? asset('storage/' . $user->avatar) : '../assets/img/avatars/1.png' }}";
  document.getElementById('uploadedAvatar').src = defaultAvatar; // Reset to the default or current avatar
}