/**
 * Checks if there is a new round is by calling actions/checkRoundStatus.php
 * 
 * If checkRoundStatus.php returns true, make neato "Reload" button visible
 * 
 * Requires jQuery
 */
(function checkForNewRound() {
    $.get('checkSessionStatus.php', (result, status) => {
        if(result === true) {
            // Ask user to reload page via nice butto
        } else {
            // We start a countdown
            createCountdown(checkForNewRound);
        }
    });
})();