<?php


namespace App\Validator;


use App\Entity\ArttypeEntity;
use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ArttypeValidate
{
    private $validator;
    private $entityManager;

    public function __construct(ValidatorInterface $validator, EntityManagerInterface $entityManagerInterface)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManagerInterface;
    }

    public function arttypeValidator(Request $request, $type)
    {
        $input = json_decode($request->getContent(), true);

        $constraints = new Assert\Collection([

            'id' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'name' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'history' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'story' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'image' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'video' => [
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
            unset($constraints->fields['image']);
            unset($constraints->fields['video']);
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
            if (!$this->entityManager->getRepository(ArttypeEntity::class)->find($input["id"])) {
                return "No Arttype with this id!";
            }
        }
        return null;
    }
}