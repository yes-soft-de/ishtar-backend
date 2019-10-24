<?php

class InteractionCommonFactory
{

    /**
     * @param $paintingId
     * @return integer or string
     */
    public function getPaintingLoves($paintingId)
    {
        $requestFactory = new RequestFactory();
        $httpClient = new GuzzleHttp\Client();

        $response = $httpClient->post(
            ConfigLinks::$BASE_API . ConfigLinks::$INTERACTION_GET_ENDPOINT,
            [
                'json' => $requestFactory->prepareGetPaintingLovesQuery($paintingId)
            ]
        );

        $json_response = json_decode($response->getBody()->getContents());
        return $json_response->Data[0]->interactions;
    }

    /**
     * @param $paintingId
     * @return integer or string
     */
    public function getPaintingViews($paintingId)
    {
        $requestFactory = new RequestFactory();
        $httpClient = new GuzzleHttp\Client();

        $response = $httpClient->post(
            ConfigLinks::$BASE_API . ConfigLinks::$INTERACTION_GET_ENDPOINT,
            [
                'json' => $requestFactory->prepareGetPaintingLovesQuery($paintingId)
            ]
        );

        $json_response = json_decode($response->getBody()->getContents());
        return $json_response->Data[0]->interactions;
    }

    /**
     * @param $paintingId
     * @return integer or string
     */
    public function getPaintingFollows($paintingId)
    {
        $requestFactory = new RequestFactory();
        $httpClient = new GuzzleHttp\Client();

        $response = $httpClient->post(
            ConfigLinks::$BASE_API . ConfigLinks::$INTERACTION_GET_ENDPOINT,
            [
                'json' => $requestFactory->prepareGetPaintingLovesQuery($paintingId)
            ]
        );

        $json_response = json_decode($response->getBody()->getContents());
        return $json_response->Data[0]->interactions;
    }

    private function loveEntity($entityId, $userId, $entityType) {
        $requestFactory = new RequestFactory();
        $httpClient = new GuzzleHttp\Client();

        $endPoint = ConfigLinks::$INTERACTION_CREATE_ENDPOINT;

        $response = $httpClient->post(
            ConfigLinks::$BASE_API . ConfigLinks::$INTERACTION_GET_ENDPOINT,
            [
                'json' => $requestFactory->prepareCreatePaintingLoveInteractionRequest()
            ]
        );

        $json_response = json_decode($response->getBody()->getContents());
        return $json_response->Data[0]->interactions;
    }
}
