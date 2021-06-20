<?php
require '../localization/getLocalizedText.php';
class RandomInfo {

    private function randomIndex($arr){
        return random_int(0, count($arr) - 1);
    }

    /**
     * Generate text for the popup-boxes.
     * 
     * @param str $type "success" or "error"
     * @return str $randomTip Random tip in target language
     */ 
    public function generateTip($type){
        /**
         * Running getLocalizedText for all items in array would call
         * getLocalizedText() n times more than just running it with the selected
         * randomized output
         */
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
            $msg = getLocalizedText($suc_info[$this->randomIndex($suc_info)]);
        }else if($type == "error"){
            $msg = getLocalizedText($err_info[$this->randomIndex($err_info)]);
        }
        return $msg;
    }


}


 ?>
