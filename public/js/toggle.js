const isDarkMode = localStorage.getItem('dark-mode') === 'true';
    
    // Apply the dark mode class to the body if it's enabled
    if (isDarkMode) {
        document.body.classList.add('dark-mode');
    }

    const toggleButton = document.querySelector('.dark-mode-toggle');
    
    toggleButton.addEventListener('click', () => {
        // Toggle dark mode on the body
        document.body.classList.toggle('dark-mode');
        
        // Store the preference in localStorage
        const isDark = document.body.classList.contains('dark-mode');
        localStorage.setItem('dark-mode', isDark);
        
        // Change button icon and text depending on mode
        if (isDark) {
            toggleButton.innerHTML = '<i class="fas fa-sun me-2"></i> Toggle Light Mode';
        } else {
            toggleButton.innerHTML = '<i class="fas fa-moon me-2"></i> Toggle Dark Mode';
        }
    });