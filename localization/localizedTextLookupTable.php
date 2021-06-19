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
 * 
 * CHANGING ENGLISH TEXT REQUIRES CHANGE IN SOURCE FILES AS WELL
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
    // index/clear.php
    "Close current election"=>array(
        "sv"=>"Stäng nuvarande val",
    ),
    "Your password:"=>array(
        "sv"=>"Ditt lösenord:",
    ),
    "Delete election"=>array(
        "sv"=>"Radera val",
    ),
    // No permission
    "You don't have permission to view this page."=>array(
        "sv"=>"Du har inte behörighet att visa denna sida.",
    ),
    // install/vote/front.php
    "There is currently no election session."=>array(
        "sv"=>"Det finns inget pågående val för tillfället.",
    ),
    "Checking for new election round in"=>array(
        "sv"=>"Kollar efter ny omröstning om",
    ),
    "Oops! Could not check for new election round. Try refreshing the page!"=>array(
        "sv"=>"Hoppsan! Kunde inte kolla efter ny omröstning. Testa att ladda om sidan!",
    ),
    "Refresh Page"=>array(
        "sv"=>"Ladda om sidan",
    ),
    "There is nothing to vote on currently. Take a cookie."=>array(
        "sv"=>"Det finns inget att rösta på för tillfället. Ta en kaka.",
    ),
    "Voting in progress"=>array(
        "sv"=>"Röstning pågår",
    ),
    // These two are a bit iffy, since we need to insert a number in the middle.
    // Check the source file for help how to do this properly in your language
    "You can vote on <b>"=>array(
        "sv"=>"Du får rösta på <b>"
    ),
    "</b> of the alternatives"=>array(
        "sv"=>"</b> av alternativen",
    ),
    // end of iffy things (for now)
    "Personal code:"=>array(
        "sv"=>"Personlig valkod:",
    ),
    "Temporary code:"=>array(
        "sv"=>"Tillfällig valkod:",
    ),
    "Vote!"=>array(
        "sv"=>"Rösta!",
    ),
    // index/useradmin/useradminpanel.php
    "Choose"=>array(
        "sv"=>"Välj",
    ),
    "Name"=>array(
        "sv"=>"Namn",
    ),
    "Privileges"=>array(
        "sv"=>"Privilegier",
    ),
    "Remove selected users"=>array(
        "sv"=>"Ta bort markerade användare",
    ),
    // index/useradmin/newuser.php
    "Create new user"=>array(
        "sv"=>"Skapa ny användare",
    ),
    "Username:"=>array(
        "sv"=>"Användarnamn:",        
    ),
    "Privileges:"=>array(
        "sv"=>"Privilegier:",
    ),
    // index/useradmin/changepassword.php
    "Change password"=>array(
        "sv"=>"Ändra lösenord",
    ),
    "New password:"=>array(
        "sv"=>"Nytt lösenord:",
    ),
    "Are you sure you want to log out?"=>array(
        "sv"=>"Är du säker på att du vill logga ut?",
    ),
    // index/electionadmin/electionadminpanel.php
    "Some shady character has done something with the database."=>array(
        "sv"=>"Någon fuling har mixtrat i databasen.",
    ),
    "There is no ongoing election session."=>array(
        "sv"=>"Det pågår inget valtillfälle.",
    ),
    "Create new election round"=>array(
        "sv"=>"Skapa ny valomgång"
    ),
    "What to be elected:"=>array(
        "sv"=>"Vad som ska väljas:",
    ),
    "Number of selectable options:"=>array(
        "sv"=>"Antal valbara alternativ:",
    ),
    "Alternatives:"=>array(
        "sv"=>"Alternativ:",
    ),
    "Increase/decrease number of fields:"=>array(
        "sv"=>"Öka/minska antalet fält:",
    ),
    "Start new election round"=>array(
        "sv"=>"Starta ny valomgång",
    ),
    "Previous election round"=>array(
        "sv"=>"Föregående valomgång",
    ),
    "End election round"=>array(
        "sv"=>"Avsluta valomgång",
    ),
    // index/classes/TableGenerator.php
    "votes"=>array(
        "sv"=>"röster",
    ),
    "opt."=>array(
        "sv"=>"alt."
    ),
    "Nothing has been elected yet"=>array(
        "sv"=>"Ingenting har valts ännu",
    ),
    "No election opportunity in sight"=>array(
        "sv"=>"Inget valtillfälle i sikte",
    ),
    "<th>Name</th>
    <th>Opened</th>
    <th>Closed</th>
    </tr>"=>array(
        "sv"=>"<th>Namn</th>
        <th>Öppnad</th>
        <th>Stängd</th>
        </tr>",
    ),
    // index/classes/MenuGenerator.php
    "Administrate election"=>array(
        "sv"=>"Administrera val",
    ),
    "See previous rounds"=>array(
        "sv"=>"Se tidigare omgångar",
    ),
    "See previous round"=>array(
        "sv"=>"Se föregående omgång",
    ),
    "See all rounds"=>array(
        "sv"=>"Se alla omgångar",
    ),
    "New user"=>array(
        "sv"=>"Ny användare",
    ),
    "Manage election session"=>array(
        "sv"=>"Hantera valtillfälle",
    ),
    "Usage history"=>array(
        "sv"=>"Användningshistorik",
    ),
    // index/admin/electionControl.php
    "Create new election"=>array(
        "sv"=>"Skapa nytt val",
    ),
    "Name of election:"=>array(
        "sv"=>"Namn på val:",
    ),
    "Max number of people:"=>array(
        "sv"=>"Max antal personer:",
    ),
    "Receive codes in CSV-format (for distance voting)"=>array(
        "sv"=>"Få koder i CSV-format (för distanstörstning)",
    ),
    "Create"=>array(
        "sv"=>"Skapa",
    ),
    "A new election has been created!"=>array(
        "sv"=>"Ett nytt val har skapats!",
    ),
    "Close current election"=>array(
        "sv"=>"Stäng nuvarande val",
    ),
    "Close election"=>array(
        "sv"=>"Stäng val",
    ),
    "Previous election rounds"=>array(
        "sv"=>"Tidigare valomgångar",
    ),
    // actions/votingspagehandler.php
    "You have not selected anything to vote on"=>array(
        "sv"=>"Du har inte valt någon att rösta på",
    ),
    "The election round you are trying to vote on has already ended. The page has been refreshed so you can try again"=>array(
        "sv"=>"Den valomgång du försöker rösta på har redan avslutats. Sidan har nu uppdaterats så du kan försöka igen",
    ),
    "You are not allowed to pick too many candidates"=>array(
        "sv"=>"Du får inte välja för många kandidater",
    ),
    "You have not entered any personal code"=>array(
        "sv"=>"Du har inte angett någon personlig valkod",
    ),
    "You have not entered any temporary code"=>array(
        "sv"=>"Du har inte angett någon tillfällig valkod",
    ),
    "The election round has already been terminated"=>array(
        "sv"=>"Valomgången har redan avslutats",
    ),
    "Your vote has been registered"=>array(
        "sv"=>"Din röst har blivit registrerad",
    ),
    "Your vote was not registered. This can depend on you entering one of the codes wrong, or because you already have voted"=>array(
        "sv"=>"Din röst blev inte registrerad. Detta kan bero på att du skrev in någon av koderna fel eller att du redan röstat",
    ),
    // actions/usersessionhandler.php
    "You have not entered any username"=>array(
        "sv"=>"Du har inte skrivit in något användarnamn",
    ),
    "You have not entered any password"=>array(
        "sv"=>"Du har inte angett något lösenord",
    ),
    "The username and/or the password is wrong"=>array(
        "sv"=>"Användarnamet och/eller lösenordet är fel",
    ),
    "One or more of the fields were empty"=>array(
        "sv"=>"Något av fälten var tomma",
    ),
    "The username you entered already exists"=>array(
        "sv"=>"Användarnamnet du angav finns redan",
    ),
    "The password has been changed"=>array(
        "sv"=>"Lösenordet är bytt",
    ),
    "A new user has been created"=>array(
        "sv"=>"En ny användare har skapats",
    ),
    "User deleted"=>array(
        "sv"=>"Användaren raderades",
    ),
    "You have not chosen any users to delete"=>array(
        "sv"=>"Du har inte valt några användare att radera",
    ),
    // actions/genlastresult.php
    "Please wait. Voting in progress."=>array(
        "sv"=>"Var vänlig vänta. Röstning pågår.",
    ),
    // actions/electionadminpagehandler.php
    "You have not entered what to be elected"=>array(
        "sv"=>"Du har inte angett vad som ska väljas",
    ),
    "You have not entered how many one can vote on"=>array(
        "sv"=>"Du har inte angett hur många man får rösta på",
    ),
    "An election is already in progress"=>array(
        "sv"=>"En valomgång är redan igång",
    ),
    "You must enter at least two candidates"=>array(
        "sv"=>"Du måste ange minst två kandidater",
    ),
    "A new election round has begun"=>array(
        "sv"=>"En ny valomgång har börjat",
    ),
    // actions/csvcodesend.php
    "Personal code"=>array(
        "sv"=>"Personlig valkod",
    ),
    "Boo! You are not allowed to do that."=>array(
        "sv"=>"Fy! Så får du inte göra."
    ),
    // actions/codeprint.php
    "E-vote, E-sektionen's voting system"=>array(
        "sv"=>"E-vote, E-sektionens röstningssystem",
    ),
    "Your personal code is"=>array(
        "sv"=>"Din personliga valkod är",
    ),
    // actions/adminpagehandler.php
    "You have not entered a name for the election"=>array(
        "sv"=>"Du har inte angett något namn på valet",
    ),
    "You have not entered the max number of people"=>array(
        "sv"=>"Du har inte angett det maximala antalet personer",
    ),
    "There is already an election in progress"=>array(
        "sv"=>"Det pågår redan ett val",
    ),
    "The election is now closed"=>array(
        "sv"=>"Valet är nu stängt",
    ),
    "Wrong username and/or password somewhere"=>array(
        "sv"=>"Fel lösenord och/eller användarnamn någonstans",
    ),
)
);
?>