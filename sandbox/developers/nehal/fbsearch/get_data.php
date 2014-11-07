<?php
header('Content-Type: application/json');
ini_set('memory_limit', '256M');
ini_set('max_execution_time', 600000); //increase max_execution_time to 10 min if data set is very large

require_once 'class_loader.php';
$fbs = new FbSearch();

if(isset($_POST['action']) && $_POST['action'] == 'zip'){
    $source = './tmp/data';
    $destination = 'data'.time().'.zip';

    $fbs->Zip($source, './tmp/'.$destination);

    echo json_encode(array('file' => $destination));exit;

} else {

    if(isset($_POST['index']) && $_POST['index'] == 0){
        $fbs->initialize();
    }
    if(isset($_POST['keyword']) && isset($_POST['synonym'])):
        $keyword = $_POST['keyword'];
        $synonym = $_POST['synonym'];

        $result = $fbs->createBatchFile($keyword, $synonym);

        echo json_encode($result);
        exit;
    endif;

    echo json_encode(array());
    exit;
}

?>