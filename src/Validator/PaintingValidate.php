<?php


namespace App\Validator;


use App\Entity\PaintingEntity;
use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class PaintingValidate
{
    private $validator;
    private $entityManager;

    public function __construct(ValidatorInterface $validator, EntityManagerInterface $entityManagerInterface)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManagerInterface;
    }

    public function paintingValidator(Request $request, $type)
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
            'artist' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'artType' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'addingDate' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'story' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'state' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'deminsions' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'price' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'colorsType' => [
                new Required(),
                new Assert\NotBlank(),
            ],

        ]);

        if ($type == 'create') {
            unset($constraints->fields['id']);
        }
        if ($type == "delete") {
            unset($constraints->fields['name']);
            unset($constraints->fields['artist']);
            unset($constraints->fields['artType']);
            unset($constraints->fields['addingDate']);
            unset($constraints->fields['story']);
            unset($constraints->fields['deminsions']);
            unset($constraints->fields['colorsType']);
            unset($constraints->fields['price']);
            unset($constraints->fields['state']);
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
            if (!$this->entityManager->getRepository(PaintingEntity::class)->find($input["id"])) {
                return "No Painting with this id!";
            }
        }
        return null;
    }
}