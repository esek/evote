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
 *      "de"=>"Beispieltext",   // All items must have trailing ,
 *  ),
 * )
 * 
 * To add localization for your language, simply add translations
 * in this file, add the case in getLocalizedText.php and add
 * language option in index.php
 * 
 * Add text under the correct comment (first time it appears in a file)
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
    ),
    // install/setup.php
    "E-vote Setup"=>array(
        "sv"=>"E-vote Setup",
    ),
    "Configuration successfull!"=>array(
        "sv"=>"Konfigurationen lyckades!",
    ),
    "An user with that name already exists in the database."=>array(
        "sv"=>"En avändare med det namnet fanns redan i databasen.",
    ),
    "The passwords for superuser does not match. Try again."=>array(
        "sv"=>"Lösenorden för superuser stämmer inte överens. Försök igen.",
    ),
    "All fields not filled in"=>array(
        "sv"=>"Alla fällt är inte ifyllda.",
    ),
    // install/setup.php: Actual HTML seen by user
    "Hi! How fun that you want to start using E-vote.\n
    <br>\n
    <br> Fill out the form according to your setup to configure.\n
    <br> Make sure to put in the correct values so they don't have to be changed manually afterwards."=>array(
        "sv"=>"Hej! Vad kul att just ni vill börja använda E-vote.\n
        <br>\n
        <br> Fyll i datan som gäller för ditt system nedan för att konfigurera.\n
        <br> Se till att skriva in rätt värden för att inte behöva ändra dessa manuelt efteråt.",
    ),
    "Database configuration"=>array(
        "sv"=>"Databaskonfiguration",
    ),
    "Host:"=>array(
        "sv"=>"Host:",
    ),
    "Database name:"=>array(
        "sv"=>"Databasnamn:",
    ),
    "User:"=>array(
        "sv"=>"Användare:",
    ),
    "Password:"=>array(
        "sv"=>"Lösenord:",
    ),
    "This is the user that has full control of the system. This user can't be deleted from the database."=>array(
        "sv"=>"Detta är användaren som har full kontrol på systemet. Denna användare kan inte raderas från databasen.",
    ),
    "Name:"=>array(
        "sv"=>"Namn:",
    ),
    "Repeat password:"=>array(
        "sv"=>"Upprepa lösenord:",
    ),
    "E-vote is configured!"=>array(
        "sv"=>"E-vote är konfigurerat!",
    ),
)
);
?>