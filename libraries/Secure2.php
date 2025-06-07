<?php

class Secure2
{
    /**
     * Algorithm Method
     */
    private $algorithm;

    /**
     * Secret Key
     */
    private $secret;

    /**
     * Non-NULL Initialization Vector for encryption
     */
    private $iv;

    public function __construct()
    {
        $this->algorithm = "AES-256-CBC";
        $this->secret = hex2bin("045cad07739a0b66f6bb1a5150a6730dadd82f24db57fedcbf95e08f10c3f7ab");
        $this->iv = "0123456789abcdef"; // 16 digits
    }

    /**
     * Encrypt some string 
     */
    public function encrypt($data)
    {
        $encrypt = openssl_encrypt($data, $this->algorithm, $this->secret, 0, $this->iv);

        return base64_encode($encrypt);
    }

    /**
     * Decrypt some string
     */
    public function decrypt($data)
    {
        $data = base64_decode($data);
        
        return openssl_decrypt($data, $this->algorithm, $this->secret, 0, $this->iv);
    }
}