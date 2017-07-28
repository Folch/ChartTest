<?php
require_once __DIR__ . '/../Response/CodeValues.php';
require_once __DIR__ . '/../Response/JsonKey.php';
require_once __DIR__ . '/../Utils/JsonUtils.php';
class Validation
{
    public static function validateAndPrintValidateInput($httpCall, $parameters, $fileName)
    {
        $parameterNotFilled = self::validateInput($httpCall, $parameters);
        if ($parameterNotFilled != null) {

            $response[JsonKey::CODE] = CodeValues::ERROR;
            $response[JsonKey::CAUSE] = "Parameter " . $parameterNotFilled . " from " . basename($fileName, '.php') . " is mandatory";
            JsonUtils::printJson($response);
            die();
        }
    }

    private static function validateInput($httpCall, $parameters)
    {
        foreach ($parameters as $parameter) {
            if (!isset($httpCall[$parameter])) {
                return $parameter;
            }
        }
        return null;
    }
}

