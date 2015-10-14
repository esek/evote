<?php

require_once __DIR__ . '/RandomLib/vendor/autoload.php';

class ECrypt
{

    /* alphabet to be used when generating OTPs */
    private $alpha = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

    public function __construct() {
        $factory = new RandomLib\Factory;
        // the low-strength generator is fast and sufficient for OTPs, see docs
        $this->generator = $factory->getLowStrengthGenerator();
    }

    public function generate_key() {
        $key = openssl_pkey_new();
        openssl_pkey_export($key, $privkey);
        $details = openssl_pkey_get_details($key);
        return $details;
    }

    public function generate_otp($number) {
        /* 
            generates an array of one-time passwords (OTPs). 
            6 chars should be sufficient with 62**6 (56e9) possible values.
         */
        
        $otp_array = array();
        $count = 0;
        while($count < $number) {
            $pass = $this->generator->generateString(6, $this->alpha);
            
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
