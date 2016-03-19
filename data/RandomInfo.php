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
            "Niiiicee!!",
            "Najs!",
            "Naaajs!",
            "M-M-M-MONSTER VOTE!!!",
            "Soft!",
            "Du får en 5:a i användning av E-vote!",
            "Wupp!",
            "WAPP!",
            "Wopp!",
            ":)",
            "Du är underbart duktig!",
            "D-D-D-DROP THE BASE!!!",
            "WubWubWub",
            "Double rainbow!",
            "GÖTTANS!!",
            "Sweet!!"
        );
        $err_info = array(
            "Något gick fel.",
            "Ajdå!",
            "Attans!",
            "Whoops!",
            "Naj!",
            "Ojdå!",
            "Hoppsan!",
            "Rackarns!",
            "Järnspikar!",
            "Sablarns!",
            "Attans järnspikar!",
            "Whuuupps!"
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
