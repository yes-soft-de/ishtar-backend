<?php


namespace App\Validator;


use App\Entity\ArtistEntity;
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

    public function artistValidator(Request $request, $type)
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
            'nationality' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'residence' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'birthDate' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'story' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'details' => [
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
            'facebook' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'instagram' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'twitter' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'linkedin' => [
                new Required(),
                new Assert\NotBlank(),
            ],

        ]);

        if ($type == 'create') {
            unset($constraints->fields['id']);
        }
        if ($type == "delete") {
            unset($constraints->fields['name']);
            unset($constraints->fields['nationality']);
            unset($constraints->fields['residence']);
            unset($constraints->fields['birthDate']);
            unset($constraints->fields['story']);
            unset($constraints->fields['details']);
            unset($constraints->fields['image']);
            unset($constraints->fields['video']);
            unset($constraints->fields['facebook']);
            unset($constraints->fields['instagram']);
            unset($constraints->fields['twitter']);
            unset($constraints->fields['linkedin']);
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
            if (!$this->entityManager->getRepository(ArtistEntity::class)->find($input["id"])) {
                return "No Artist with this id!";
            }
        }
        return null;
    }
}