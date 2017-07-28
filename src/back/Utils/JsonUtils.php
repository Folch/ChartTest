<?php
require_once __DIR__ . '/../Response/JsonKey.php';

class JsonUtils
{
    public static function printJson($arrayJson)
    {
        $okJSON = json_encode($arrayJson);
        if ($okJSON) {
            echo $okJSON;
        } else {//any error with accents?
            $resp[JsonKey::CODE] = CodeValues::ERROR;
            $resp[JsonKey::CAUSE] = json_last_error_msg();
            echo json_encode($resp);
        }
    }

}
