<?php
define("site_root",'http://beyondwild.in/',true);
//define('rootfolder',$_SERVER['DOCUMENT_ROOT'].'/demo/gowild',true);
//define('site_root','../beyond_wildlife/',true);
define('rootfolder',$_SERVER['DOCUMENT_ROOT'].'/beyond_wildlife/',true);
define('admin',rootfolder.'/admin',true);
define("mainsite",site_root, true);
include_once('conn.php');
include_once('function.php');
include_once(rootfolder.'admin/component/photogallary/component_defination.php');
//include_once('tinymce.php');
?>