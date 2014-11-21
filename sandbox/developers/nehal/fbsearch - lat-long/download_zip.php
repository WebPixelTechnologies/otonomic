<?php
$path = dirname(__FILE__)."\\tmp\\";
$fullPath = $path.$_GET['zip_file'];

if(isset($_REQUEST['zip_file'])){
    $fsize = filesize($fullPath);
    $path_parts = pathinfo($fullPath);

    //$zip_file = '.\\tmp\\'. $_REQUEST['zip_file'];
    //echo $zip_file;exit;
    $path_parts = pathinfo($fullPath);
    header('Content-type: application/zip');
    header('Content-Disposition: attachment; filename="'.$path_parts["basename"].'"');
    header('Content-Length: ' . $fsize);
    header("Cache-control: private"); //use this to open files directly
    readfile($fullPath);
    //unlink($zip_file);
}
?>