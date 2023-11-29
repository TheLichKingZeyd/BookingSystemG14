<?php

class Encrypter{

    public $encryptionKey = "Something"; // string used as encryption key

    /*
        Encrypts a received string using an XOR algorithm
        by looping through each character in the string to be encrypted: "toEncrypt"
        and the encryption key. If at any point the end of the encryption key is reached
        go back to the beginning of the encryption key and continue
        each encrypted character is then converted to an 8 bit binary value
        then converts this value to a 2 digit hexadecimal value
        which is then added to a n output string
        once all characters are encrypted, return output string
        encrypted string will show as a series of 2 digit hexadecimal values in order
    */
    public function encryptStringXOR(string $toEncrypt){
        global $encryptionKey;
        $encryptedString = "";
        $j = 0;
        for ($i = 0; $i < strlen($toEncrypt); $i++){
            if ($j > strlen($encryptionKey) -1){
                $j = 0;
            }
            $encryptedCharacter = $toEncrypt[$i] ^ $encryptionKey[$j];
            $charInBinary = str_pad(decbin(ord($encryptedCharacter)), 8, "0", STR_PAD_LEFT);

            $binaryInHex = dechex(bindec($charInBinary));
            $binaryInHex = str_pad($binaryInHex, 2, "0", STR_PAD_LEFT);
            $encryptedString .= strtoupper($binaryInHex);
            $j++;
        }
        return $encryptedString;
    }

    /*
        Decrypts a received string using an XOR algorithm
        the string is first split into chunks and sorted into an array
        the resulting array is looped through, and each value in the array
        is converted from hexadecimal into decimal, which is then converted into
        a character. this character is then decrypted with the encryption key
        and added to the output string
        once all values in the array has been decrypted and added to output string
        return output string
    */
    public function decryptStringXOR(string $toDecrypt){
        global $encryptionKey;
        $toDecryptArray = explode(" ", trim(chunk_split($toDecrypt, 2, " ")));
        $decryptedString = "";
        $j = 0;
        for ($i = 0; $i < sizeof($toDecryptArray); $i++){
            if ($j > strlen($encryptionKey) - 1){
                $j = 0;
            }
            $decryptedChar = chr(hexdec($toDecryptArray[$i])) ^ $encryptionKey[$j];
            $decryptedString .= $decryptedChar;
            $j++;
        }
        return $decryptedString;
    }
}

    
?>