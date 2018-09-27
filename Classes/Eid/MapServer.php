<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//var_dump($_GET);

$x = intval($_GET["x"]);
$y = intval($_GET["y"]);
$z = intval($_GET["z"]); 

$file = "typo3conf/ext/visit_tablets/Resources/Public/MapTiles/$z/$x/$y.png";
//echo(($file));
//die(file_exists($file));
if (file_exists($file)) {
    header('Access-Control-Allow-Origin: *');  
    header('Content-Type: image/jpg');
    header('Server: Kris ultra speed Map Webserver'); 
    header('Cache-Control: max-age=290304000, public'); 
//    header('Content-Disposition: attachment; filename="'.basename($file).'"');
//    header('Expires: 0');
//    header('Cache-Control: must-revalidate');
//    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}else{
    header("HTTP/1.0 404 Not Found");
    echo "not found: " . $file;
}