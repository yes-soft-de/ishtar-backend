<?php

class RequestFactory
{
    public function prepareRequestWithArtistId($id) {
        $request = [
            "artist" => $id
        ];

        return json_encode($request);
    }
}
