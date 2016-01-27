<?php
$transxml = $HTTP_RAW_POST_DATA;


$rand = rand(0, 1);
if ($rand == 0) $err = false; else $err = true;


$xml = simplexml_load_string($transxml);

if ($xml) {

    $err = false;

} else $err = true;

//Если xml распарсили - скажем что провели транзакции, иначе ошибка


$funcname = 'TransactionsEx';


$newxml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8" ?><Root></Root>');
$newxml->addchild($funcname);
if ($err == false) {
    $newxml->$funcname->addattribute('Result', '0');

} else {
    $newxml->$funcname->addattribute('Result', '1');
}

$GUID = time();
header('Content-Type: text/xml');

//echo $newxml->asXML();
if (is_dir($funcname) == false) {
    mkdir($funcname);
}
$newxml->asXML($funcname . "/" . $GUID . ".xml");
echo $newxml->asXML();


?>