<?php


namespace App\Validator;


use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ArtistValidate
{
    private $validator;
    private $entityManager;

    public function __construct(ValidatorInterface $validator, EntityManagerInterface $entityManagerInterface)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManagerInterface;
    }

    public function pantingValidator(Request $request, $type)
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
            'image_url' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'description' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'size' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'medium' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'category' => [
                new Required(),
                new Assert\NotBlank(),
            ]
        ]);

        if ($type == 'create') {
            unset($constraints->fields['id']);
        }
        if ($type == "delete") {
            unset($constraints->fields['name']);
            unset($constraints->fields['image_url']);
            unset($constraints->fields['description']);
            unset($constraints->fields['size']);
            unset($constraints->fields['medium']);
            unset($constraints->fields['category']);
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
            if (!$this->entityManager->getRepository(Painting::class)->find($input["id"])) {
                return "No panting with this id!";
            }
        }
        return null;
    }
}