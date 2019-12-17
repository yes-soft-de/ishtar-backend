<?php

class ConfigLinks
{
    public static $BASE_API = 'http://localhost:8002/';
//    static $BASE_API = "https://webhook.site/d04c9a69-0f71-48cb-8277-12a4ecc153fc";

    public static $DIAGNOSE_REQUEST_API = 'https://webhook.site/c61fe605-960e-4fb3-aeca-def1e949d437';

    public static $ARTIST_QUERY_ENDPOINT = 'getAllArtist';
    public static $ARTIST_QUERY_BY_ID_ENDPOINT = 'getArtistById';

    public static $INTERACTION_CREATE_ENDPOINT = 'createInteraction';
    public static $INTERACTION_GET_ENDPOINT = 'interactionsentity';

    public static $PAINTING_INTERACTION_GET_ENDPOINT = 'interactions';

    public static $CREATE_PAINTING_INTERACTION = 'interactions';

    public static $PAINTING_QUERY_ENDPOINT = 'getAllPainting';
    public static $PAINTING_QUERY_BY_ID_ENDPOINT = 'getPaintingById';

    public static $PAINTING_CLAP_ENDPOINT = 'getPaintingClaps';


    public static $ENTITY_TYPE_PAINTING = 1;
    public static $ENTITY_TYPE_ARTIST = 2;
    public static $ENTITY_TYPE_ART_TYPE = 3;

    public static $INTERACTION_TYPE_LOVE = 1;
    public static $INTERACTION_TYPE_FOLLOW = 2;
    public static $INTERACTION_TYPE_VIEW = 3;

    public static $CREATE_ARTIST_ENDPOINT = 'createArtist';
    public static $CREATE_PAINTING_ENDPOINT = 'createPainting';

    public static $REGISTER_ENDPOINT = 'register';
    public static $LOGIN_ENDPOINT = 'login_check';
    public static $USER_ENDPOINT = 'user';
}
