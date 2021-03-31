/**
 * Checks if there is a new round is by calling checkRoundStatus.php
 * 
 * Requires jQuery
 */
(function checkForNewRound() {
    $.get('actions/pollRoundStatus.php', (result, status) => {
        if(result === "true") {
            // Reload page from server
            window.location.reload();
        } else {
            // We start a countdown
            createCountdown(checkForNewRound);
        }
    });
})();