<?php
// klass som används för att generera slumpmässig info till användaren
class RandomInfo {

    private function randomIndex($arr){
        return rand(0, count($arr) - 1);
    }

    //Generea text i popup-rutorna
    public function generateTip($type){
        $suc_info = array(
            "*Glad trumpetfanfar*",
            "Du är bäst!",
            "Du kan det här!",
            "Kanon!!",
            "Du är orimligt duktig på det här!",
            "Coolt!",
            "Yes!",
            "Vilken talang!",
            "Du lyckades!",
            "Kalasbra!",
            "Ofantlig lycka!",
            "Toppenbra!",
            "Jajamensan!",
            "Look at dem skillz!",
            "You got some MAD voting skills!",
            "Din duktighetsgrad är hög!",
            "Fantastiskt!",
            "Storartat!",
            "Fenomenalt!",
            "Enastående!",
            "Formidabelt!",
            "Strålande!",
            "Magnifikt!",
            "Förträffligt!",
            "Smäckert!",
            "Tufft!",
            "Nice!",
            "Niiiiiiicee!!",
            "Najs!",
            "Naaajs!",
            "M-M-M-MONSTER VOTE!!!",
            "Soft!",
            "Du får en 5:a i användning av E-vote",
            "Wupp!",
            "WAPP!",
            "Wopp!",
            "Gosigt!",
            ":)",
            "Hacke hälsar att du är underbart duktig!",
            "Wubwubwub.. DROP THE BASE!!!",
            "Man ska ha E-vote - så att man slipper tänka alls",
            "Man ska ha E-vote - det har jag sett att andra har",
            "Man ska ha E-vote - då är kalkylen redan klar",
            "Man ska ha E-vote - det bygger på nån slags logik",
            "Ett KOOOMPLEEXT ord, vad f*n betyder acklamation",
            "Min gode vän E-vote, han är en snabb kamrat, han har en ruta här och några knappar där.",
            "Double rainbow!",
            "GÖTTANS!!"
        );
        $err_info = array(
            "Något gick fel",
            "Ajdå!",
            "Attans!",
            "Whoops",
            "Naj!",
            "Ojdå!",
            "Hoppsan!",
            "Rackarns!",
            "Järnspikar!",
            "Sablarns!",
            "Attans järnspikar!",
            "Whuuupps!",
            "Neeeeeeeeejjjjjj detta var ju inte bra, nu har du gjort nått fel"
        );

        $msg = "";
        if($type == "success"){
            $msg = $suc_info[$this->randomIndex($suc_info)];
        }else if($type == "error"){
            $msg = $err_info[$this->randomIndex($err_info)];
        }
        return $msg;
    }


}


 ?>
