/**
 * Checks if there is a new round is by calling checkRoundStatus.php
 * 
 * Requires jQuery
 */
(function checkForNewRound() {
    $.get("actions/pollRoundStatus.php", (result, status) => {
        if(result.trim() === "true") {
            // Reload page from server
            window.location.reload();
        } else {
            // We start a countdown
            createCountdown(checkForNewRound, true);
        }
    }).fail(() => {
        console.error("Error when polling for round status");
        // Tell user they need to reload the page
        document.getElementById("countdown-container").style.display = "none";
        document.getElementById("polling-failure").style.display = "";
    }); // If we get an error
})();