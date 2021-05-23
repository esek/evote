<?php
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
        $_SESSION['lang'] = 'sv';
    }
    /**
     * Use variable session language to return the correct string
     * call anywhere where included (since this is in index, that is everywhere)
     * to display the correct language
     * 
     * For use in existing PHP code (for example in echo)
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

    /**
     * Echoes the session language, for use directly in HTML
     * 
     * @param $sv Swedish language text
     * @param $en English language text
     */
    function echoLanguageChoice($sv, $en) {
        echo pickLanguage($sv, $en);
    }
?>