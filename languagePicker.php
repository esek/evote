<?php
    /**
     * Use variable session language to return the correct string
     * call anywhere where included (since this is in index, that is everywhere)
     * to display the correct language
     * 
     * Echo response to display in html 
     * 
     * @param $sv Swedish text
     * @param $en Corresponding English text
     */
    function pickLanguage($sv, $en) {
        switch ($_SESSION["lang"]) {
            case "sv":
                return $sv;
            case "en":
                return $en;
            default:
                return $sv;
        }
    }
    if (isSet($_GET["lang"])) {
        // Set session language, so that it may be retained for 
        // the remainder of the session
        $_SESSION["lang"] = $_GET["lang"];
    
        // Save choice of language in a 365 day cookie
        setcookie("lang", $_GET["lang"], time() + (3600 * 24 * 365));
    }
    else if(isSet($_COOKIE["lang"])) {
        // Updates session according to found cookie
        $_SESSION["lang"] = $_COOKIE["lang"];
    }
    else {
        $lang = 'sv';
    }
?>