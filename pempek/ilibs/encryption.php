<?php
/**
 * @file encryption.php
 * 
 */
 
//not direct access
defined('_iEXEC') or die();

class Encryption
{
    static $cypher = 'blowfish';
    static $mode   = 'cfb';
    static $key    = '1a2s3d4f5g6h';

    public function enc($plaintext)
    {
        $td = mcrypt_module_open(self::$cypher, '', self::$mode, '');
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        mcrypt_generic_init($td, self::$key, $iv);
        $crypttext = mcrypt_generic($td, $plaintext);
        mcrypt_generic_deinit($td);
        return $iv.$crypttext;
    }

    public function dec($crypttext)
    {
        $plaintext = "";
        $td        = mcrypt_module_open(self::$cypher, '', self::$mode, '');
        $ivsize    = mcrypt_enc_get_iv_size($td);
        $iv        = substr($crypttext, 0, $ivsize);
        $crypttext = substr($crypttext, $ivsize);
        if ($iv)
        {
            mcrypt_generic_init($td, self::$key, $iv);
            $plaintext = mdecrypt_generic($td, $crypttext);
        }
        return $plaintext;
    }
}

global $enkripsi;
$enkripsi = new Encryption;

/*
// Encrypt text
$encrypted_text = Encryption::enc('this text is unencrypted');

// Decrypt text
$decrypted_text = Encryption::dec($encrypted_text);
*/
?>