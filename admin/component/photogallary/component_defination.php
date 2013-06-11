<?php
$fp = fsockopen("udp://192.168.2.12", 13, $errno, $errstr);
if (!$fp) {
//	echo 'in if';
    //echo "ERROR: $errno - $errstr<br />\n";
	define("component",'http://beyondwild.in/admin/component/', true);
define("config",$_SERVER['DOCUMENT_ROOT'].'/admin/component/', true);
define("gallery",$_SERVER['DOCUMENT_ROOT'].'/admin/component/', true);
define("set_image",$_SERVER['DOCUMENT_ROOT'].'/admin/component/', true);
define("logo_path",$_SERVER['DOCUMENT_ROOT'].'/admin', true);
} else {
//  echo 'in else';
define("component",'http://beyondwild.in/admin/component/', true);
define("config",$_SERVER['DOCUMENT_ROOT'].'/admin/component/', true);
define("gallery",$_SERVER['DOCUMENT_ROOT'].'/admin/component/', true);
define("set_image",$_SERVER['DOCUMENT_ROOT'].'/admin/component/', true);
define("logo_path",$_SERVER['DOCUMENT_ROOT'].'/admin', true);
}
?>