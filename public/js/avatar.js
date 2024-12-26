document.getElementById('avatarInput').addEventListener('change', function(event) {
  const file = event.target.files[0];
  if (file) {
      const formData = new FormData();
      formData.append('avatar', file);

      // Send the new avatar to the backend via AJAX
      fetch('/update-avatar', { // Ensure this is the correct URL for your route
          method: 'POST',
          headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Laravel CSRF token
          },
          body: formData
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              // If the upload was successful, update the avatar image
              const avatar = document.getElementById('uploadedAvatar');
              avatar.src = data.avatar_url; // Update the avatar's src attribute
          } else {
              alert('Failed to upload avatar.');
          }
      })
      .catch(error => {
          console.error('Error:', error);
      });
  }
});
