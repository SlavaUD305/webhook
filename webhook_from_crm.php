<?php


require_once (__DIR__.'/crest.php');
require_once (__DIR__.'/connect.php');
//require_once(__DIR__,'/Company.php');
//require_once(__DIR__,'/Contact.php');
//require_once(__DIR__,'/Deal.php');
//require_once(__DIR__,'/Task.php');



function create_company($data)
{
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

    if(!empty($sDescription)){
        $sCom = "Описание: {$sDescription}";
    }
    if(!empty($sActualCountry)){
        $sCom = "{$sCom} Факт. страна: {$sActualCountry};";
    }
    if(!empty($sActualRegion)){
        $sCom = "{$sCom} Факт. регион: {$sActualRegion};";
    }
    if(!empty($sActualCity)){
        $sCom = "{$sCom} Факт. город: {$sActualCity};";
    }
    if(!empty($sActualStreet)){
        $sCom = "{$sCom} Факт. улица: {$sActualStreet};";
    }
    if(!empty($sActualHouse)){
        $sCom = "{$sCom} Факт. дом: {$sActualHouse};";
    }
    if(!empty($sActualBuild)){
        $sCom = "{$sCom} Факт. строение: {$sActualBuild};";
    }
    if(!empty($sActualOffice)){
        $sCom = "{$sCom} Факт. офис: {$sActualOffice};";
    }
    if(!empty($sActualZipCode)){
        $sCom = "{$sCom} Факт. индекс: {$sActualZipCode};";
    }
    if(!empty($sMailingCountry)){
        $sCom = "{$sCom} Почт. страна : {$sMailingCountry};";
    }
    if(!empty($sMailingRegion)){
        $sCom = "{$sCom} Почт. регион: {$sMailingRegion};";
    }
    if(!empty($sMailingCity)){
        $sCom = "{$sCom} Почт. город: {$sMailingCity};";
    }
    if(!empty($sMailingStreet)){
        $sCom = "{$sCom} Почт. улица: {$sMailingStreet};";
    }
    if(!empty($sMailingHouse)){
        $sCom = "{$sCom} Почт. дом: {$sMailingHouse};";
    }
    if(!empty($sMailingBuild)){
        $sCom = "{$sCom} Почт. корпус: {$sMailingBuild};";
    }
    if(!empty($sMailingOffice)){
        $sCom = "{$sCom} Почт. офис: {$sMailingOffice};";
    }
    if(!empty($sMailingZipCode)){
        $sCom = "{$sCom} Почт. индекс: {$sMailingZipCode};";
    }
    if (empty ($result = CRest::call(
        'crm.company.add',
        [
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
        error_log("Company not added");
    }
    $sidBitrix = $result['result'];
    if (!empty($result['result'])) {


        if (empty($resultRequisitePreset = CRest::call(
            'crm.requisite.preset.add',
            [
                'fields' => [
                    'ENTITY_TYPE_ID' => 8,
                    'NAME' => $fieldName,

                ]
            ]))) {
            error_log("Preset is empty");
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
                'crm.requisite.add',
                [
                    'fields' => [
                        'ENTITY_TYPE_ID' => 4,//4 - is company in CRest::call('crm.enum.ownertype');
                        'ENTITY_ID' => $sidBitrix,//company id
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
                ])));

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
                'crm.address.add',
                [
                    'fields' => [
                        'TYPE_ID' => $idType,
                        'ENTITY_ID' => $sidBitrix,
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
    $stmt = mysqli_prepare($link, "INSERT INTO companys_id (id_company_crm, id_company_bitrix) VALUES (?,?)");
    mysqli_stmt_bind_param($stmt, "ii", $sIdCompany, $sidBitrix);
    mysqli_stmt_execute($stmt);
}




    //    $queryContactCompany = "SELECT id_contact_bitrix FROM contact_id WHERE id_contact_crm=?";
     //   $stmt = mysqli_prepare($link, $queryContactCompany);
      //  mysqli_stmt_bind_param($stmt, "i", $sIdContact);
       // foreach ($contact_synergy as $sIdContact) {
        //    mysqli_stmt_execute($stmt);
         //   $resultSelect = mysqli_stmt_get_result($stmt);
          //  while ($row = mysqli_fetch_array($resultSelect, MYSQLI_NUM)) {
           //     foreach ($row as $idContactBitrix) {
            //        if (!empty($idContactBitrix)) {
             //           $resultRequisite = CRest::call(
              //              'crm.company.contact.add',
               //             ['id' => $result['result'],
                //                'fields' => [
                 //                   'CONTACT_ID' => idContactBitrix
                  //              ]
                   //         ]);
                   // } else {
                    //    create_contact($data);
                   // }
               // }
           // }
       // }
       //проверяем есть ли такая сделка в бд если есть функция обновления если нет функция создания $sIdDeal
   // }

 //Deal
//в конце айди компании по синергии и битриксу добавляем в БД
        


      

function create_contact($data)
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
        $cCom = "Описание: {$cDescription}";
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
    $cIdCompany = $data['company_id'];
    $queryCompany = "SELECT id_company_bitrix FROM companys_id WHERE id_company_crm=?";
    $stmt = mysqli_prepare($link, $queryCompany);
    mysqli_stmt_bind_param($stmt, "i", $cIdCompany);
    mysqli_stmt_execute($stmt);
    $resultSelect = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_array($resultSelect, MYSQLI_NUM)) {
        foreach ($row as $idBitrix) {
            if (!empty($idBitrix)) {

                if (!empty ($result = CRest::call(
                    'crm.contact.add',
                    [
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
                                'IM' => $arIM,
                                'COMPANY_ID' => $idBitrix

                            ]
                    ]))) {
                    $sidBitrix = $result['result'];
                    $stmt = mysqli_prepare($link, "INSERT INTO contact_id (id_contact_crm, id_contact_bitrix) VALUES (?,?)");
                    mysqli_stmt_bind_param($stmt, "ii", $cIdContact, $sidBitrix);
                    mysqli_stmt_execute($stmt);
                }

        }

        }
    }
    if(empty($result['result'])) {
        if (!empty ($cResult = CRest::call(
            'crm.contact.add',
            [
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
            $sidBitrix = $cResult['result'];
            $stmt = mysqli_prepare($link, "INSERT INTO contact_id (id_contact_crm, id_contact_bitrix) VALUES (?,?)");
            mysqli_stmt_bind_param($stmt, "ii", $cIdContact, $sidBitrix);
            mysqli_stmt_execute($stmt);
        }
    }
}

function create_deal($data){

    $link = mysqli_connect('127.0.0.1', 'root', 'admin', 'integration');
    $dName = $data['name'];
    $dIdDeal = $data['id'];
   $dDescription = $data['description'];
   $dAmount = $data['amount'];
   $dCost = $data['cost'];
   $dProfit = $data['profit'];
   $dNumber = $data['number'];
   $dPlannedAt = $data['planned_at'];
   $dFinishedAt = $data['finished-at'];

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
    if (!empty ($result = CRest::call(
        'crm.deal.add',
        [
            'fields' =>
                [
                    'TITLE' => $dName,
                    'COMMENTS' => $dCom,
                    'OPPORTUNITY' => $dAmount,
                    'CLOSEDATE' => $dFinishedAt

                ]
        ]))) {
        $sidBitrix = $result['result'];
        $stmt = mysqli_prepare($link, "INSERT INTO deal_id (id_deal_crm, id_deal_bitrix) VALUES (?,?)");
        mysqli_stmt_bind_param($stmt, "ii", $dIdDeal, $sidBitrix);
        mysqli_stmt_execute($stmt);
    }

}

function create_task($data){

  $tTitle = $data['name'];
  $tetDate = 1;

  if(!Crest::call(
    'tasks.task.add',
    [
      'fields'=>
      [
          "TITLE" => $tTitle,
          "RESPONSIBLE_ID"=> $tetDate
      ]
    ]
  )){
    error_log("Task not added");
  }
}




//session_start();

// Takes raw data from the request
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
   
    break;
  default:
  //error_log($data['data']);
  error_log("No data");
    //show_error();
}
