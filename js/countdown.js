/**
 * Neat countdown handling
 * Sets element with id "countdown-number to current time left
 * 
 * @param callback What should be done after countdown
 * @param visual If element with id countdown-counter should be decreased
 */
function createCountdown(callback, visual) {
    // Memoized current countdown and callback
    let cd = 5;
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
            // if visual cue
            if (visual) {
                document.getElementById("countdown-counter").innerHTML = `${cd}`;
            }
            setTimeout(countdown, 1000);
        }
    })();
};