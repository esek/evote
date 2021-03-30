/**
 * Checks if the current session is closed by calling checkRoundStatus.php
 * 
 * Requires jQuery
 */
(function checkIfRoundClosed() {
    $.get('checkSessionStatus.php', (result, status) => {
        if(result === false) {
            // Reload page
        } else {
            // We start a countdown
            createCountdown(checkIfRoundClosed);
        }
    });
})();