document.addEventListener("DOMContentLoaded", function () {
    fetchNotifications();

    function fetchNotifications() {
        fetch("{{ route('notifications.fetch') }}")
            .then(response => response.json())
            .then(data => {
                let notificationList = document.getElementById("notificationList");
                let badge = document.getElementById("notificationBadge");

                notificationList.innerHTML = "";

                if (data.length > 0) {
                    badge.classList.remove("d-none");
                    badge.textContent = data.length;

                    data.forEach(notification => {
                        let item = `<li class="dropdown-item">${notification.title}</li>`;
                        notificationList.innerHTML += item;
                    });
                } else {
                    badge.classList.add("d-none");
                    notificationList.innerHTML = '<li class="dropdown-item text-center text-muted">No new notifications</li>';
                }
            });
    }

    document.getElementById("markAllRead").addEventListener("click", function (e) {
        e.preventDefault();
        fetch("{{ route('notifications.read') }}", { method: "POST", headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" } })
            .then(() => {
                fetchNotifications();
            });
    });
});