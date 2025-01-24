document.getElementById('notificationDropdown').addEventListener('click', function() {
  fetch('/notifications/mark-as-read', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
});
