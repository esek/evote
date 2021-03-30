/**
 * Neat countdown handling
 * Sets element with id "countdown-number to current time left
 */
function createCountdown(callback) {
    // Memoized current countdown and callback: created by caller
    let cd = 3;
    const cb = callback;
    // This function is called when outer function is created
    // (starts counting immedietly)
    (function countdown() {
        // If we have finished counting, call function
        // sent by caller (lol)
        if (cd === 0) {
            cb();
        } else {
            cd = cd - 1;
            // Set element with id countdown-counter to cd
            document.getElementById("countdown-counter").innerHTML = `Kollar efter ny omröstning om ${cd}`;
            setTimeout(countdown, 1000);
        }
    })();
};