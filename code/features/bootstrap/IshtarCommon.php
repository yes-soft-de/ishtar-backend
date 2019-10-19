<?php

class IshtarCommon
{
    public function isValidJson($dataLoad)
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

    /**
     * @param $paintingId
     * @return integer or string
     */
    public function getPaintingLoves($paintingId)
    {
        $requestFactory = new RequestFactory();
        $httpClient = new GuzzleHttp\Client();

        $response = $httpClient->post(
            IshtarConfig::$BASE_API . IshtarConfig::$INTERACTION_GET_ENDPOINT,
            [
                'json' => $requestFactory->prepareGetPaintingLovesQuery($paintingId)
            ]
        );

        $json_response = json_decode($response->getBody()->getContents());
        return $json_response->Data[0]->interactions;
    }

    function lovePainting($paintingId, $userId) {

    }

    private function loveEntity($entityId, $userId, $entityType) {
        $requestFactory = new RequestFactory();
        $httpClient = new GuzzleHttp\Client();

        $endPoint = IshtarConfig::$INTERACTION_CREATE_ENDPOINT;

        $response = $httpClient->post(
            IshtarConfig::$BASE_API . IshtarConfig::$INTERACTION_GET_ENDPOINT,
            [
                'json' => $requestFactory->prepareCreatePaintingLoveInteractionRequest()
            ]
        );

        $json_response = json_decode($response->getBody()->getContents());
        return $json_response->Data[0]->interactions;
    }
}
