<?php
$srcxml = $HTTP_RAW_POST_DATA;
$funcname = 'LicenseInfo';
if (is_dir($funcname) == false) {
    mkdir($funcname);
}

writefile("\n". $srcxml, $funcname);

function writefile($str, $funcname)
{
    $filename = $funcname . "/log.txt";
    $file = fopen($filename, "a+");
    if (!$file) {
        echo("Ошибка открытия файла");
    } else {


        fputs($file, $str);
    }
    fclose($file);
}


?>