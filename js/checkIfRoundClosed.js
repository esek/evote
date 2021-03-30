/**
 * Checks if the current session is closed by calling actions/checkRoundStatus.php
 * 
 * Requires jQuery
 */
(function checkIfRoundClosed() {
    $.get('action/checkRoundStatus.php', (result, status) => {
        if(result === false) {
            // Reload page from server
            //Construct the current URL.
            var currentURL = window.location.pathname + window.location.search + window.location.hash;
            //"Replace" the current URL with the current URL.
            window.location.replace(currentURL);
        } else {
            // We start a countdown
            createCountdown(checkIfRoundClosed);
        }
    });
})();