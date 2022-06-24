<?php
require_once (__DIR__.'/crest.php');

function delete_company($data)
{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $link = mysqli_connect('127.0.0.1', 'root', 'admin', 'integration');
    $sIdCompanys = $data['id'];

    $queryCompany = "SELECT id_company_bitrix FROM companys_id WHERE id_company_crm=?";
    $stmt = mysqli_prepare($link, $queryCompany);
    mysqli_stmt_bind_param($stmt, "i", $sIdCompanys);
    mysqli_stmt_execute($stmt);
    $resultSelect = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_array($resultSelect, MYSQLI_NUM)) {
        foreach ($row as $idBitrix) {
            if (!empty($idBitrix)) {
                error_log("{$idBitrix}");
                if (empty($result = CRest::call(
                    'crm.company.delete',
                    ['id' => $idBitrix]
                ))) {
                    error_log("Error Delete");
                }
                    $stmt = mysqli_prepare($link, "DELETE FROM companys_id WHERE id_company_crm=?, id_company_bitrix=? ");
                    mysqli_stmt_bind_param($stmt, "ii", $sIdCompany,$sidBitrix);
                    mysqli_stmt_execute($stmt);

            }
        }
    }
}

function delete_contact($data){
    $link = mysqli_connect('127.0.0.1', 'root', 'admin', 'integration');
    $cIdContact = $data['id'];

    $queryContact = "SELECT id_contact_bitrix FROM contact_id WHERE id_contact_crm=?";
    $stmt = mysqli_prepare($link, $queryContact);
    mysqli_stmt_bind_param($stmt, "i", $cIdContact);
    mysqli_stmt_execute($stmt);
    $resultSelect = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_array($resultSelect, MYSQLI_NUM)) {
        foreach ($row as $idBitrix) {
            if (empty($result = CRest::call(
                'crm.contact.delete',
                ['id' => $idBitrix]
            ))) {
                error_log("Error Delete");
            }
            if (!empty($result)) {
                $stmt = mysqli_prepare($link, "DELETE FROM  contact_id WHERE id_contact_crm=?, id_contact_bitrix=?");
                mysqli_stmt_bind_param($stmt, "ii", $cIdContact, $sidBitrix);
                mysqli_stmt_execute($stmt);
            }
        }
    }
}

function delete_deal($data)
{
    $link = mysqli_connect('127.0.0.1', 'root', 'admin', 'integration');
    $dIdDeal = $data['id'];
    $queryContact = "SELECT id_deal_bitrix FROM deal_id WHERE id_deal_crm=?";
    $stmt = mysqli_prepare($link, $queryContact);
    mysqli_stmt_bind_param($stmt, "i", $dIdDeal);
    mysqli_stmt_execute($stmt);
    $resultSelect = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_array($resultSelect, MYSQLI_NUM)) {
        foreach ($row as $idBitrix) {
            if (empty($result = CRest::call(
                'crm.contact.delete',
                ['id' => $idBitrix]
            ))) {
                error_log("Error Delete");
            }
            if (!empty($result)) {
                $stmt = mysqli_prepare($link, "DELETE FROM  deal_id WHERE id_deal_crm=?, id_deal_bitrix=?");
                mysqli_stmt_bind_param($stmt, "ii", $dIdDeal, $sidBitrix);
                mysqli_stmt_execute($stmt);
            }
        }
    }
}

function delete_task($data){
    $link = mysqli_connect('127.0.0.1', 'root', 'admin', 'integration');
    $dIdTask = $data['id'];
    $idBitrixTask = 70;
    $queryContact = "SELECT id_task_bitrix FROM task_id WHERE id_task_crm=?";
    $stmt = mysqli_prepare($link, $queryContact);
    mysqli_stmt_bind_param($stmt, "i", $dIdTask);
    mysqli_stmt_execute($stmt);
    $resultSelect = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_array($resultSelect, MYSQLI_NUM)) {
        foreach ($row as $idBitrix) {
            if (empty($result = CRest::call(
                'asks.task.delete',
                ['id' => $idBitrixTask]
            ))) {
                error_log("Error Delete");
            }
            if (!empty($result)) {
                $stmt = mysqli_prepare($link, "DELETE FROM  task_id WHERE id_task_crm=?, id_task_bitrix=?");
                mysqli_stmt_bind_param($stmt, "ii", $dIdTask, $sidBitrix);
                mysqli_stmt_execute($stmt);
            }
        }
    }
}

$json = file_get_contents('php://input');
// Converts it into a PHP object
$data = json_decode($json, JSON_UNESCAPED_UNICODE);

switch (json_last_error()) {
    case JSON_ERROR_NONE:
        error_log("No error");
        break;
    case JSON_ERROR_DEPTH:
        error_log("Maximum stack depth achieved");
        break;
    case JSON_ERROR_STATE_MISMATCH:
        error_log("Incorrect discharges or mode mismatches");
        break;
    case JSON_ERROR_CTRL_CHAR:
        error_log("Invalid control character");
        break;
    case JSON_ERROR_SYNTAX:
        error_log("Syntax error, invalid JSON");
        break;
    case JSON_ERROR_UTF8:
        error_log("Invalid UTF-8 characters, possibly incorrectly encoded");
        break;
    default:
        error_log("Unknown error");
        break;
}
switch ($data['type']) {

    case 'Deal' :
        error_log("case Deal");
        delete_deal($data['data']);
        break;
    case 'Contact' :
        error_log("case contact");
        delete_contact($data['data']);
        break;
    case 'Diary' :
        error_log("case task");
        delete_task($data['data']);
        break;
    case 'Company' :
        error_log("case");
        delete_company($data['data']);
        break;
    default:
        error_log("No data");
}