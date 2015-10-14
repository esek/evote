<?php

class ECrypt
{
    public function gen_new_key() {
        $key = openssl_pkey_new();
        openssl_pkey_export($key, $privkey);
        $details = openssl_pkey_get_details($key);
        return $details;
    }
}

?>
