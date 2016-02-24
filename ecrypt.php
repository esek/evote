<?php

require_once __DIR__ . '/RandomLib/vendor/autoload.php';

class ECrypt
{

    /* alphabet to be used when generating OTPs */
    // (tagit bort l,1,I,0,O,o från ursprunglig)
    private $alpha = "abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789";


    public function __construct() {
        $factory = new RandomLib\Factory;
        // the low-strength generator is fast and sufficient for OTPs, see docs
        $this->generator = $factory->getLowStrengthGenerator();
    }

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
            $pass = $this->generator->generateString(5, $this->alpha);

            // don't want collisions
            if (in_array($pass, $otp_array)) continue;

            // add element to array, efficient way
            $otp_array[] = $pass;
            $count++;
        }

        return $otp_array;
    }

}

?>
