<?php
$json = file_get_contents('php://input');
// Converts it into a PHP object
$data = json_decode($json, JSON_UNESCAPED_UNICODE);

switch (json_last_error()) {
    case JSON_ERROR_NONE:
        error_log("No error");
        break;
    case JSON_ERROR_DEPTH:
        error_log( "Maximum stack depth achieved");
        break;
    case JSON_ERROR_STATE_MISMATCH:
        error_log("Incorrect discharges or mode mismatches");
        break;
    case JSON_ERROR_CTRL_CHAR:
        error_log( "Invalid control character");
        break;
    case JSON_ERROR_SYNTAX:
        error_log( "Syntax error, invalid JSON");
        break;
    case JSON_ERROR_UTF8:
        error_log( "Invalid UTF-8 characters, possibly incorrectly encoded");
        break;
    default:
        error_log( "Unknown error");
        break;
}
switch ($data['type']) {

    case 'Deal' :
        error_log("case Deal");
        create_deal($data['data']);
        //process_deal($data['data']);
        break;
    case 'Contact' :
        error_log("case contact");
        create_contact($data['data']);
        break;
    case 'Diary' :
        error_log("case task");
        create_task($data['data']);
        break;
    case 'Company' :
        error_log("case");
        create_company($data['data']);
        // process_company($data['data']);
        break;
    default:
        //error_log($data['data']);
        error_log("No data");
    //show_error();
}