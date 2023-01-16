<?php

if (!isset($_POST['uploadType'])) {
    http_response_code(400);
    echo json_encode(array('message' => 'Upload Type Not Passed', 'status' => 400));
    die();
};

if (!isset($_POST['uploadName'])) {
    http_response_code(400);
    echo json_encode(array('message' => 'Upload Name Not Passed', 'status' => 400));
    die();
};

if (!file_exists($_POST['uploadType'])) mkdir($_POST['uploadType']);

if (move_uploaded_file($_FILES['uploadFile']['tmp_name'], $_POST['uploadType'] . '/' . $_POST['uploadName'] . '.' . $_POST['uploadExt'])) {
    http_response_code(200);
    echo json_encode(array(
        'status' => 200,
        'message' => 'Uploaded Successful',
        'uploadUrl' => $_POST['uploadType'] . '/' . $_POST['uploadName'] . '.' . $_POST['uploadExt']
    ));
    die();
}


http_response_code(500);
echo json_encode(array('status' => 500, 'message' => 'Server Error'));
die();
