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
    $filename = isset($_POST['filename']) ? $_POST['filename'] : null;

    if(isset($_POST['index']) && $_POST['index'] == 0){
        $fbs->initialize();
    }

    if(isset($_POST['keyword'])):
        $data = explode(' >>> ', $_POST['keyword']);
        $keyword = explode(' ||| ', $data[0]);
        $input_data = array_merge( explode(',', $data[1]), $keyword);

        $keyword = implode(' ', $keyword);

        $result = $fbs->createBatchFile($keyword, $keyword, $filename, $input_data);

        echo json_encode($result);
        exit;
    endif;

    echo json_encode(array());
    exit;
}

?>