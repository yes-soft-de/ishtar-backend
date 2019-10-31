<?php


namespace App\Validator;


use App\Entity\ArtTypeEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Validator\ValidatorInterface;
//ToDo do not forget to use this
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Required;

class ArtTypeValidate implements ArtTypeValidateInterface
{
    private $validator;
    private $entityManager;

    public function __construct(ValidatorInterface $validator, EntityManagerInterface $entityManagerInterface)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManagerInterface;
    }

    public function artTypeValidator(Request $request,$type)
    {
        $input = json_decode($request->getContent(), true);

        $constraints = new Assert\Collection([

            'name' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'history' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'image'=>[
                new Required(),
                new Assert\NotBlank(),
            ],

        ]);

        if ($type == 'create') {
            unset($constraints->fields['id']);
        }
        if ($type == "delete") {
            unset($constraints->fields['name']);
            unset($constraints->fields['story']);
            unset($constraints->fields['history']);
        }

        $violations = $this->validator->validate($input, $constraints);

        if (count($violations) > 0) {
            $accessor = PropertyAccess::createPropertyAccessor();

            $errorMessages = [];

            foreach ($violations as $violation) {
                $accessor->setValue($errorMessages,
                    $violation->getPropertyPath(),
                    $violation->getMessage());
            }

            $result = json_encode($errorMessages);

            return $result;
        }

        return null;
    }
}