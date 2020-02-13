<?php


namespace App\Validator;


use App\Entity\EntityInteractionEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Required;

class InteractionValidate implements InteractionValidateInterface
{
    private $validator;
    private $entityManager;

    public function __construct(ValidatorInterface $validator, EntityManagerInterface $entityManagerInterface)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManagerInterface;
    }


    public function interactionValidator(Request $request, $type)
    {
        $input = json_decode($request->getContent(), true);

        $constraints = new Assert\Collection([

            'entity' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'row' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'interaction' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'client' => [
               new Required(),
               new Assert\NotBlank(),
            ]
        ]);

        if ($input["interaction"] == 3)
        {
            unset($constraints->fields['client']);
        }

        if ($type == 'create') {
            unset($constraints->fields['id']);
        }
        if ($type == "delete") {
            unset($constraints->fields['entity']);
            unset($constraints->fields['row']);
            unset($constraints->fields['interaction']);
            unset($constraints->fields['client']);
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