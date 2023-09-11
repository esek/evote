<?php

class ECrypt
{

    /* alphabet to be used when generating OTPs */
    // (tagit bort l,1,I,0,O,o från ursprunglig)
    private $alpha = "abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789";

    /**
        Generates an array of one-time passwords (OTPs).
        6 chars should be sufficient with 62**6 (56e9) possible values.
        Should only be generated once every annual election!

        @param  (number)    The number of OTPs to generate
        @return             A list of OTPs
    */
    public function generate_otp($number) {

        $otp_array = array();
        $count = 0;
        while($count < $number) {
            $pass = $this->generateRandomString(5, $this->alpha);

            // don't want collisions
            if (in_array($pass, $otp_array)) continue;

            // add element to array, efficient way
            $otp_array[] = $pass;
            $count++;
        }

        return $otp_array;
    }

    function generateRandomString($nbrOfLetters, $availableLetters){
        $charactersLength = strlen($availableLetters);
        $randomString = '';
        for ($i = 0; $i < $nbrOfLetters; $i++) {
            $randomString .= $availableLetters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}

?>
