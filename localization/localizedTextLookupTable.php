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
        "scanian"=>"E-vote - Ditt digitaula röestsystejm",
    ),
    "Voting page"=>array(
        "sv"=>"Röstningssida",
        "scanian"=>"Röestningssiedah",
    ),
    "Log in"=>array(
        "sv"=>"Logga in",
        "scanian"=>"Låugga ejn",
    ),
    "Log out"=>array(
        "sv"=>"Logga ut",
        "scanian"=>"Låugga ud",
    ),
    "Election admin"=>array(
        "sv"=>"Valansvarig",
        "scanian"=>"Vaulansvari'",
    ),
    "Adjuster"=>array(
        "sv"=>"Justerare",
        "scanian"=>"Juesterareh"
    ),
    "Manage users"=>array(
        "sv"=>"Hantera användare",
        "scanian"=>"Handskas mi anvendarna",
    ),
    "Administrator"=>array(
        "sv"=>"Administratör",
        "scanian"=>"Administrautör",
    ),
    "E-vote must be configured"=>array(
        "sv"=>"E-vote måste konfigureras",
        "scanian"=>"E-vote måeste konfigurearas",
    ),
    // Footer
    "Created by Informationsutskottet at E-sektionen at TLTH"=>array(
        "sv"=>"Skapad av Informationsutskottet inom E-sektionen inom TLTH",
        "scanian"=>"Skapad auv Infomationsutskottit inåm E-sektjonen inåm TLTH",
    ),
    "E-vote is open and free software licensed under MPL-2.0. Source code can be found at"=>array(
        "sv"=>"E-vote är öppen och fri mjukvara licenserad under MPL-2.0. Källkod hittas på",
        "scanian"=>"E-vote aer öppen o fri mjuekvaura lisensierad undår MPL-2.0. Källkåud hiddas po'",
    ),
    // install/setup.php
    "E-vote Setup"=>array(
        "sv"=>"E-vote Setup",
        "scanian"=>"E-vote Setaup",
    ),
    "Configuration successfull!"=>array(
        "sv"=>"Konfigurationen lyckades!",
        "scanian"=>"Konfiguratjonen lyckades",
    ),
    "An user with that name already exists in the database."=>array(
        "sv"=>"En avändare med det namnet fanns redan i databasen.",
        "scanian"=>"Ejn anvendare mid de namnet fanns rejdan i dautabausen",
    ),
    "The passwords for superuser does not match. Try again."=>array(
        "sv"=>"Lösenorden för superuser stämmer inte överens. Försök igen.",
        "scanian"=>"Löesenorden föer superuser är ente samma. Testa igjen.",
    ),
    "All fields not filled in"=>array(
        "sv"=>"Alla fällt är inte ifyllda.",
        "scanian"=>"Alla fielt aer ente ijfyllda",
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
        "scanian"=>"Hallå! Vad skoej att juest nie vill böerja anvinda E-vote.\n
        <br>\n
        <br> Fyll i dautan föer ditt systejm naedan för att konfigurera.\n
        <br> Se ti' att skriejva in rätt grejor föer att ente behöva fibbla med det manuellt sen.",
    ),
    "Database configuration"=>array(
        "sv"=>"Databaskonfiguration",
        "scanian"=>"Dautabauskonfiguration",
    ),
    "Host:"=>array(
        "sv"=>"Host:",
        "scanian"=>"Host:",
    ),
    "Database name:"=>array(
        "sv"=>"Databasnamn:",
        "scanian"=>"Dautabausnamn:",
    ),
    "User:"=>array(
        "sv"=>"Användare:",
        "scanian"=>"anvendare",
    ),
    "Password:"=>array(
        "sv"=>"Lösenord:",
        "scanian"=>"Löesenord",
    ),
    "This is the user that has full control of the system. This user can't be deleted from the database."=>array(
        "sv"=>"Detta är användaren som har full kontrol på systemet. Denna användare kan inte raderas från databasen.",
        "scanian"=>"Detta äer anvendaren som bestimmer över hela systemet. Den kan ente tas bort från dautabausen.",
    ),
    "Name:"=>array(
        "sv"=>"Namn:",
        "scanian"=>"Namn:",
    ),
    "Repeat password:"=>array(
        "sv"=>"Upprepa lösenord:",
        "scanian"=>"Skriev det ijen så man veat att du kann",
    ),
    "E-vote is configured!"=>array(
        "sv"=>"E-vote är konfigurerat!",
        "scanian"=>"E-vote äer konfigurerat",
    ),
    // index/clear.php
    "Close current election"=>array(
        "sv"=>"Stäng nuvarande val",
        "scanian"=>"Stäng det öppna vaulet",
    ),
    "Your password:"=>array(
        "sv"=>"Ditt lösenord:",
        "scanian"=>"Ditt löesenord",
    ),
    "Delete election"=>array(
        "sv"=>"Radera val",
        "scanian"=>"Ta bort vaul",
    ),
    // No permission
    "You don't have permission to view this page."=>array(
        "sv"=>"Du har inte behörighet att visa denna sida.",
        "scanian"=>"Ditt ålahue du kan ente se denna sijdan.",
    ),
    // install/vote/front.php
    "There is currently no election session."=>array(
        "sv"=>"Det finns inget pågående val för tillfället.",
        "scanian"=>"Det finns inge' vaul just nue.",
    ),
    "Checking for new election round in"=>array(
        "sv"=>"Kollar efter ny omröstning om",
        "scanian"=>"Kållar efter ny omröestning om",
    ),
    "Oops! Could not check for new election round. Try refreshing the page!"=>array(
        "sv"=>"Hoppsan! Kunde inte kolla efter ny omröstning. Testa att ladda om sidan!",
        "scanian"=>"Faen! Kunde ente se om de fanns en ny omröestning. Testa ladda om sijdan!",
    ),
    "Refresh Page"=>array(
        "sv"=>"Ladda om sidan",
        "scanian"=>"Ladda om sijdan",
    ),
    "There is nothing to vote on currently. Take a cookie."=>array(
        "sv"=>"Det finns inget att rösta på för tillfället. Ta en kaka.",
        "scanian"=>"Det finns inge' att röesta po' just nue. Ta ejn spiddekauga. "
    ),
    "Voting in progress"=>array(
        "sv"=>"Röstning pågår",
        "scanian"=>"Röestning påugåur",
    ),
    // These two are a bit iffy, since we need to insert a number in the middle.
    // Check the source file for help how to do this properly in your language
    "You can vote on <b>"=>array(
        "sv"=>"Du får rösta på <b>",
        "scanian"=>"Due fåur rösta po' <b>",
    ),
    "</b> of the alternatives"=>array(
        "sv"=>"</b> av alternativen",
        "scanian"=>"</b> auv aelternatijven.",
    ),
    // end of iffy things (for now)
    "Personal code:"=>array(
        "sv"=>"Personlig valkod:",
        "scanian"=>"Pärsonlig vaulkåd:",
    ),
    "Temporary code:"=>array(
        "sv"=>"Tillfällig valkod:",
        "scanian"=>"Ti'fälli' vaulkåd:",
    ),
    "Vote!"=>array(
        "sv"=>"Rösta!",
        "scanian"=>"Röesta!",
    ),
    // index/useradmin/useradminpanel.php
    "Choose"=>array(
        "sv"=>"Välj",
        "scanian"=>"Väelj",
    ),
    "Name"=>array(
        "sv"=>"Namn",
        "scanian"=>"Namn",
    ),
    "Privileges"=>array(
        "sv"=>"Privilegier",
        "scanian"=>"Pri'velejor",
    ),
    "Remove selected users"=>array(
        "sv"=>"Ta bort markerade användare",
        "scanian"=>"Tau bort ikryssad anvendare",
    ),
    // index/useradmin/newuser.php
    "Create new user"=>array(
        "sv"=>"Skapa ny användare",
        "scanian"=>"Skaupa ny anvendare",
    ),
    "Username:"=>array(
        "sv"=>"Användarnamn:",
        "scanian"=>"Anvindarnamn:",
    ),
    "Privileges:"=>array(
        "sv"=>"Privilegier:",
        "scanian"=>"Pri'velejor",
    ),
    // index/useradmin/changepassword.php
    "Change password"=>array(
        "sv"=>"Ändra lösenord",
        "scanian"=>"Endra löesenord",
    ),
    "New password:"=>array(
        "sv"=>"Nytt lösenord:",
        "scanian"=>"Nytt löesenord",
    ),
    "Are you sure you want to log out?"=>array(
        "sv"=>"Är du säker på att du vill logga ut?",
        "scanian"=>"Äer due sääker po' att du ska logga ud?",
    ),
    // index/electionadmin/electionadminpanel.php
    "Some shady character has done something with the database."=>array(
        "sv"=>"Någon fuling har mixtrat i databasen.",
        "scanian"=>"Nåen fubbick har fulat saj i dautabausen",
    ),
    "There is no ongoing election session."=>array(
        "sv"=>"Det pågår inget valtillfälle.",
        "scanian"=>"De påugåur enget vaultillfelle",
    ),
    "Create new election round"=>array(
        "sv"=>"Skapa ny valomgång",
        "scanian"=>"Skaupa ny vaulomgong",
    ),
    "What to be elected:"=>array(
        "sv"=>"Vad som ska väljas:",
        "scanian"=>"Vaud som ska' veljas",
    ),
    "Number of selectable options:"=>array(
        "sv"=>"Antal valbara alternativ:",
        "scanian"=>"Antaul vaulbaura alternatejv",
    ),
    "Alternatives:"=>array(
        "sv"=>"Alternativ:",
        "scanian"=>"Alertnatejv:",
    ),
    "Increase/decrease number of fields:"=>array(
        "sv"=>"Öka/minska antalet fält:",
        "scanian"=>"Öga/mijnska antaulet fielt",
    ),
    "Start new election round"=>array(
        "sv"=>"Starta ny valomgång",
        "scanian"=>"Staurta ny vaulomgong",
    ),
    "Previous election round"=>array(
        "sv"=>"Föregående valomgång",
        "scanian"=>"Förra vaulomgongen",
    ),
    "End election round"=>array(
        "sv"=>"Avsluta valomgång",
        "scanian"=>"Auvsluda vaulomgongen",
    ),
    // index/classes/TableGenerator.php
    "votes"=>array(
        "sv"=>"röster",
        "scanian"=>"röestor"
    ),
    "opt."=>array(
        "sv"=>"alt.",
        "scanian"=>"alt.",
    ),
    "Nothing has been elected yet"=>array(
        "sv"=>"Ingenting har valts ännu",
        "scanian"=>"Engenting haur vaulds enn",
    ),
    "No election opportunity in sight"=>array(
        "sv"=>"Inget valtillfälle i sikte",
        "scanian"=>"Jaug ser inge vaultillfielle",
    ),
    "Opened"=>array(
        "sv"=>"Öppnad",
        "scanian"=>"Öeppnad",
    ),
    "Closed"=>array(
        "sv"=>"Stängd",
        "scanian"=>"Stingd",
    ),
    // index/classes/MenuGenerator.php
    "Administrate election"=>array(
        "sv"=>"Administrera val",
        "scanian"=>"Styer över vaul",
    ),
    "See previous rounds"=>array(
        "sv"=>"Se tidigare omgångar",
        "scanian"=>"Se tidigare omgångar",
    ),
    "See previous round"=>array(
        "sv"=>"Se föregående omgång",
        "scanian"=>"Se föregående omgång",
    ),
    "See all rounds"=>array(
        "sv"=>"Se alla omgångar",
        "scanian"=>"Se alla omgångar",
    ),
    "New user"=>array(
        "sv"=>"Ny användare",
        "scanian"=>"Ny anvendare",
    ),
    "Manage election session"=>array(
        "sv"=>"Hantera valtillfälle",
        "scanian"=>"Hannteara vaultillfielle",
    ),
    "Usage history"=>array(
        "sv"=>"Användningshistorik",
        "scanian"=>"Anvindningshisstårik",
    ),
    // index/admin/electionControl.php
    "Create new election"=>array(
        "sv"=>"Skapa nytt val",
        "scanian"=>"Skaupa nytt vaul",
    ),
    "Name of election:"=>array(
        "sv"=>"Namn på val:",
        "scanian"=>"Namn po' vaul",
    ),
    "Max number of people:"=>array(
        "sv"=>"Max antal personer:",
        "scanian"=>"Max antal personor:",
    ),
    "Receive codes in CSV-format (for distance voting)"=>array(
        "sv"=>"Få koder i CSV-format (för distanstörstning)",
        "scanian"=>"Fåuh kåder i CSV-formaud (föer distansröestning)",
    ),
    "Create"=>array(
        "sv"=>"Skapa",
        "scanian"=>"Skaupa",
    ),
    "A new election has been created!"=>array(
        "sv"=>"Ett nytt val har skapats!",
        "scanian"=>"Ett nydd vaul haur skaupadts!",
    ),
    "Close current election"=>array(
        "sv"=>"Stäng nuvarande val",
        "scanian"=>"Stieng vaulet som é nue",
    ),
    "Close election"=>array(
        "sv"=>"Stäng val",
        "scanian"=>"Stieng vaul"
    ),
    "Previous election rounds"=>array(
        "sv"=>"Tidigare valomgångar",
        "scanian"=>"Tiddigare vaulomgongar",
    ),
    // actions/votingspagehandler.php
    "You have not selected anything to vote on"=>array(
        "sv"=>"Du har inte valt någon att rösta på",
        "scanian"=>"Du haur ente vault nån att röesta po'",
    ),
    "The election round you are trying to vote on has already ended. The page has been refreshed so you can try again"=>array(
        "sv"=>"Den valomgång du försöker rösta på har redan avslutats. Sidan har nu uppdaterats så du kan försöka igen",
        "scanian"=>"Den vaulomgongen due föersööker röesta po' haur rejdan avsludads. Sijdan haur nue oppdaterats såe due kan testa ijen",
    ),
    "You are not allowed to pick too many candidates"=>array(
        "sv"=>"Du får inte välja för många kandidater",
        "scanian"=>"Due fåur ente vilja för många kandidator",
    ),
    "You have not entered any personal code"=>array(
        "sv"=>"Du har inte angett någon personlig valkod",
        "scanian"=>"Due har ente gett nån personlig vaulkåd",
    ),
    "You have not entered any temporary code"=>array(
        "sv"=>"Du har inte angett någon tillfällig valkod",
        "scanian"=>"Due haur ente gett nån tillfälli' vaulkåd",
    ),
    "The election round has already been terminated"=>array(
        "sv"=>"Valomgången har redan avslutats",
        "scanian"=>"Vaulomgongen haur rejdan auvsludats",
    ),
    "Your vote has been registered"=>array(
        "sv"=>"Din röst har blivit registrerad",
        "scanian"=>"Dien röest haur blivid registrerad",
    ),
    "Your vote was not registered. This can depend on you entering one of the codes wrong, or because you already have voted"=>array(
        "sv"=>"Din röst blev inte registrerad. Detta kan bero på att du skrev in någon av koderna fel eller att du redan röstat",
        "scanian"=>"Dien röst blejv ente registrerad. Det kan bero po' att du skrejv in nån av kåderna fejl ellor för att due rejdan röstat. Fubbik."
    ),
    // actions/usersessionhandler.php
    "You have not entered any username"=>array(
        "sv"=>"Du har inte skrivit in något användarnamn",
        "scanian"=>"Due har ente skrivit in nått användarnamn",
    ),
    "You have not entered any password"=>array(
        "sv"=>"Du har inte angett något lösenord",
        "scanian"=>"Due haur ente angett nått löesenord",
    ),
    "The username and/or the password is wrong"=>array(
        "sv"=>"Användarnamet och/eller lösenordet är fel",
        "scanian"=>"Anvendarnamnet og/ellor löesenordet é fejl",
    ),
    "One or more of the fields were empty"=>array(
        "sv"=>"Något av fälten var tomma",
        "scanian"=>"Nått av fielten va' tomma",
    ),
    "The username you entered already exists"=>array(
        "sv"=>"Användarnamnet du angav finns redan",
        "scanian"=>"Anvendarnamnet due gauv finns rejdan",
    ),
    "The password has been changed"=>array(
        "sv"=>"Lösenordet är bytt",
        "scanian"=>"Löesenordet é bytat",   // First actual translation is "bytt" -> "bytat"
    ),
    "A new user has been created"=>array(
        "sv"=>"En ny användare har skapats",
        "scanian"=>"En ny anvendare haur skapats",
    ),
    "User deleted"=>array(
        "sv"=>"Användaren raderades",
        "scanian"=>"Anvendaren tos bort",
    ),
    "You have not chosen any users to delete"=>array(
        "sv"=>"Du har inte valt några användare att radera",
        "scanian"=>"Due haur ente vault nån anvendare att tau bort",
    ),
    // actions/genlastresult.php
    "Please wait. Voting in progress."=>array(
        "sv"=>"Var vänlig vänta. Röstning pågår.",
        "scanian"=>"Venta föer faen. Just nue röestas det.",
    ),
    // actions/electionadminpagehandler.php
    "You have not entered what to be elected"=>array(
        "sv"=>"Du har inte angett vad som ska väljas",
        "scanian"=>"Due haur ente sagt vaud som ska veljas",
    ),
    "You have not entered how many one can vote on"=>array(
        "sv"=>"Du har inte angett hur många man får rösta på",
        "scanian"=>"Due haur ente sagt huer många man får röesta po'",
    ),
    "An election is already in progress"=>array(
        "sv"=>"En valomgång är redan igång",
        "scanian"=>"Ejn vaulomgong é rejdan igång",
    ),
    "You must enter at least two candidates"=>array(
        "sv"=>"Du måste ange minst två kandidater",
        "scanian"=>"Due måste ange minst tvåu kandidautor",
    ),
    "A new election round has begun"=>array(
        "sv"=>"En ny valomgång har börjat",
        "scanian"=>"Ejn ny vaulomgong haur startat'",
    ),
    // actions/csvcodesend.php
    "Personal code"=>array(
        "sv"=>"Personlig valkod",
        "scanian"=>"Personli' vaulkåd",
    ),
    "Boo! You are not allowed to do that."=>array(
        "sv"=>"Fy! Så får du inte göra.",
        "scanian"=>"Nej för faen! Såu fåur du ente göra.",
    ),
    // actions/codeprint.php
    "E-vote, E-sektionen's voting system"=>array(
        "sv"=>"E-vote, E-sektionens röstningssystem",
        "scanian"=>"E-vote, E-sektionens röestningsystejm",
    ),
    "Your personal code is"=>array(
        "sv"=>"Din personliga valkod är",
        "scanian"=>"Dijn personliga vaulkåd é",
    ),
    // actions/adminpagehandler.php
    "You have not entered a name for the election"=>array(
        "sv"=>"Du har inte angett något namn på valet",
        "scanian"=>"Due haur ente sagt nått namn po' vaulet",
    ),
    "You have not entered the max number of people"=>array(
        "sv"=>"Du har inte angett det maximala antalet personer",
        "scanian"=>"Due haur ente sagt max folk",
    ),
    "There is already an election in progress"=>array(
        "sv"=>"Det pågår redan ett val",
        "scanian"=>"Det påugåur redan ett vaul",
    ),
    "The election is now closed"=>array(
        "sv"=>"Valet är nu stängt",
        "scanian"=>"Vaulet é stängt nue",
    ),
    "Wrong username and/or password somewhere"=>array(
        "sv"=>"Fel lösenord och/eller användarnamn någonstans",
        "scanian"=>"Fejl löesenord og/ellor anvendarnamn nånstans",
    ),
    // data/RandomInfo.php
    // Success array
    "*Happy trumpet fanfare*"=>array(
        "sv"=>"*Glad trumpetfanfar*",
        "scanian"=>"*Glaud trumpetfanfar*",
    ),
    "You're the best!"=>array(
        "sv"=>"Du är bäst!",
        "scanian"=>"Due é en päärla",
    ),
    "You know this!"=>array(
        "sv"=>"Du kan det här!",
        "scanan"=>"Du fattar det här!",
    ),
    "Splendid!"=>array(
        "sv"=>"Kanon!",
        "scanian"=>"Redigt bra!",
    ),
    "You are unreasonably good at this!"=>array(
        "sv"=>"Du är orimligt duktig på det här!",
        "scanian"=>"Due é sinnessjukt brau på detta!",
    ),
    "Cool!"=>array(
        "sv"=>"Coolt!",
        "scanian"=>"Ballt!",
    ),
    "Ja!"=>array( // this one is the other way around
        "sv"=>"Yes!",
        "scanian"=>"Oui!",
    ),
    "What a talent!"=>array(
        "sv"=>"Vilken talang!",
        "scanian"=>"Som en äkta MFF:are!", // #mestamästarna
    ),
    "You did it!"=>array(
        "sv"=>"Du lyckades!",
        "scanian"=>"Due gjoerde ente fejl!",
    ),
    "Very niice!"=>array(
        "sv"=>"Kalasbra!",
        "scanian"=>"Riiktigt brau!",
    ),
    "Immense happiness!"=>array(
        "sv"=>"Ofantlig lycka!",
        "scanian"=>"Jäevligt glatt!",
    ),
    "Really good!"=>array(
        "sv"=>"Toppenbra!",
        "scanian"=>"Dejlig!",
    ),
    "Yup!"=>array(
        "sv"=>"Jajamensan!",
        "scanian"=>"Jaddå!",
    ),
    "Look at them skillz!"=>array(
        "sv"=>"Look at dem skillz!",
        "scanian"=>"Kålla in skillzen!",
    ),
    "You got some MAD voting skills!"=>array(
        "sv"=>"You got some MAD voting skills!",
        "scanian"=>"You gått såm MAD voting skills!",
    ),
    "Your degree of being good is high!"=>array(
        "sv"=>"Din duktighetsgrad är hög!",
        "scanian"=>"Due é en Skåuning i själen!",
    ),
    "Fantastic!"=>array(
        "sv"=>"Fantastiskt!",
        "scanian"=>"Fantastiiskt!",
    ),
    "Truly great!"=>array(
        "sv"=>"Storartat!",
        "scanian"=>"Som en skåunsk såmmardaug!",
    ),
    "Phenomenal!"=>array(
        "sv"=>"Fenomenalt!",
        "scanian"=>"Fenåmenault!",
    ),
    "Outstanding!"=>array(
        "sv"=>"Enastående!",
        "scanian"=>"En po' miljonen!",
    ),
    "Formidable!"=>array(
        "sv"=>"Formidabelt!",
        "scanian"=>"Stabilare änn Hallandsåsen!",
    ),
    "Brilliant!"=>array(
        "sv"=>"Strålande!",
        "scanian"=>"Stråulande!",
    ),
    "Magnificent!"=>array(
        "sv"=>"Magnifikt!",
        "scanian"=>"Maxat!",
    ),
    "Excellent!"=>array(
        "sv"=>"Förträffligt!",
        "scanian"=>"Redit'!",
    ),
    "Noice!"=>array(
        "sv"=>"Smäckert!",
        "scanian"=>"Naaajs",
    ),
    "Real tough!"=>array(
        "sv"=>"Tufft!",
        "scanian"=>"Tuff!",
    ),
    // ...
    "You get an A in Usage of E-vote!"=>array(
        "sv"=>"Du får en 5:a i användning av E-vote",
        "scanian"=>"Due fåur en fimma i att anvenda E-vote",
    ),
    "You are so good!"=>array(
        "sv"=>"Du är underbart duktig!",
        "scanian"=>"Due röestar som en riktig skåuning!",
    ),
    "YEAH!"=>array(
        "sv"=>"GÖTTANS",
        "scanian"=>"GÖTT",
    ),
    // Error array
    "Something went wrong."=>array(
        "sv"=>"Något gick fel.",
        "scanian"=>"Nått funkade ente",
    ),
    "Ouch!"=>array(
        "sv"=>"Ajdå!",
        "scanian"=>"Ajdåeh!",
    ),
    "Oof!"=>array(
        "sv"=>"Attans!",
        "scanian"=>"Faen osså",
    ),
    "Whoops!"=>array(
        "sv"=>"Whoops!",
        "scanian"=>"Whoops!",
    ),
    "Nooo!"=>array(
        "sv"=>"Naj!",
        "scanian"=>"*stockholmska* Åh neeeej",
    ),
    "Oopsie!"=>array(
        "sv"=>"Hoppsan!",
        "scanian"=>"Ålarens!",
    ),
    "Gosh darn it"=>array(
        "sv"=>"Rackarns!",
        "scanian"=>"Föer i hilvede!",
    ),
    "Nails!"=>array(
        "sv"=>"Järnspikar!",
        "scanian"=>"De vau ju själva faen!",
    ),
    "Frick!"=>array(
        "sv"=>"Sablarns!",
        "scanian"=>"Fubbik!",
    ),
    "What the frick?!"=>array(
        "sv"=>"Attans järnspikar!",
        "scanian"=>"Stockholm osså!",
    ),
    "Whuuupps!"=>array(
        "sv"=>"Whuuupps!",
        "scanian"=>"Ente Guld o gröna skogar!",
    ),
)
);
?>