<?php

class ConfigLinks
{
    static $BASE_API = "http://localhost:9000/";
//    static $BASE_API = "https://webhook.site/d04c9a69-0f71-48cb-8277-12a4ecc153fc";

    static $DIAGNOSE_REQUEST_API = "https://webhook.site/d04c9a69-0f71-48cb-8277-12a4ecc153fc";

    static $ARTIST_QUERY_ENDPOINT = "getAllArtist";
    static $ARTIST_QUERY_BY_ID_ENDPOINT = "getArtistById";

    static $INTERACTION_CREATE_ENDPOINT = "createInteraction";
    static $INTERACTION_GET_ENDPOINT = "getInteraction";

    static $PAINTING_QUERY_ENDPOINT = "getAllPainting";
    static $PAINTING_QUERY_BY_ID_ENDPOINT = "getPaintingById";


    static $ENTITY_TYPE_PAINTING = 1;
    static $ENTITY_TYPE_ARTIST = 2;
    static $ENTITY_TYPE_ART_TYPE = 3;

    static $INTERACTION_TYPE_LOVE = 1;
    static $INTERACTION_TYPE_FOLLOW = 2;
    static $INTERACTION_TYPE_VIEW = 3;

    static $CREATE_ARTIST_ENDPOINT = "createArtist";
    static $CREATE_PAINTING_ENDPOINT = "createPainting";
}
