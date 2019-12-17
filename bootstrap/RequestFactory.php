<?php

class RequestFactory
{
    public function prepareRequestWithArtistId($id)
    {
        $request = [
            'artist' => $id
        ];

        return $request;
    }

    public function prepareRequestWithPaintingId($id)
    {
        $request = [
            'painting' => $id
        ];

        return $request;
    }

    // region Create Painting Interaction Payload

    function createPaintingLove($clientId, $paintingId)
    {
        return $this->prepareLoveInteractionRequest($clientId, $paintingId, ConfigLinks::$ENTITY_TYPE_PAINTING);
    }

    function createPaintingFollow($clientId, $paintingId)
    {
        return $this->prepareLoveInteractionRequest($clientId, $paintingId, ConfigLinks::$ENTITY_TYPE_PAINTING);
    }

    function createPaintingView($clientId, $paintingId)
    {
        return $this->prepareLoveInteractionRequest($clientId, $paintingId, ConfigLinks::$ENTITY_TYPE_PAINTING);
    }

    // endregion

    // region Create Artist Interaction Payload

    public function createArtistLove($clientId, $paintingId): array
    {
        return $this->prepareLoveInteractionRequest($clientId, $paintingId, ConfigLinks::$ENTITY_TYPE_ARTIST);
    }

    public function createArtistFollow($clientId, $paintingId): array
    {
        return $this->prepareFollowInteractionRequest($clientId, $paintingId, ConfigLinks::$ENTITY_TYPE_ARTIST);
    }

    public function createArtistView($clientId, $paintingId): array
    {
        return $this->prepareViewInteractionRequest($clientId, $paintingId, ConfigLinks::$ENTITY_TYPE_ARTIST);
    }

    // endregion

    // region Create final Create Request

    /**
     * @param $clientId
     * @param $productId
     * @param $entityType
     * @return array
     */
    private function prepareLoveInteractionRequest($clientId, $productId, $entityType): array
    {
        return [
            'client' => $clientId,
            'row' => $productId,
            'interaction' => ConfigLinks::$INTERACTION_TYPE_LOVE,
            'entity' => $entityType
        ];
    }

    /**
     * @param $clientId
     * @param $productId
     * @param $entityType
     * @return array
     */
    private function prepareFollowInteractionRequest($clientId, $productId, $entityType): array
    {
        return [
            'client' => $clientId,
            'row' => $productId,
            'interaction' => ConfigLinks::$INTERACTION_TYPE_FOLLOW,
            'entity' => $entityType
        ];
    }

    /**
     * @param $clientId
     * @param $productId
     * @param $entityType
     * @return array
     */
    private function prepareViewInteractionRequest($clientId, $productId, $entityType): array
    {
        return [
            'client' => $clientId,
            'row' => $productId,
            'interaction' => ConfigLinks::$INTERACTION_TYPE_VIEW,
            'entity' => $entityType
        ];
    }

    // endregion

    // region Interaction Queries

    public function prepareGetPaintingLovesQuery($productId): array
    {
        return [
            'row' => $productId,
            'interaction' => ConfigLinks::$INTERACTION_TYPE_LOVE,
            'entity' => ConfigLinks::$ENTITY_TYPE_PAINTING
        ];
    }

    // endregion

    // region Create Artist Payload
    public function prepareCreateArtistRequestPayload(): array
    {
        $artistMapper = new MapperArtist();

        $artistMapper->setArtist(
            'The New Artist',
            'Unknown',
            'Unknown',
            '12-12-2012',
            'Poor Artist Trying to Make His Day',
            'No Details Provided',
            'http://ishtar-art.de/ImageUploads/ArtistImages/FirstImages/04_Douaa_Battikh.jpg',
            '1',
            'https://fb.com/mohammad.kalaleeb',
            'https://fb.com/mohammad.kalaleeb',
            'https://fb.com/mohammad.kalaleeb',
            '<iframe width="560" height="315" src="https://www.youtube.com/embed/LN820hIQ17Q" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
        );
        return $artistMapper->getArtistAsArray();
    }

    public function prepareCreatePaintingRequestPayload(): void
    {

    }

    public function prepareLoginPayload(string $username, string $password): array
    {
        return [
            'username' => $username,
            'password' => $password
        ];
    }

    public function prepareRegisterPayload(string $username, string $password): array
    {
        return [
            'email' => $username,
            'password' => $password
        ];
    }
}
