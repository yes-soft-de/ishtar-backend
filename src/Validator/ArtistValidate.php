<?php


namespace App\Validator;


use App\Entity\ArtistEntity;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Nullable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints\Required;

class ArtistValidate implements ArtistValidateInterface
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
            'Facebook' => [
                new Assert\NotBlank(),
            ],
            'Instagram' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'Twitter' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'artType' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'Linkedin' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'image' => [
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


        return null;
    }
}