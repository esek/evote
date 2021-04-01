/**
 * Checks if the current session is closed by calling actions/pollRoundStatus.php
 * 
 * Requires jQuery
 */
(function checkIfRoundClosed() {
    $.get('actions/pollRoundStatus.php', (result, status) => {
        if(result === "false") {
            // Reload page from server
            window.location.reload();
        } else {
            // We start a countdown
            createCountdown(checkIfRoundClosed, false);
        }
    }).fail(() => {
        console.log('Error when polling for round status, retrying...');
        createCountdown(checkIfRoundClosed, false);
    }); // If we get an error
})();