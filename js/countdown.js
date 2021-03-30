/**
 * Neat countdown handling
 * Sets element with id "countdown-number to current time left
 */
function createCountdown(callback) {
    // Memoized current countdown and callback: created by caller
    let cd = 5;
    const cb = callback;
    // This function is called when outer function is created
    // (starts counting immediatly)
    (function countdown() {
        // If we have finished counting, call function
        // sent by caller (lol)
        if (cd === 0) {
            callback(cb);
        } else {
            cd = cd - 1;
            //TODO: Set element to cd!
            setTimeout(countdown, 1000);
        }
    })();
};