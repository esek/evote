/**
 * Checks if there is a new round is by calling checkRoundStatus.php
 * 
 * Requires jQuery
 */
(function checkForNewRound() {
    $.get('actions/pollRoundStatus.php', (result, status) => {
        if(result === true) {
            // Reload page from server
            //Construct the current URL.
            var currentURL = window.location.pathname + window.location.search + window.location.hash;
            //"Replace" the current URL with the current URL.
            window.location.replace(currentURL);
        } else {
            // We start a countdown
            createCountdown(checkForNewRound);
        }
    });
})();