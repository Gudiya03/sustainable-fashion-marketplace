document.addEventListener('DOMContentLoaded', function () {
    const confirmLogoutButton = document.getElementById('confirm-logout');
    const cancelLogoutButton = document.getElementById('cancel-logout');
    const confirmPasswordInput = document.getElementById('confirm-pass');

    // Handle confirming logout
    confirmLogoutButton.addEventListener('click', function () {
        const password = confirmPasswordInput.value.trim();

        // Basic check: ensure password field is not empty
        if (password === '') {
            alert('Please enter your password.');
            return;
        }

        // Simulate logout: clear localStorage and redirect to login page
        localStorage.removeItem('userName');
        alert('Logged out successfully.');
        window.location.href = 'login.html';
    });

    // Handle canceling logout
    cancelLogoutButton.addEventListener('click', function () {
        // Redirect back to profile or previous page
        window.location.href = 'index.html';
    });
});

