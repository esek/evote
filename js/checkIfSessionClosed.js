/**
 * Checks if the current session is closed by calling checkSessionStatus.php
 * 
 * Requires jQuery
 */
(function checkIfSessionClosed() {
    $.get('checkSessionStatus.php', (result, status) => {
        if(result === false) {
            // Reload page
        } else {
            // We start a countdown
            createCountdown(checkIfSessionClosed);
        }
    });
})();