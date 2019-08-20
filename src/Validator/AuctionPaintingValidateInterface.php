<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

interface AuctionPaintingValidateInterface
{
    public function auctionPaintingValidator(Request $request, $type);
}