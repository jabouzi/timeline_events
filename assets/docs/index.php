<?php

if (!isset($_GET['lang'])) $lang = 'fr';
else $lang = $_GET['lang'];

header('location: /'.$lang.'/campaign/file/'.$_GET['file']);
exit();

