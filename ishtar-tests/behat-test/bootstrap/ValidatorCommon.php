<?php

class ValidatorCommon
{
    public static function isValidJson($dataLoad)
    {
        $json_response = $dataLoad->getBody()->getContents();
        json_decode($json_response);

        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                return true;
            case JSON_ERROR_DEPTH:
                $msg = ' - Maximum stack depth exceeded';
                return "JSON Format Error " . $msg;
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $msg = ' - Underflow or the modes mismatch';
                return "JSON Format Error " . $msg;
                break;
            case JSON_ERROR_CTRL_CHAR:
                $msg = ' - Unexpected control character found';
                return "JSON Format Error " . $msg;
                break;
            case JSON_ERROR_SYNTAX:
                $msg = ' - Syntax error, malformed JSON';
                return "JSON Format Error " . $msg;
                break;
            case JSON_ERROR_UTF8:
                $msg = ' - Malformed UTF-8 characters, possibly incorrectly encoded';
                return "JSON Format Error " . $msg;
                break;
            default:
                $msg = ' - Unknown error';
                return "JSON Format Error " . $msg;
                break;
        }
    }
}
