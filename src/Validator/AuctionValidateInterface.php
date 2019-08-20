<?php


namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

interface AuctionValidateInterface
{
    public function auctionValidator(Request $request, $type);

}