<?php


namespace App\Validator;


use App\Entity\CommentEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Required;

class CommentValidate implements CommentValidateInterface
{
    private $validator;
    private $entityManager;

    public function __construct(ValidatorInterface $validator, EntityManagerInterface $entityManagerInterface)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManagerInterface;
    }



    public function commentValidator(Request $request, $type)
    {
        $input = json_decode($request->getContent(), true);

        $constraints = new Assert\Collection([

            'id' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'entity' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'row' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'body' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'client' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'date' => [
                new Required(),
            ],
            'lastEdit' => [
                new Required(),
            ],
            'spacial' => [
                new Required(),
            ]

        ]);


        if ($type == 'create') {
            unset($constraints->fields['id']);
        }
        if ($type == "delete") {
            unset($constraints->fields['pageName']);
            unset($constraints->fields['rowNum']);
            unset($constraints->fields['body']);
            unset($constraints->fields['date']);
            unset($constraints->fields['lastEdit']);
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
            if (!$this->entityManager->getRepository(CommentEntity::class)->find($input["id"])) {
                return "No Comment with this id!";
            }
        }
        return null;
    }
}