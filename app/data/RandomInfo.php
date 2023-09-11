<?php
class RandomInfo {

    private function randomIndex($arr){
        return random_int(0, count($arr) - 1);
    }

    /**
     * Generate text for the popup-boxes.
     * 
     * @param str $type "success" or "error"
     * @return str Random tip in target language
     */ 
    public function generateTip($type){
        /**
         * Running getLocalizedText for all items in array would call
         * getLocalizedText() n times more than just running it with the selected
         * randomized output
         */
        $suc_info = array(
            "*Happy trumpet fanfare*",
            "You're the best!",
            "You know this!",
            "Splendid!",
            "You are unreasonably good at this!",
            "Cool!",
            "Ja!", // #revserseuno
            "What a talent!",
            "You did it!",
            "Very niice!",
            "Immense happiness!",
            "Really good!",
            "Yup!",
            "Look at them skillz!",
            "You got some MAD voting skills!",
            "Your degree of being good is high!",
            "Fantastic!",
            "Truly great!",
            "Phenomenal!",
            "Outstanding!",
            "Formidable!",
            "Brilliant!",
            "Magnificent!",
            "Excellent!",
            "Noice!",
            "Real tough!",
            // Below this not translated
            "Nice!",
            "Niiiicee!!",
            "Najs!",
            "Naaajs!",
            "M-M-M-MONSTER VOTE!!!",
            "Soft!",
            "You get an A in Usage of E-vote!",  // This one is
            "Wupp!",
            "WAPP!",
            "Wopp!",
            ":)",
            "You are so good!", // This as well
            "D-D-D-DROP THE BASE!!!",
            "WubWubWub",
            "Double rainbow!",
            "YEAH!", // Final
            "Sweet!!"
        );
        $err_info = array(
            "Something went wrong.",
            "Ouch!",
            "Oof!",
            "Whoops!",
            "Nooo!",
            "Oopsie!",
            "Gosh darn it",
            "Nails!",
            "Frick!",
            "What the frick?!",
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
