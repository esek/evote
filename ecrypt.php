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
        return $key;
    }

    public function generate_otp($number) {
        /* 
            Generates an array of one-time passwords (OTPs). 
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

    public function decrypt_results($enc_results, $passphrase) {
        /*
            Decrypts the enc_results, an array with all votes, by first unlocking
            the private key with the passphrase key
        */

        $privkey = openssl_get_privatekey(file_get_contents('keys/privkey.pem'), 
                $passphrase);
        $dec_results = array();
        
        foreach ($enc_results as $enc) {
            openssl_private_decrypt($enc, $dec, $privkey);
            $dec_results[] = $dec;
        }
        
        // destroy trace of key, else "all your base are belong to us"
        openssl_free_key($privkey);

        return $dec_results;
    }



}

?>
