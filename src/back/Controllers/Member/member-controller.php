<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../Response/ResponseSearch.php';
require_once __DIR__ . '/../../Utils/Validation.php';
require_once __DIR__ . '/../../Database/MemberDB.php';

global $config;

$response = new ResponseSearch();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $httpMethod = $_GET;

    $firstnameText = 'firstname';
    $surnameText = 'surname';
    $emailText = 'email';

    $parameters = [
        $firstnameText,
        $surnameText,
        $emailText
    ];
    Validation::validateAndPrintValidateInput($httpMethod, $parameters, __FILE__);

    $firstname = trim(stripslashes($httpMethod[$firstnameText]));
    $surname = trim(stripslashes($httpMethod[$surnameText]));
    $email = trim(stripslashes($httpMethod[$emailText]));


    MemberDB::setMembersBy($response, $firstname, $surname, $email);


} else {
    $response->setMethodNotImplemented();
}
$response->printJSON();
