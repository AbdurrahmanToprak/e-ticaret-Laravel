<?php

if(!function_exists('dosyayiSil')){
    function dosyayiSil($string){
        if(file_exists($string)){
            if(!empty($string)){
                unlink($string);
            }
        }
    }
}

