<?php

/**
 * Class RequestFactory
 */
class RequestFactory
{
    public function prepareRequestWithArtistId($id)
    {
        $request = [
            "artist" => $id
        ];

        return $request;
    }

    public function prepareRequestWithPaintingId($id)
    {
        $request = [
            "painting" => $id
        ];

        return $request;
    }

    // region Create Painting Interaction Payload

    function createPaintingLove($clientId, $paintingId) {
        return $this->prepareLoveInteractionRequest($clientId, $paintingId, IshtarConfig::$ENTITY_TYPE_PAINTING);
    }

    function createPaintingFollow($clientId, $paintingId) {
        return $this->prepareLoveInteractionRequest($clientId, $paintingId, IshtarConfig::$ENTITY_TYPE_PAINTING);
    }

    function createPaintingView($clientId, $paintingId) {
        return $this->prepareLoveInteractionRequest($clientId, $paintingId, IshtarConfig::$ENTITY_TYPE_PAINTING);
    }

    // endregion

    // region Create Artist Interaction Payload

    function createArtistLove($clientId, $paintingId) {
        return $this->prepareLoveInteractionRequest($clientId, $paintingId, IshtarConfig::$ENTITY_TYPE_ARTIST);
    }

    function createArtistFollow($clientId, $paintingId) {
        return $this->prepareFollowInteractionRequest($clientId, $paintingId, IshtarConfig::$ENTITY_TYPE_ARTIST);
    }

    function createArtistView($clientId, $paintingId) {
        return $this->prepareViewInteractionRequest($clientId, $paintingId, IshtarConfig::$ENTITY_TYPE_ARTIST);
    }

    // endregion

    // region Create final Create Request

    /**
     * @param $clientId
     * @param $productId
     * @param $entityType
     * @return array
     */
    private function prepareLoveInteractionRequest($clientId, $productId, $entityType) {
        return [
            "client" => $clientId,
            "row" => $productId,
            "interaction" => IshtarConfig::$INTERACTION_TYPE_LOVE,
            "entity" => $entityType
        ];
    }

    /**
     * @param $clientId
     * @param $productId
     * @param $entityType
     * @return array
     */
    private function prepareFollowInteractionRequest($clientId, $productId, $entityType) {
        return [
            "client" => $clientId,
            "row" => $productId,
            "interaction" => IshtarConfig::$INTERACTION_TYPE_FOLLOW,
            "entity" => $entityType
        ];
    }

    /**
     * @param $clientId
     * @param $productId
     * @param $entityType
     * @return array
     */
    private function prepareViewInteractionRequest($clientId, $productId, $entityType) {
        return [
            "client" => $clientId,
            "row" => $productId,
            "interaction" => IshtarConfig::$INTERACTION_TYPE_VIEW,
            "entity" => $entityType
        ];
    }

    // endregion

    // region Interaction Queries

    public function prepareGetPaintingLovesQuery($productId){
        return [
            "row" => $productId,
            "interaction" => IshtarConfig::$INTERACTION_TYPE_LOVE,
            "entity" => IshtarConfig::$ENTITY_TYPE_PAINTING
        ];
    }

    // endregion
}
