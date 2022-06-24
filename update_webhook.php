<?php
require_once (__DIR__.'/crest.php');
function update_company($data)
{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $link = mysqli_connect('127.0.0.1', 'root', 'admin', 'integration');
    //$querySynergy = "SELECT id_company_crm FROM companys_id";
    //$resultId = mysqli_query($link, $querySynergy);
   // $company_synergy = mysqli_fetch_array($resultId, MYSQLI_NUM);


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
}

function update_contact($data)
{
    $link = mysqli_connect('127.0.0.1', 'root', 'admin', 'integration');
    $cIdContact = $data['id'];

    $cName = $data['first_name'];
    $cLastName = $data['last_name'];
    $cMiddleName = $data['middle_name'];
    $cDescription = $data['description'];
    $cGeneralPhone = $data['general_phone'];
    $cMobilePhone = $data['mobile_phone'];
    $cWorkPhone = $data['work_phone'];
    $cOtherPhone = $data['other_phone'];
    $arPhone = array(array('VALUE' => $cMobilePhone, 'VALUE_TYPE' => 'MOBILE'), array('VALUE' => $cGeneralPhone, 'VALUE_TYPE' => 'WORK'), array('VALUE' => $cWorkPhone, 'VALUE_TYPE' => 'WORK'), array('VALUE' => $cOtherPhone, 'VALUE_TYPE' => 'OTHER'));
    $cEmail = $data['email'];
    $cOtherEmail = $data['other_email'];
    $arEmail = array(array('VALUE' => $cEmail, 'VALUE_TYPE' => 'WORK'), array('VALUE' => $cOtherEmail, 'VALUE_TYPE' => 'OTHER'));
    $cWebsite = $data['website'];
    $arWeb = (!empty($cWebsite)) ? array(array('VALUE' => $cWebsite, 'VALUE_TYPE' => 'OTHER')) : array();

    //Рабочий адрес
    $cWorkCountry = $data['work_country'];
    $cWorkRegion = $data['work_region'];
    $cWorkCity = $data['work_city'];
    $cWorkZipCode = $data['work_zipcode'];
    $cWorkStreet = $data['work_street'];
    $cWorkBuilding = $data['work_building'];
    $cWorkHousing = $data['work_housing'];
    $cWorkApartment = $data['work_apartment'];
    $arAddress = array($cWorkStreet, $cWorkBuilding, $cWorkHousing, $cWorkApartment);

    //Домашний адрес
    $cHomeCountry = $data['home_country'];
    $cHomeRegion = $data['home_region'];
    $cHomeCity = $data['home_city'];
    $cHomeZipCode = $data['home_zipcode'];
    $cHomeStreet = $data['home_street'];
    $cHomeBuilding = $data['home_building'];
    $cHomeHousing = $data['home_housing'];
    $cHomeApartment = $data['home_apartment'];

    //Соц. сети и мессенджеры
    $cVK = $data['vkontakte'];
    $cFacebook = $data['facebook'];
    $cLinkedin = $data['linkedin'];
    $cOdnoklassniki = $data['odnoklassniki'];
    $cInstagramm = $data['instagram'];
    $cTwitter = $data['twitter'];
    $cWhatsapp = $data['whatsapp'];
    $cViber = $data['viber'];
    $cTelegram = $data['telegram'];
    $cSkype = $data['skype'];
    $arIM = array(array('VALUE' => $cVK, 'VALUE_TYPE' => 'OTHER'),
        array('VALUE' => $cFacebook, 'VALUE_TYPE' => 'FACEBOOK'),
        array('VALUE' => $cLinkedin, 'VALUE_TYPE' => 'OTHER'),
        array('VALUE' => $cOdnoklassniki, 'VALUE_TYPE' => 'OTHER'),
        array('VALUE' => $cInstagramm, 'VALUE_TYPE' => 'INSTAGRAM'),
        array('VALUE' => $cTwitter, 'VALUE_TYPE' => 'OTHER'),
        array('VALUE' => $cWhatsapp, 'VALUE_TYPE' => 'OTHER'),
        array('VALUE' => $cViber, 'VALUE_TYPE' => 'VIBER'),
        array('VALUE' => $cTelegram, 'VALUE_TYPE' => 'TELEGRAM'),
        array('VALUE' => $cSkype, 'VALUE_TYPE' => 'SKYPE'));

    if (!empty($cDescription)) {
        $cCom = "Описание: {$cDescription};";
    }
    if (!empty($cHomeCountry)) {
        $cCom = "{$cCom} Дом. страна: {$cHomeCountry};";
    }
    if (!empty($cHomeRegion)) {
        $cCom = "{$cCom} Дом. регион: {$cHomeRegion};";
    }
    if (!empty($cHomeCity)) {
        $cCom = "{$cCom} Дом. город: {$cHomeCity};";
    }
    if (!empty($cHomeZipCode)) {
        $cCom = "{$cCom} Дом. индекс: {$cHomeZipCode};";
    }
    if (!empty($cHomeStreet)) {
        $cCom = "{$cCom} Дом. улица: {$cHomeStreet};";
    }
    if (!empty($cHomeBuilding)) {
        $cCom = "{$cCom} Дом. дом: {$cHomeBuilding};";
    }
    if (!empty($cHomeHousing)) {
        $cCom = "{$cCom} Дом. корпус: {$cHomeHousing};";
    }
    if (!empty($cHomeApartment)) {
        $cCom = "{$cCom} Дом. квартира: {$cHomeApartment};";
    }
    $queryContact = "SELECT id_contact_bitrix FROM contact_id WHERE id_contact_crm=?";
    $stmt = mysqli_prepare($link, $queryContact);
    mysqli_stmt_bind_param($stmt, "i", $cIdContact);
    mysqli_stmt_execute($stmt);
    $resultSelect = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_array($resultSelect, MYSQLI_NUM)) {
        foreach ($row as $idBitrix) {
            if (!empty($idBitrix)) {
                if (empty($result = CRest::call(
                    'crm.contact.update',
                    ['id' => $idBitrix,
                        'fields' =>
                            [
                                'NAME' => $cName,
                                'LAST_NAME' => $cLastName,
                                'SECOND_NAME' => $cMiddleName,
                                'PHONE' => $arPhone,
                                'EMAIL' => $arEmail,
                                'WEB' => $arWeb,
                                'ADDRESS' => $arAddress,
                                'ADDRESS_CITY' => $cWorkCity,
                                'ADDRESS_COUNTRY' => $cWorkCountry,
                                'ADDRESS_POSTAL_CODE' => $cWorkZipCode,
                                'ADDRESS_PROVINCE' => $cWorkRegion,
                                'COMMENTS' => $cCom,
                                'IM' => $arIM

                            ]
                    ]))) {
                    error_log("Not updated");
                }
            }
        }
    }
}

function update_deal($data){
    $link = mysqli_connect('127.0.0.1', 'root', 'admin', 'integration');
    $dName = $data['name'];
    $dIdDeal = $data['id'];
    $dDescription = $data['description'];
    $dAmount = $data['amount'];
    $dCost = $data['cost'];
    $dProfit = $data['profit'];
    $dNumber = $data['number'];
    $dPlannedAt = $data['planned_at'];
    $dFinishedAt = $data['finished_at'];

    if(!empty($dDescription)){
        $dCom = "Описание: {$dDescription}";
    }
    if(!empty($dCost)){
        $dCom = "{$dCom} Себестоимость сделки: {$dCost};";
    }
    if (!empty($dProfit)){
        $dCom = "{$dCom} Прибыль сделки: {$dProfit};";
    }
    if(!empty($dNumber)){
        $dCom = "{$dCom} Номер сделки: {$dNumber};";
    }
    if(!empty($dPlannedAt)){
        $dCom = "{$dCom} Планируемая дата закрытия: {$dPlannedAt};";
    }
    $queryContact = "SELECT id_deal_bitrix FROM deal_id WHERE id_deal_crm=?";
    $stmt = mysqli_prepare($link, $queryContact);
    mysqli_stmt_bind_param($stmt, "i", $dIdDeal);
    mysqli_stmt_execute($stmt);
    $resultSelect = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_array($resultSelect, MYSQLI_NUM)) {
        foreach ($row as $idBitrix) {
            if (!empty($idBitrix)) {
                if (empty($result = CRest::call(
                    'crm.deal.update',
                    ['id' => $idBitrix,
                        'fields' =>
                            [
                                'TITLE' => $dName,
                                'COMMENTS' => $dCom,
                                'OPPORTUNITY' => $dAmount,
                                'CLOSEDATE' => $dFinishedAt

                            ]
                    ]))) {
                    error_log("Not updated");
                }
            }
        }
    }
}

function update_task($data){
    $link = mysqli_connect('127.0.0.1', 'root', 'admin', 'integration');
    $tIdTask = $data['id'];
    $idBitrixTask = 70;
    $tName = $data['name'];
    $tDescription = $data['description'];
    $tEndTime = $data['end_time'];
    $tDueDate = $data['due_date'];
    $id = 1;
    $queryContact = "SELECT id_task_bitrix FROM task_id WHERE id_task_crm=?";
    $stmt = mysqli_prepare($link, $queryContact);
    mysqli_stmt_bind_param($stmt, "i", $tIdTask);
    mysqli_stmt_execute($stmt);
    $resultSelect = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_array($resultSelect, MYSQLI_NUM)) {
        foreach ($row as $idBitrix) {
            if (!empty($idBitrix)) {
                if (empty($result = CRest::call(
                    'tasks.task.update',
                    ['id' => $idBitrixTask,
                        'fields' =>
                            [
                                'TITLE' => $tName,
                                'RESPONSIBLE_ID' => $id,
                                'DESCRIPTION' => $tDescription,
                                'DEADLINE' => $tDueDate,
                                'CLOSED_DATE' => $tEndTime

                            ]
                    ]))) {
                    error_log("Not updated");
                }
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
