<?php

function update_company($data){
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $link = mysqli_connect('127.0.0.1', 'root', 'admin', 'integration');

    $sIdCompany = $data['id'];
    $sTitle = $data['name'];
    $sEmail = $data['email'];
    $sEmailOther = $data['other_email'];

    $sPhoneGeneral = $data['general_phone'];
    $sPhoneMobile = $data['mobile_phone'];
    $sPhoneWork = $data['work_phone'];
    $sPhoneOther = $data['other_phone'];


    $sDescription = $data['description'];
    $sWeb = $data['website'];
    $arWeb = (!empty($sWeb)) ? array(array('VALUE' => $sWeb, 'VALUE_TYPE' => 'OTHER')) : array();
    $arPhone = array( array('VALUE' => $sPhoneMobile, 'VALUE_TYPE' => 'MOBILE'),  array('VALUE' => $sPhoneGeneral, 'VALUE_TYPE' => 'WORK'), array('VALUE' => $sPhoneWork, 'VALUE_TYPE' => 'WORK'), array('VALUE' => $sPhoneOther, 'VALUE_TYPE' => 'OTHER'));
    $arEmail = array(array('VALUE' => $sEmail, 'VALUE_TYPE' => 'WORK'), array('VALUE' => $sEmailOther, 'VALUE_TYPE' => 'OTHER'));

    $sINN = $data['inn'];
    $sFullName = $data['full_name'];
    $sShortName = $data['short_name'];
    $sOgrn = $data['ogrn'];
    $sKpp = $data['kpp'];
    $sOkved = $data['okved'];
    $sDirector = $data['director'];
    $sAccountant = $data['accountant'];


    $sCountry = $data['country'];
    $sRegion = $data['region'];
    $sCity = $data['city'];
    $sAddress = $data['address'];
    $sZipCode = $data['zip_code'];
    $sActualCountry = $data['actual_country'];
    $sActualRegion = $data['actual_region'];
    $sActualCity = $data['actual_city'];
    $sActualZipCode = $data['actual_zip_code'];
    $sActualStreet = $data['actual_street'];
    $sActualHouse = $data['actual_house'];
    $sActualBuild = $data['actual_build'];
    $sActualOffice = $data['actual_office'];
    $sMailingCountry = $data['mailing_country'];
    $sMailingRegion = $data['mailing_region'];
    $sMailingCity = $data['mailing_city'];
    $sMailingZipCode = $data['mailing_zip_code'];
    $sMailingStreet = $data['mailing_street'];
    $sMailingHouse = $data['mailing_house'];
    $sMailingBuild = $data['mailing_build'];
    $sMailingOffice = $data['mailing_office'];
    $rJuristicCountry = $data['juristic_country'];
    $rJuristicRegion = $data['juristic_region'];
    $rJuristicCity = $data['juristic_city'];
    $rJuristicZipCode = $data['juristic_zip_code'];
    $rJuristicStreet = $data['juristic_street'];
    $rJuristicHouse = $data['juristic_house'];
    $rJuristicBuild = $data['juristic_build'];
    $rJuristicOffice = $data['juristic_office'];

    $rLawfulnessBase = $data['lawfulness_base'];
    $rManagerName = $data['manager_name'];
    $rMangerPosition = $data ['manager_position'];
    $idType = 6;
    $fieldName = "Организация";

}












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
        update_deal($data['data']);
        break;
    case 'Contact' :
        error_log("case contact");
        update_contact($data['data']);
        break;
    case 'Diary' :
        error_log("case task");
        update_task($data['data']);
        break;
    case 'Company' :
        error_log("case");
        update_company($data['data']);
        break;
    default:
        error_log("No data");
}