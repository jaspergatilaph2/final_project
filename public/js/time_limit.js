function updateCountdowns() {
    document.querySelectorAll('.appointment-item').forEach(function (element) {
        let clearTime = parseInt(element.getAttribute('data-clear-time')) * 1000;
        let now = new Date().getTime();
        let remaining = Math.floor((clearTime - now) / 1000);

        let countdownElement = element.querySelector('.countdown');
        if (remaining > 0) {
            let minutes = Math.floor(remaining / 60);
            let seconds = remaining % 60;
            countdownElement.innerText = `${minutes}m ${seconds}s`;
        } else {
            element.style.display = 'none'; // Hide the appointment when time is up
        }
    });
}

setInterval(updateCountdowns, 1000); // Update countdown every second
updateCountdowns(); // Initial call to update immediately