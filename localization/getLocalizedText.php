<?php
    // Include the lookup table for all text
    require("localizedTextLookupTable.php");

    // Check language settings for this session; Start by checking if new language is requested
    if (isSet($_GET["lang"])) {
        // Set session language, so that it may be retained for 
        // the remainder of the session
        $_SESSION["lang"] = $_GET["lang"];
    
        // Save choice of language in a 365 day cookie at root of site
        setcookie("lang", $_GET["lang"], time() + (3600 * 24 * 365), "/");
    }
    else if(isSet($_COOKIE["lang"])) {
        // Updates session according to found cookie
        $_SESSION["lang"] = $_COOKIE["lang"];
    }
    else {
        $_SESSION['lang'] = 'sv';
    }
    /**
     * Use variable session language to return the correct string.
     * 
     * English text is used as a key. Returned text must be echoed.
     * English text MUST be free of trailing (and heading) whitespace to
     * avoid hard-to-spot-errors and MUST be a key in localizedTextLookupTable
     */
    function getLocalizedText($en_str) {
        switch ($_SESSION["lang"]) {
            case "en":
                return $en_str;
            case "sv":
                return LOCALIZED_TEXT_LOOKUP_TABLE[$en_str]["sv"];
            // To add a new language, simply add it to LOCALIZED_TEXT_LOOKUP_TABLE
            // and add a case following the Swedish example above
            default:
                // Defaults to Swedish; Change if not the case in your case.
                return LOCALIZED_TEXT_LOOKUP_TABLE[$en_str]["sv"];
        }
    }
?>