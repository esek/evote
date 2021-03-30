/**
 * Checks if there is a new round is by calling checkRoundStatus.php
 * 
 * Requires jQuery
 */
(function checkForNewRound() {
    $.get('checkSessionStatus.php', (result, status) => {
        if(result === true) {
            // Hide countdown-container
            document.getElementById("countdown-container").setAttribute("display", "none")
            // Make reload button visible
            // TODO: This
        } else {
            // We start a countdown
            createCountdown(checkForNewRound);
        }
    });
})();