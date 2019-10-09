<?php

class RequestFactory
{
    public function prepareRequestWithArtistId($id) {
        $request = [
            "artist" => $id
        ];

        return $request;
    }

    public function prepareRequestWithPaintingId($id) {
        $request = [
            "painting" => $id
        ];

        return $request;
    }
}
