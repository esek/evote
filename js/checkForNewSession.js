/**
 * Checks if there is a new session is by calling checkSessionStatus.php
 * 
 * Requires jQuery
 */
(function checkForNewSession() {
    $.get('checkSessionStatus.php', (result, status) => {
        if(result === true) {
            // Ask user to reload page
        } else {
            // We start a countdown
            createCountdown(checkForNewSession);
        }
    });
})();