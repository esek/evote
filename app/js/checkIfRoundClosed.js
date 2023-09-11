/**
 * Checks if the current session is closed by calling actions/pollRoundStatus.php
 * 
 * Requires jQuery
 */
(function checkIfRoundClosed() {
    $.get('actions/pollRoundStatus.php', (result, status) => {
        if(result.trim() === "false") {
            // Reload page from server
            window.location.reload();
        } else {
            // We start a countdown
            createCountdown(checkIfRoundClosed, false);
        }
    }).fail(() => {
        console.log('Error when polling for round status, retrying...');
        // Alert is annoying but should be ok here (not being able to vote is worse)
        alert('Kunde inte kontrollera om omröstningen är öppen. Testa att ladda om sidan');
    }); // If we get an error
})();