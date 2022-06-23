<?php
require_once (__DIR__.'/crest.php');
function update_company($data)
{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $link = mysqli_connect('127.0.0.1', 'root', 'admin', 'integration');
    $querySynergy = "SELECT id_company_crm FROM companys_id";
    $resultId = mysqli_query($link, $querySynergy);
    $company_synergy = mysqli_fetch_array($resultId, MYSQLI_NUM);


    //$sIdCompany = $data['id'];
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
    $arPhone = array(array('VALUE' => $sPhoneMobile, 'VALUE_TYPE' => 'MOBILE'), array('VALUE' => $sPhoneGeneral, 'VALUE_TYPE' => 'WORK'), array('VALUE' => $sPhoneWork, 'VALUE_TYPE' => 'WORK'), array('VALUE' => $sPhoneOther, 'VALUE_TYPE' => 'OTHER'));
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
    $sIdCompanys = $data['id'];

    if (!empty($sDescription)) {
        $sCom = "Описание: {$sDescription}";
    }
    if (!empty($sActualCountry)) {
        $sCom = "{$sCom} Факт. страна: {$sActualCountry};";
    }
    if (!empty($sActualRegion)) {
        $sCom = "{$sCom} Факт. регион: {$sActualRegion};";
    }
    if (!empty($sActualCity)) {
        $sCom = "{$sCom} Факт. город: {$sActualCity};";
    }
    if (!empty($sActualStreet)) {
        $sCom = "{$sCom} Факт. улица: {$sActualStreet};";
    }
    if (!empty($sActualHouse)) {
        $sCom = "{$sCom} Факт. дом: {$sActualHouse};";
    }
    if (!empty($sActualBuild)) {
        $sCom = "{$sCom} Факт. строение: {$sActualBuild};";
    }
    if (!empty($sActualOffice)) {
        $sCom = "{$sCom} Факт. офис: {$sActualOffice};";
    }
    if (!empty($sActualZipCode)) {
        $sCom = "{$sCom} Факт. индекс: {$sActualZipCode};";
    }
    if (!empty($sMailingCountry)) {
        $sCom = "{$sCom} Почт. страна : {$sMailingCountry};";
    }
    if (!empty($sMailingRegion)) {
        $sCom = "{$sCom} Почт. регион: {$sMailingRegion};";
    }
    if (!empty($sMailingCity)) {
        $sCom = "{$sCom} Почт. город: {$sMailingCity};";
    }
    if (!empty($sMailingStreet)) {
        $sCom = "{$sCom} Почт. улица: {$sMailingStreet};";
    }
    if (!empty($sMailingHouse)) {
        $sCom = "{$sCom} Почт. дом: {$sMailingHouse};";
    }
    if (!empty($sMailingBuild)) {
        $sCom = "{$sCom} Почт. корпус: {$sMailingBuild};";
    }
    if (!empty($sMailingOffice)) {
        $sCom = "{$sCom} Почт. офис: {$sMailingOffice};";
    }
    if (!empty($sMailingZipCode)) {
        $sCom = "{$sCom} Почт. индекс: {$sMailingZipCode};";
    }
    $queryCompany = "SELECT id_company_bitrix FROM companys_id WHERE id_company_crm=?";
    $stmt = mysqli_prepare($link, $queryCompany);
    mysqli_stmt_bind_param($stmt, "i", $sIdCompanys);
   // foreach ($company_synergy as $sIdCompanys) {
        mysqli_stmt_execute($stmt);
        $resultSelect = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_array($resultSelect, MYSQLI_NUM)) {
            foreach ($row as $idBitrix) {
                if (!empty($idBitrix)) {
                    error_log("{$idBitrix}");
                    if (empty($result = CRest::call(
                        'crm.company.update',
                        ['id' => $idBitrix,
                            'fields' =>
                                [
                                    'TITLE' => $sTitle,//name
                                    'COMMENTS' => $sCom,             //description
                                    'PHONE' => $arPhone,//general-phone
                                    'EMAIL' => $arEmail,
                                    'WEB' => $arWeb,
                                    'ADDRESS' => $sAddress,
                                    'ADDRESS_CITY' => $sCity,
                                    'ADDRESS_POSTAL_CODE' => $sZipCode,
                                    'ADDRESS_REGION' => $sRegion,
                                    'ADDRESS_COUNTRY' => $sCountry,

                                ]
                        ]))) {
                        error_log("Not updated");
                    }
                    if (!empty($rLawfulnessBase)) {
                        $rCom = "Правомочность: {$rLawfulnessBase};";
                    }
                    if (empty($rMangerPosition)) {
                        $rCom = "{$rCom} Должность руководителя: {$rMangerPosition}";
                    }
                    if (!empty($resultRequisitePreset['result'])) {
                        $presetId = $resultRequisitePreset['result'];

                        if (!empty($resultRequisite = CRest::call(
                            'crm.requisite.update',
                            [   'id' => $idBitrix,
                                'fields' => [
                                    'ENTITY_TYPE_ID' => 4,//4 - is company in CRest::call('crm.enum.ownertype');
                                    'ENTITY_ID' => $idBitrix,//company id
                                    'PRESET_ID' => $presetId,

                                    'RQ_NAME' => $rManagerName,
                                    'RQ_INN' => $sINN,
                                    'RQ_COMPANY_FULL_NAME' => $sFullName,
                                    'RQ_COMPANY_NAME' => $sShortName,
                                    'RQ_OGRN' => $sOgrn,
                                    'RQ_KPP' => $sKpp,
                                    'RQ_OKVED' => $sOkved,
                                    'RQ_DIRECTOR' => $sDirector,
                                    'RQ_ACCOUNTANT' => $sAccountant,
                                    'COMMENTS' => $rCom
                                ]
                            ]))) ;

                    }
                    if (!empty($rJuristicStreet)) {
                        $rAdress1 = "{$rJuristicStreet}";
                    }
                    if (!empty($rJuristicHouse)) {
                        $rAdress1 = "{$rAdress1} {$rJuristicHouse}";
                    }
                    if (!empty($rJuristicBuild)) {
                        $rAdress1 = "{$rAdress1} {$rJuristicBuild}";
                    }
                    if (!empty($resultRequisite['result'])) {

                        $resultAddress = CRest::call(
                            'crm.address.update',
                            [
                                'fields' => [
                                    'TYPE_ID' => $idType,
                                    'ENTITY_ID' => $idBitrix,
                                    'ADDRESS_1' => $rAdress1,
                                    'ADDRESS_2' => $rJuristicOffice,
                                    'CITY' => $rJuristicCity,
                                    'POSTAL_CODE' => $rJuristicZipCode,
                                    'PROVINCE' => $rJuristicRegion,
                                    'COUNTRY' => $rJuristicCountry
                                ]
                            ]);
                    }
                }
            }
        }
   // }
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
