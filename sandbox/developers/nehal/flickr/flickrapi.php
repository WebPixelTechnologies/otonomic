<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

    header('Content-type: application/json');

    if( empty($_REQUEST['q']) || (trim($_REQUEST['q']) == "" )){
        echo json_encode(array('response' => 'error', 'message' => 'No search query provided, please try again with a search keyword.'));
        exit;
    }

    $options = array(
        'tags'      => $_REQUEST['q'],
        'licence'   => isset($_REQUEST['licence'])?$_REQUEST['licence']:'0',
        'limit'     => isset($_REQUEST['limit'])?$_REQUEST['limit']:10,
        'size'      => isset($_REQUEST['size'])?$_REQUEST['size']:'M',
        'meta'      => isset($_REQUEST['meta'])?$_REQUEST['meta']:1,
    );


    include_once 'flickr_class.php';
    $f = new Flickr();
    $result = $f->search($options['tags'], $options['licence'], $options['limit'], $options['size'], $options['meta']);

    if(!empty($result)){
        echo json_encode( array('response' => 'success', 'data' => $result)); exit;
    }

    //if no result found show error message
    echo json_encode(array('response' => 'error', 'message' => 'No result found for the search query'));
?>