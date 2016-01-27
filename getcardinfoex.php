<?php
$srcxml = simplexml_load_string($HTTP_RAW_POST_DATA);
$card = $srcxml->QRY['Card'];
$restaurant = $srcxml->QRY['Restaurant'];

$funcname = 'GetCardInfoEx';

$xml = simplexml_load_file('in.xml');
$findcard = false;

foreach ($xml->children() as $child) {

    if (($child->getName() == $funcname) and ($child["CardCode"] == (string)$card)) {
        $findcard = true;
        break;
    }

}

if ($findcard == false)

    foreach ($xml->children() as $child) {

        if (($child->getName() == $funcname) and ($child["CardCode"] == $card)) {
            $findcard = true;
            break;
        }

    }

if ($findcard == true) {

    $Deleted = $child["Deleted"];
    $Seize = $child["Seize"];
    $StopDate = $child["StopDate"];
    $Holy = $child["Holy"];
    $Manager = $child["Manager"];
    $Locked = $child["Locked"];
    $WhyLock = $child["WhyLock"];
    $Holder = $child["Holder"];
    $PersonID = $child["PersonID"];
    $Account = $child["Account"];
    $Unpay = $child["Unpay"];
    $Bonus = $child["Bonus"];
    $Discount = $child["Discount"];
    $DiscLimit = $child["DiscLimit"];
    $Summa = $child["Summa"];
    $Sums[2] = $child["Sum2"];
    $Sums[3] = $child["Sum3"];
    $Sums[4] = $child["Sum4"];
    $Sums[5] = $child["Sum5"];
    $Sums[6] = $child["Sum6"];
    $Sums[7] = $child["Sum7"];
    $Sums[8] = $child["Sum8"];
    $DopInfo = $child["DopInfo"];
    $ScrMessage = $child["ScrMessage"];
    $PrnMessage = $child["PrnMessage"];

}

$newxml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8" ?><Root></Root>');
$newxml->addchild($funcname);

if ($findcard == true) {

    if (isset($Deleted)) $newxml->$funcname->addattribute('Deleted', $Deleted);
    if (isset($Seize)) $newxml->$funcname->addattribute('Seize', $Seize);
    if (isset($StopDate)) $newxml->$funcname->addattribute('StopDate', $StopDate);
    if (isset($Holy)) $newxml->$funcname->addattribute('Holy', $Holy);
    if (isset($Manager)) $newxml->$funcname->addattribute('Manager', $Manager);
    if (isset($Locked)) $newxml->$funcname->addattribute('Locked', $Locked);
    if (isset($WhyLock)) $newxml->$funcname->addattribute('WhyLock', $WhyLock);
    if (isset($Holder)) $newxml->$funcname->addattribute('Holder', $Holder);
    if (isset($PersonID)) $newxml->$funcname->addattribute('PersonID', $PersonID);
    if (isset($Account)) $newxml->$funcname->addattribute('Account', $Account);
    if (isset($Unpay)) $newxml->$funcname->addattribute('Unpay', $Unpay);
    if (isset($Bonus)) $newxml->$funcname->addattribute('Bonus', $Bonus);
    if (isset($Discount)) $newxml->$funcname->addattribute('Discount', $Discount);
    if (isset($DiscLimit)) $newxml->$funcname->addattribute('DiscLimit', $DiscLimit);
    if (isset($Summa)) $newxml->$funcname->addattribute('Summa', $Summa);
    if (isset($Sums[2])) $newxml->$funcname->addattribute('Sum2', $Sums[2]);
    if (isset($Sums[3])) $newxml->$funcname->addattribute('Sum3', $Sums[3]);
    if (isset($Sums[4])) $newxml->$funcname->addattribute('Sum4', $Sums[4]);
    if (isset($Sums[5])) $newxml->$funcname->addattribute('Sum5', $Sums[5]);
    if (isset($Sums[6])) $newxml->$funcname->addattribute('Sum6', $Sums[6]);
    if (isset($Sums[7])) $newxml->$funcname->addattribute('Sum7', $Sums[7]);
    if (isset($Sums[8])) $newxml->$funcname->addattribute('Sum8', $Sums[8]);
    if (isset($DopInfo)) $newxml->$funcname->addattribute('DopInfo', $DopInfo);
    if (isset($ScrMessage)) $newxml->$funcname->addattribute('ScrMessage', $ScrMessage);
    if (isset($PrnMessage)) $newxml->$funcname->addattribute('PrnMessage', $PrnMessage);
    //карта найдена
    $newxml->$funcname->addattribute('Result', '0');
} else {
    //карта не найдена
    $newxml->$funcname->addattribute('Result', '1');
}

//$GUID=com_create_guid();
header('Content-Type: text/xml');

echo $newxml->asXML();
if (is_dir($funcname) == false) {
    mkdir($funcname);
}
$newxml->asXML($funcname . "/" . $card . ".xml");


?>