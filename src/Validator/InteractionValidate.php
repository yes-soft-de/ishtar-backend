<?php


namespace App\Validator;


use App\Entity\InteractionEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

            'id' => [
                new Required(),
                new Assert\NotBlank(),
            ],

            'pageName' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'rowNum' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'interactionType' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'clientId' => [
                new Required(),
                new Assert\NotBlank(),
            ]
        ]);

        if ($type == 'create') {
            unset($constraints->fields['id']);
        }
        if ($type == "delete") {
            unset($constraints->fields['pageName']);
            unset($constraints->fields['rowNum']);
            unset($constraints->fields['interactionType']);
            unset($constraints->fields['clientId']);
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

        if ($type != "create") {
            if (!$this->entityManager->getRepository(InteractionEntity::class)->find($input["id"])) {
                return "No Interaction with this id!";
            }
        }
        return null;
    }
}