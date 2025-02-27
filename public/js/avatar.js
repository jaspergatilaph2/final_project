document.getElementById('avatarInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const formData = new FormData();
        formData.append('profile_picture', file); // Match Laravel's expected field name

        fetch('/update-avatar', { // Ensure this is the correct route
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the avatar image
                const avatar = document.getElementById('uploadedAvatar');
                avatar.src = data.avatar_url + '?t=' + new Date().getTime(); // Prevent browser caching
            } else {
                alert('Failed to upload avatar.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});
