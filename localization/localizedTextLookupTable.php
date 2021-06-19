<?php
/**
 * This is the lookup table used to give the user the correct
 * translation. English strings are keys in the array, and point
 * to arrays themselves were language codes are keys. English is NOT
 * stored in these arrays, since that would mean they are stored twice.
 * 
 * Strings must contain zero heading och leading whitespace
 * 
 * Example with three languages
 * 
 * array(
 * "Example text"=> array(
 *      "sv"=>"Exempeltext",
 *      "de"=>"Beispieltext"
 *  ),
 * )
 * 
 * To add localization for your language, simply add translations
 * in this file, add the case in getLocalizedText.php and add
 * language option in index.php
 */
define("LOCALIZED_TEXT_LOOKUP_TABLE", array(
    // index.php
    "E-vote - Your digital voting system"=>array(
        "sv"=>"E-vote - Ditt digitala röstsystem",
    ),
    "Voting page"=>array(
        "sv"=>"Röstningssida",
    ),
    "Log in"=>array(
        "sv"=>"Logga in",
    ),
    "Log out"=>array(
        "sv"=>"Logga ut",
    ),
    "Election admin"=>array(
        "sv"=>"Valansvarig",
    ),
    "Adjuster"=>array(
        "sv"=>"Justerare",
    ),
    "Manage users"=>array(
        "sv"=>"Hantera användare",
    ),
    "Administrator"=>array(
        "sv"=>"Administratör",
    ),
    "E-vote must be configured"=>array(
        "sv"=>"E-vote måste konfigureras",
    ),
    // Footer
    "Created by Informationsutskottet at E-sektionen at TLTH"=>array(
        "sv"=>"Skapad av Informationsutskottet inom E-sektionen inom TLTH",
    ),
    "E-vote is open and free software licensed under MPL-2.0. Source code can be found at"=>array(
        "sv"=>"E-vote är öppen och fri mjukvara licenserad under MPL-2.0. Källkod hittas på"
    )
)
);
?>