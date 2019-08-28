<?php


namespace App\Validator;


use App\Entity\ClapEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Required;
use App\Validator\ArtistValidate;

class BaseValidate implements BaseValidateInterface
{

    public function baseValidator(Request $request, $type,$entity)
    {
        ArtistValidate::class;
    }
}
