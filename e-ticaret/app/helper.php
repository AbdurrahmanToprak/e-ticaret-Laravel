<?php

if(!function_exists('generateOTP')){
    function generateOTP($n){
        $generator = "1357902468";
        $result = '';
        for ($i = 0 ; $i <= $n ; $i++){
        $result .= substr($generator,(rand()%(strlen($generator))),1);
        }
        return $result;
    }
}
if(!function_exists('dosyayiSil')){
    function dosyayiSil($string){
        if(file_exists($string)){
            if(!empty($string)){
                unlink($string);
            }
        }
    }
}

if(!function_exists('sifrele')){
    function sifrele($string){
        return encrypt($string);
    }
}
if(!function_exists('sifrelecoz')){
    function sifrelecoz($string){
        return decrypt($string);
    }
}

