/**
 * Checks if there is a new round is by calling checkRoundStatus.php
 * 
 * Requires jQuery
 */
(function checkForNewRound() {
    $.get('checkSessionStatus.php', (result, status) => {
        if(result === true) {
            // Ask user to reload page
        } else {
            // We start a countdown
            createCountdown(checkForNewRound);
        }
    });
})();