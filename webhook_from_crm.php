<?php


require_once (__DIR__.'/crest.php');
require_once (__DIR__.'/connect.php');
//require_once(__DIR__,'/Company.php');
//require_once(__DIR__,'/Contact.php');
//require_once(__DIR__,'/Deal.php');
//require_once(__DIR__,'/Task.php');



function create_company($data)
{
//БД
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $link = mysqli_connect('localhost:3306', 'root', 'root', 'integration');
    $query = "SELECT id_contact_synergy FROM contact_id";
    $resultId = mysqli_query($link, $query);
    $contact_synergy = mysqli_fetch_array($resultId, MYSQLI_NUM);

    $queryD = "SELECT id_deal_synergy FROM deal_id";
    $resultIdD = mysqli_query($link, $queryD);
    $deal_synergy = mysqli_fetch_array($resultIdD, MYSQLI_NUM);

    $queryT = "SELECT id_task_synergy FROM task_id";
    $resultIdT = mysqli_query($link, $queryT);
    $task_synergy = mysqli_fetch_array($resultIdT, MYSQLI_NUM);
    //


    $sTitle = $data['name'];
    $sEmail = $data['email'];
    $sEmailOther = $data['other_email'];

    $sPhoneGeneral = $data['general_phone'];
    $sPhoneMobile = $data['mobile_phone'];
    $sPhoneWork = $data['work_phone'];
    $sPhoneWorkPostfix = $data['work_phone_postfix'];
    $sPhoneOther = $data['other_phone'];
    $sPhoneOtherPostfix = $data['other_phone_postfix'];
    $sPhoneFax = $data['fax'];

    $sDescription = $data['description'];
    $sWeb = $data['website'];
    $arWeb = (!empty($sWeb)) ? array(array('VALUE' => $sWeb, 'VALUE_TYPE' => 'OTHER')) : array();


    $arPhoneGeneral = (!empty($sPhoneGeneral)) ? array(array('VALUE' => $sPhoneGeneral, 'VALUE_TYPE' => 'WORK')) : array();
    $arPhoneMobile = (!empty($sPhoneMobile)) ? array(array('VALUE' => $sPhoneMobile, 'VALUE_TYPE' => 'MOBILE')) : array();
    $arPhoneWork = (!empty($sPhoneWork)) ? array(array('VALUE' => $sPhoneWork, 'VALUE_TYPE' => 'WORK')) : array();
    $arPhoneWorkPostfix = (!empty($sPhoneWorkPostfix)) ? array(array('VALUE' => $sPhoneWorkPostfix, 'VALUE_TYPE' => 'WORK')) : array();
    $arPhoneOther = (!empty($sPhoneOther)) ? array(array('VALUE' => $sPhoneOther, 'VALUE_TYPE' => 'OTHER')) : array();
    $arPhoneOtherPostfix = (!empty($sPhoneOtherPostfix)) ? array(array('VALUE' => $sPhoneOtherPostfix, 'VALUE_TYPE' => 'OTHER')) : array();
    $arPhoneFax = (!empty($sPhoneFax)) ? array(array('VALUE' => $sPhoneFax, 'VALUE_TYPE' => 'FAX')) : array();
    $arEmail = (!empty($sEmail)) ? array(array('VALUE' => $sEmail, 'VALUE_TYPE' => 'WORK')) : array();
    $arEmailOther = (!empty($sEmailOther)) ? array(array('VALUE' => $sEmail, 'VALUE_TYPE' => 'OTHER')) : array();

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
    //$sIdContact = $data['contact_id'];
    $sIdContact = $data['contact_id'];
    $sIdDeal = $data['deal_id'];
    $sIdTask = $data['task_id'];
    if (empty ($result = CRest::call(
        'crm.company.add',
        [
            'fields' =>
                [
                    'TITLE' => $sTitle,//name
                    'COMMENTS' => $sDescription,             //description
                    'PHONE' => $arPhoneGeneral,//general-phone
                    'PHONE' => $arPhoneMobile, //mobile-phone
                    'PHONE' => $arPhoneWork,//work-phone
                    'PHONE' => $arPhoneWorkPostfix,//work-phone-postfix
                    'PHONE' => $arPhoneOther,//other-phone
                    'PHONE' => $arPhoneOtherPostfix,//other-phone-postfix
                    'PHONE' => $arPhoneFax,//fax
                    'EMAIL' => $arEmail,//email
                    'EMAIL' => $arEmailOther,
                    'WEB' => $arWeb,
                    'ADDRESS' => $sAddress,
                    'ADDRESS_CITY' => $sCity,
                    'ADDRESS_POSTAL_CODE' => $sZipCode,
                    'ADDRESS_REGION' => $sRegion,
                    'ADDRESS_COUNTRY' => $sCountry,
                    ''
                ]
        ]))) {
        error_log("Company not added");
    }
    if (!empty($result['result'])) {
        $resultRequisite = CRest::call(
            'crm.requisite.add',
            [
                'fields' => [
                    'ENTITY_TYPE_ID' => 4,//4 - is company in CRest::call('crm.enum.ownertype');
                    'ENTITY_ID' => $result['result'],//company id
                    'TITLE' => $sTitle,
                    'ACTIVE' => 'Y',
                    'NAME' => $sTitle,
                    'RQ_INN' => $sINN,
                    'RQ_COMPANY_FULL_NAME' => $sFullName,
                    'RQ_COMPANY_NAME' => $sShortName,
                    'RQ_OGRN' => $sOgrn,
                    'RQ_KPP' => $sKpp,
                    'RQ_OKVED' => $sOkved,
                    'RQ_DIRECTOR' => $sDirector,
                    'RQ_ACCOUNTANT' => $sAccountant,
                ]
            ]);
        if (!empty($resultRequisite['result'])) {
            $resultAddress = CRest::call(
                'crm.address.add',
                [
                    'fields' => [
                        'TYPE_ID' => 1,
                        'ENTITY_ID' => $result['result'],
                        'ADDRESS_1' => $sActualStreet,
                        'ADDRESS_1' => $sActualHouse,
                        'ADDRESS_1' => $sActualBuild,
                        'ADDRESS_2' => $sActualOffice
                    ]
                ]);
        }
        $queryContactCompany = "SELECT id_contact_bitrix FROM contact_id WHERE id_contact_synergy=?";
        $stmt = mysqli_prepare($link, $queryContactCompany);
        mysqli_stmt_bind_param($stmt, "i", $sIdContact);
        foreach ($contact_synergy as $sIdContact) {
            mysqli_stmt_execute($stmt);
            $resultSelect = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_array($resultSelect, MYSQLI_NUM)) {
                foreach ($row as $idContactBitrix) {
                    if (!empty($idContactBitrix)) {
                        $resultRequisite = CRest::call(
                            'crm.company.contact.add',
                            ['id' => $result['result'],
                                'fields' => [
                                    'CONTACT_ID' => idContactBitrix
                                ]
                            ]);
                    } else {
                        create_contact($data);
                    }
                }
            }
        }
        $queryDealCompany = "SELECT id_deal_bitrix FROM deal_id WHERE id_deal_synergy=?";
        $stmtd = mysqli_prepare($link, $queryDealCompany);
        mysqli_stmt_bind_param($stmt, "i", $sIdDeal);
        foreach ($deal_synergy as $sIdDeal) {
            mysqli_stmt_execute($stmtd);
            $resultSelectDeal = mysqli_stmt_get_result($stmtd);
            while ($rowd = mysqli_fetch_array($resultSelectDeal, MYSQLI_NUM)) {
                foreach ($rowd as $idDealBitrix) {
                    if (!empty($idDealBitrix)) {
                        update_deal($data);
                        //обновление сделки
                    } else{
                        create_deal($data);
                    }
                }
            }

        }
        $queryTaskCompany = "SELECT id_task_bitrix FROM task_id WHERE id_task_synergy=?";
        $stmtt = mysqli_prepare($link, $queryTaskCompany);
        mysqli_stmt_bind_param($stmtt, "i", $sIdTask);
        foreach ($task_synergy as $sIdTask) {
            mysqli_stmt_execute($stmtt);
            $resultSelectTask = mysqli_stmt_get_result($stmtt);
            while ($rowt = mysqli_fetch_array($resultSelectTask, MYSQLI_NUM)) {
                foreach ($rowt as $idTaskBitrix) {
                    if (!empty($idDealBitrix)) {
                        update_task($data);
                    } else {
                        create_task($data);
                    }
                }
            }
        }
       //проверяем есть ли такая сделка в бд если есть функция обновления если нет функция создания $sIdDeal
    }
}
 //Deal
//в конце айди компании по синергии и битриксу добавляем в БД
        


      

function create_contact($data){

  $cName = $data['first_name'];
  $cLastName = $data['last_name'];
  $cMiddleName = $data['middle_name'];

  if(!Crest::call(
    'crm.contact.add',
    [
      'fields'=>
      [
        "NAME"=> $cName, 
        "SECOND_NAME"=> $cMiddleName, 
        "LAST_NAME"=> $cLastName
      ]
    ]
  )){
    error_log("Contact not added");
  }

}

function create_deal($data){
    $dTitle = $data['name'];
  if(!CRest::call(
    'crm.deal.add',
    [
        'fields'=>
        [ 
          "TITLE" => $dTitle 
			   // "TYPE_ID": "GOODS", 
			   // "STAGE_ID": "NEW", 					
			    //"COMPANY_ID": 3,
			    //"CONTACT_ID": 3,
			    //"OPENED": "Y", 
			    //"ASSIGNED_BY_ID": 1, 
			    //"PROBABILITY": 30,
			    //"CURRENCY_ID": "USD", 
			    //"OPPORTUNITY": 5000,
			    //"CATEGORY_ID": 5,
			    //"BEGINDATE": date2str(current),
			    //"CLOSEDATE": date2str(nextMonth)
        ]
        ])){
          error_log("Deal not added");
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


function change_company(){

}





function  process_company($data){ //функция в которой я проверяю создан объект или нет если да, то смотрим что с ним делать, обновить или удалить(с этими вещами надо еще подумать), если нет то создаем
    //  CRest::call(
    //    "crm.company.update",
    //  {
    //    id: $data['id'],
    //  fields:
    //{

    //},
    //params: { "REGISTER_SONET_EVENT": "Y" }
    //},
    // function(result)
    //{
    //   if(result.error())
    //      console.error(result.error());
    // else
    // {
    //    console.info(result.data());
    // }
    // }
    //);
}
//access_log(var_dump($data));



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
