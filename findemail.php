<?php
$srcxml = simplexml_load_string($HTTP_RAW_POST_DATA);
$email = $srcxml->QRY['Email'];

$xml = simplexml_load_file('in.xml');
$findcard = false;


$funcname = 'FindEmail';

foreach ($xml->children() as $child) {
    if (($child->getName() == $funcname) and ($child["email"] == (string)$email)) {

        $findcard = true;
        break;
    }

}


if ($findcard == true) {

    $Account = $child["Account"];
    $CardCode = $child["CardCode"];
    $Name = $child["Name"];

}

$newxml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8" ?><Root></Root>');
$newxml->addchild($funcname);
if ($findcard == true) {
    if (isset($Account)) $newxml->$funcname->addattribute('Account', $Account);
    if (isset($CardCode)) $newxml->$funcname->addattribute('CardCode', $CardCode);
    if (isset($Name)) $newxml->$funcname->addattribute('Name', $Name);
    $newxml->$funcname->addattribute('Result', '0');

} else {
    $newxml->$funcname->addattribute('ErrorText', 'Email not found');
    $newxml->$funcname->addattribute('Result', '1');
}

//$GUID=com_create_guid();
//header('Content-Type: text/xml');

echo $newxml->asXML();
if (is_dir($funcname) == false) {
    mkdir($funcname);
}
$newxml->asXML($funcname . "/" . $email . ".xml");

?>
