<?php
/**
 * This API responds to a GET request by answering if there currently is a
 * current voting session.
 * 
 * If there is a vote currently, "true" is returned, otherwise "false".
 */
require '../data/evote.php';
$evote = new Evote();
if($evote->ongoingRound()) {
    echo "true";
} else {
    echo "false";
}
?>