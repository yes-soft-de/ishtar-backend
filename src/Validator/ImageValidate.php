<?php


namespace App\Validator;


use App\Entity\ImageEntity;
use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ImageValidate
{
    private $validator;
    private $entityManager;

    public function __construct(ValidatorInterface $validator, EntityManagerInterface $entityManagerInterface)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManagerInterface;
    }

    public function imageValidator(Request $request, $type)
    {
        $input = json_decode($request->getContent(), true);

        $constraints = new Assert\Collection([

            'id' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'paintingId' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'artistId' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'url' => [
                new Required(),
                new Assert\NotBlank(),
                new url(),
            ],
            'date' => [
                new Required(),
                new Assert\NotBlank(),
            ],

        ]);

        if ($type == 'create') {
            unset($constraints->fields['id']);
        }
        if ($type == "delete") {
            unset($constraints->fields['paintingId']);
            unset($constraints->fields['artistId']);
            unset($constraints->fields['url']);
            unset($constraints->fields['date']);
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
            if (!$this->entityManager->getRepository(ImageEntity::class)->find($input["id"])) {
                return "No Image with this id!";
            }
        }
        return null;
    }
}