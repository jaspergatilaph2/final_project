function markNotificationRead(event, notificationId) {
    event.preventDefault();
    fetch(`/notifications/mark-read/${notificationId}`, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}

function markAllNotificationsRead(event) {
    event.preventDefault();
    fetch(`/notifications/mark-all-read`, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}